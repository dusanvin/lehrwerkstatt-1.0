<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\LehrStud;
use App\Models\DeclinedMatching;
use DB;
use App\Notifications\MatchingProposal;
use App\Notifications\MatchingSuccess;
use Carbon\Carbon;
use Exception;
use Fhaculty\Graph\Graph;
use Graphp\Algorithms\MaxFlow;
use Graphp\Algorithms\MaxFlow\EdmondsKarp;

use Illuminate\Auth\Notifications\VerifyEmail;


class MatchingController extends Controller
{

    private function filter_schulart($matchings, $schulart) {
        $lehr = User::find($matchings->pluck('lehr_id'));

        if(!is_null($schulart)) {
            $lehr = $lehr->reject(function ($lehr, $key) use ($schulart) {
                return lcfirst($lehr->survey_data->schulart) != lcfirst($schulart);     
            });
        }

        $matchings = $matchings->filter(function ($m, $key) use ($lehr) {
            return $lehr->contains($m->lehr_id);  
        });
        $matchings = $matchings->values();

        return $matchings;
    }


    private function mse($lehr, $stud)
    {
        $sum = 0;
        $sum += ($lehr->survey_data->feedback_an - $stud->survey_data->feedback_von) ** 2;
        $sum += ($lehr->survey_data->feedback_von - $stud->survey_data->feedback_an) ** 2;
        $sum += (($lehr->survey_data->eigenstaendigkeit - $stud->survey_data->eigenstaendigkeit) ** 2) * 2;
        $sum += ($lehr->survey_data->improvisation - $stud->survey_data->improvisation) ** 2;
        $sum += ($lehr->survey_data->freiraum - $stud->survey_data->freiraum) ** 2;
        $sum += ($lehr->survey_data->innovationsoffenheit - $stud->survey_data->innovationsoffenheit) ** 2;
        $sum += (($lehr->survey_data->belastbarkeit - $stud->survey_data->belastbarkeit) ** 2) * 2;
        return number_format($sum / 9.0, 2);
    }


    public function compareMatchings($matching1, $matching2)
    {
        if ($matching1->mse == $matching2->mse)
            return 0;

        if ($matching1->mse < $matching2->mse)
            return -1;
        else
            return 1;
    }

    private function getAvailableUsers($schulart = null, $role = null)
    {
        return User::where('is_evaluable', true)->where('is_available', true)
        ->when($schulart, function($query, $schulart) {
            return $query->where('survey_data->schulart', $schulart);
        })
        ->when($role, function($query, $role) {
            return $query->where('role', $role);
        })
        ->get();
    }

    private function getAssignedUsers($schulart = null, $role = null)
    {
        return User::where('is_evaluable', true)->where('is_available', false)
        ->when($schulart, function($query, $schulart) {
            return $query->where('survey_data->schulart', $schulart);
        })
        ->when($role, function($query, $role) {
            return $query->where('role', $role);
        })
        ->get();
    }

    private function getMatchedLehr($schulart) {
        // Lehrer, die in der Vorauswahl sind nach Schulart filtern
        return User::find(LehrStud::where('is_matched', true)->pluck('lehr_id'));
        if(!is_null($schulart)) {
            $matched_lehr = $matched_lehr->filter(function ($lehr, $key) use($schulart) {
                return strtolower($lehr->survey_data->schulart) == strtolower($schulart);
            });
        }
    }

    private function updateMatchings($schulart = null) 
    {
        // verbleibende mögliche und nicht vergebene Matchings müssen nach einer getätigten Auswahl gelöscht werden, 
        // da manche dadurch nicht mehr möglich sein könnten, werden dann neu berechnet
        DB::table('lehr_stud')->where('is_matched', false)->where('is_notified', false)->delete();

        $graph = new Graph();
        $source_vertex = $graph->createVertex('s');
        $sink_vertex = $graph->createVertex('t');

        // Nutzer für den Matchingalgorithmus
        $available_lehr = $this->getAvailableUsers($schulart, 'Lehr');
        $available_stud = $this->getAvailableUsers($schulart, 'Stud');

        // connect source vertex to all lehr vertices with weight 1
        foreach ($available_lehr as $lehr) {
            $lehr_vertex = $graph->createVertex($lehr->id);
            $lehr_vertex->setAttribute('data', $lehr->survey_data);
            $edge = $source_vertex->createEdgeTo($lehr_vertex);
            $edge->setCapacity(1);
        }

        // connect stud vertices to sink vertex with weight 1
        foreach ($available_stud as $stud) {
            $stud_vertex = $graph->createVertex($stud->id);
            $stud_vertex->setAttribute('data', $stud->survey_data);
            $edge = $stud_vertex->createEdgeTo($sink_vertex);
            $edge->setCapacity(1);
        }

        // checks if lehr and stud can be matched an creates an edge
        foreach ($available_lehr as $lehr) {

            foreach ($available_stud as $stud) {

                if ($lehr->survey_data->schulart == $stud->survey_data->schulart) {

                    if (in_array($lehr->survey_data->landkreis,  $stud->survey_data->landkreise)) {

                        if ($lehr->survey_data->schulart == 'Grundschule') {
                            $lehr_vertex = $graph->getVertex($lehr->id);
                            $stud_vertex = $graph->getVertex($stud->id);
                            $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                            $edge->setCapacity(1);

                            $mse = $this->mse($lehr, $stud);
                            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);

                        } elseif ($lehr->survey_data->schulart == 'Realschule') {
                            if (in_array('Kunst', $stud->survey_data->faecher)) {
                                array_push($stud->survey_data->faecher, 'Kunst (nur Realschule)');
                            };
                            if (in_array('Musik', $stud->survey_data->faecher)) {
                                array_push($stud->survey_data->faecher, 'Musik (nur Realschule)');
                            }
                            if (array_intersect($lehr->survey_data->faecher, $stud->survey_data->faecher)) {
                                $lehr_vertex = $graph->getVertex($lehr->id);
                                $stud_vertex = $graph->getVertex($stud->id);
                                $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                                $edge->setCapacity(1);
    
                                $mse = $this->mse($lehr, $stud);
                                $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);
                            };

                            
                        } elseif ($lehr->survey_data->schulart == 'Gymnasium') {
                            if (array_intersect($lehr->survey_data->faecher, $stud->survey_data->faecher)) {
                            $lehr_vertex = $graph->getVertex($lehr->id);
                            $stud_vertex = $graph->getVertex($stud->id);
                            $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                            $edge->setCapacity(1);

                            $mse = $this->mse($lehr, $stud);
                            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);
                            }
                        } elseif ($lehr->survey_data->schulart == 'Mittelschule') {  // TODO
                            // if (array_intersect($lehr->survey_data->faecher, $stud->survey_data->faecher)) {
                            // $lehr_vertex = $graph->getVertex($lehr->id);
                            // $stud_vertex = $graph->getVertex($stud->id);
                            // $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                            // $edge->setCapacity(1);

                            // $mse = $this->mse($lehr, $stud);
                            // // $lehr->matchable()->attach($stud, ['mse' => $mse]);
                            // $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);
                            // }
                        }
                    }
                }
            }
        }

        // TODO: aufwendigen algorithmus optional in UI machen
        // https://github.com/graphp/algorithms/blob/0.9.x/src/MaxFlow/EdmondsKarp.php
        $ek = new EdmondsKarp($source_vertex, $sink_vertex);
        $resultGraph = $ek->createGraph();  // graph that maximizes matchings

        // werte resetten, werden im folgenden neu berechnet
        DB::table('lehr_stud')->update(['recommended' => 0, 'has_no_alternative_lehr' => 0, 'has_no_alternative_stud' => 0]);

        // graph traversal of the users that can be matched and check if they only have 1 possible matching partner
        $source_vertex = $resultGraph->getVertex('s');
        foreach ($source_vertex->getEdges() as $edge) {
            if ($edge->getFlow() == 1) {
                $lehr_vertex = $edge->getVertexEnd();
                foreach ($lehr_vertex->getEdges() as $edge) {
                    if ($edge->getFlow() == 1 && $edge->getVertexStart() != 's') {

                        $stud_vertex = $edge->getVertexEnd();

                        // check if lehr can be matched with only 1 stud
                        $lehr = User::find($lehr_vertex->getId());
                        if (count($lehr_vertex->getEdgesOut()) == 1) {
                            $has_no_alternative_lehr = true;
                        } else $has_no_alternative_lehr = false;

                        // check if stud can be matched with only 1 lehr
                        $stud = User::find($stud_vertex->getId());
                        if (count($stud_vertex->getEdgesIn()) == 1) {
                            $has_no_alternative_stud = true;
                        } else $has_no_alternative_stud = false;

                        // $lehr->matchable()->syncWithoutDetaching([$stud->id => ['recommended' => true, 'has_no_alternative_lehr' => $has_no_alternative_lehr,'has_no_alternative_stud' => $has_no_alternative_stud]]);
                        $lehr->matchable()->updateExistingPivot($stud, ['recommended' => true, 'has_no_alternative_lehr' => $has_no_alternative_lehr, 'has_no_alternative_stud' => $has_no_alternative_stud]);
                    }
                }
            }
        }

    }

    // View: Nav->Tandemvorschläge
    public function matchable($schulart = null)
    {
        $this->updateMatchings($schulart);

        // view: vorauswahl
        $matched_lehr = $this->getMatchedLehr($schulart);
        
        $assigned_lehr = $this->getAssignedUsers($schulart, 'Lehr');
        $assigned_stud = $this->getAssignedUsers($schulart, 'Stud');

        // view: matchings mit nur einem möglichen partner
        // TODO: check if recommended can get true if user already matched
        $recommended = DB::table('lehr_stud')
            ->where('recommended', true)
            ->where('is_matched', false)
            ->where('is_notified', false)
            ->whereNotIn('lehr_id', $assigned_lehr->pluck('id'))
            ->whereNotIn('stud_id', $assigned_stud->pluck('id'))
            ->orderBy('mse', 'asc')
            ->get();

        foreach ($recommended as $am) {
            // load user instances
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
        }
        
        // view: remaining matches
        $remaining_matches = DB::table('lehr_stud')
            ->where('recommended', false)
            ->where('is_matched', false)
            ->where('is_notified', false)
            ->whereNotIn('lehr_id', $assigned_lehr->pluck('id'))
            ->whereNotIn('stud_id', $assigned_stud->pluck('id'))
            ->orderBy('mse', 'asc')
            ->get();

        foreach ($remaining_matches as $am) {
            // load user instances
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
        }

        return view('matchable', compact('schulart', 'matched_lehr', 'recommended', 'remaining_matches'));  // TODO: im view max_flow entfernen
    }

    // View: Nav->Wunschtandems
    public function preferences($schulart = null)
    {
        $this->updateMatchings();

        // view: vorauswahl
        $matched_lehr = $this->getMatchedLehr($schulart);  


        $unassigned = User::where('is_evaluable', true)->where('is_available', true)
            ->when($schulart, function ($query) use ($schulart) {
                return $query->where('survey_data->schulart', $schulart);
            })
            ->get();

        $wunschtandem_lehr = $unassigned->where('role', 'Lehr')->reject(function ($lehr, $key) {
            return !isset($lehr->survey_data->wunschtandem);
        });
        $matchings_lehr_stud_wunschtandem = LehrStud::where('is_matched', false)->where('is_notified', false)
            ->whereIn('lehr_id', $wunschtandem_lehr->pluck('id'))->orderBy('lehr_id', 'asc')->orderBy('mse', 'asc')->get();

        $wunschtandem_stud = $unassigned->where('role', 'Stud')->reject(function ($stud, $key) {
            return !(isset($stud->survey_data->wunschtandem) || isset($stud->survey_data->wunschorte));
        });
        $matchings_stud_lehr_wunschtandem = LehrStud::where('is_matched', false)->where('is_notified', false)
            ->whereIn('stud_id', $wunschtandem_stud->pluck('id'))->orderBy('stud_id', 'asc')->orderBy('mse', 'asc')->get();


        return view('matchings.preferences', compact(['schulart', 'matched_lehr', 'matchings_lehr_stud_wunschtandem', 'matchings_stud_lehr_wunschtandem']));
    }


    //set matched, matchable.blade.php, preferences.blade.php, aufgerufen von moderation
    // TODO: setAssigned und setUnassigned zusammenlegen
    public function setAssigned(Request $request, $lehrid, $studid)
    {
        $lehr = User::find($lehrid);
        $stud = User::find($studid);

        $lehr->is_available = false;
        $stud->is_available = false;

        $lehr->save();
        $stud->save();

        $lehr->matchable()->updateExistingPivot($stud, ['is_matched' => true]);

        return back();
    }

    //set unmatched, matchable.blade.php, preferences.blade.php, aufgerufen von moderation
    public function setUnassigned(Request $request, $lehrid, $studid)
    {
        $lehr = User::find($lehrid);
        $stud = User::find($studid);

        $lehr->is_available = true;
        $stud->is_available = true;

        $lehr->save();
        $stud->save();

        $lehr->matchable()->updateExistingPivot($stud, ['is_matched' => false]);

        return back();
    }


    public function notifyMatchings($schulart = null)
    {
        // nur die, die in der vorauswahl (is_matched) sind
        $unnotified_matchings = DB::table('lehr_stud')->where('is_matched', true)->get();

        foreach ($unnotified_matchings as $unnotified_matching) {

            $lehr = User::find($unnotified_matching->lehr_id);
            $stud = User::find($unnotified_matching->stud_id);

            if (lcfirst($lehr->survey_data->schulart) == lcfirst($schulart)) {
                try {
                    $lehr->notify(new MatchingProposal());
                } catch (\Exception $e) {
                    $lehr->email_still_exists = false;
                    $lehr->save();
                }

                try {
                    $stud->notify(new MatchingProposal());
                } catch (\Exception $e) {
                    $stud->email_still_exists = false;
                    $stud->save();
                }

                // von vorauswahl zu fest vorgeschlagen
                $lehr->matchable()->syncWithoutDetaching([$stud->id => ['is_matched' => false, 'is_notified' => true]]);
            }

        }

        return back();
    }

    public function acceptMatching(Request $request)
    {
        $lehr = User::find($request->input('lehrid'));
        $stud = User::find($request->input('studid'));
        if ($request->input('role') == 'Lehr') {
            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['is_accepted_lehr' => true]]);
        }

        if ($request->input('role') == 'Stud') {
            $stud->matchable()->syncWithoutDetaching([$lehr->id => ['is_accepted_stud' => true]]);
        }

        // notify if matching was successful
        $matching = LehrStud::where('lehr_id', $lehr->id)->where('stud_id', $stud->id)->first();
        if($matching->is_accepted_lehr && $matching->is_accepted_stud) {
            try {
                $lehr->notify(new MatchingSuccess());
            } catch (\Exception $e) {
                $lehr->email_still_exists = false;
                $lehr->save();
            }

            try {
                $stud->notify(new MatchingSuccess());
            } catch (\Exception $e) {
                $stud->email_still_exists = false;
                $stud->save();
            }
        }

        return back();
    }

    public function declineMatching(Request $request)
    {
        $lehr = User::find($request->input('lehrid'));
        $stud = User::find($request->input('studid'));

        // dissolve matching
        $lehr->is_available = true;
        $stud->is_available = true;
        $lehr->save();
        $stud->save();

        // TODO: check if declined matchings are deleted, keep or delete?
        if ($request->input('role') == 'Lehr') {
            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['is_accepted_lehr' => false]]);
        }

        if ($request->input('role') == 'Stud') {
            $stud->matchable()->syncWithoutDetaching([$lehr->id => ['is_accepted_stud' => false]]);
        }

        DeclinedMatching::create([
            'lehr_id' => $request->input('lehrid'),
            'stud_id' => $request->input('studid'),
            'role' => $request->input('role'),
            'schulart' => $lehr->survey_data->schulart,
            'text' => $request->input('text')
        ]);

        return back();
    }

    public function resetMatching($lehr_id, $stud_id)
    {

        $lehr = User::find($lehr_id);
        $stud = User::find($stud_id);

        $lehr->is_available = true;
        $stud->is_available = true;
        $lehr->save();
        $stud->save();

        // TODO: alternativ einfach delete, da einträge sowieso neu berechnet werden
        DB::table('lehr_stud')->where('lehr_id', $lehr_id)->where('stud_id', $stud_id)->update(['is_accepted_lehr' => null, 'is_accepted_stud' => null, 'is_matched' => false, 'is_notified' => false]);

        return back();
    }


    // View: Nav->Tandems, Übersicht über schwebende, angenommene und abgelehnte Matchings
    public function acceptedMatchings(Request $request, $schulart = null)
    {

        // unentschiedene Matchings
        $notified_matchings = DB::table('lehr_stud')->where('is_notified', true)
            ->where(function ($query) { 
                $query->whereNull('is_accepted_lehr')->where('is_accepted_stud', true)
                      ->orWhere(function ($query) {
                        $query->where('is_accepted_lehr', true)->whereNull('is_accepted_stud');
                        })
                      ->orWhere(function ($query) {
                        $query->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud');
                        });
            })->get();
        $notified_matchings = $this->filter_schulart($notified_matchings, $schulart);

        foreach ($notified_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        // akzeptierte Matchings
        $accepted_matchings = DB::table('lehr_stud')->where('is_accepted_lehr', true)->where('is_accepted_stud', true)->get();
        $accepted_matchings = $this->filter_schulart($accepted_matchings, $schulart);

        foreach ($accepted_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        // abgelehnte Matchings
        $declined_matchings = DB::table('lehr_stud')->where(function ($query) {
            $query->where('is_accepted_lehr', false)->orWhere('is_accepted_stud', false);
        })->get();
        $declined_matchings = $this->filter_schulart($declined_matchings, $schulart);

        foreach ($declined_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        return view('accepted_matchings', compact(['schulart', 'notified_matchings', 'accepted_matchings', 'declined_matchings']));
    }

    // View: Nav->Abgelehnte Tandems
    public function declinedMatchings(Request $request, $schulart = null)
    {

        // Abgelehnt von | Rolle | Schulart | Text | Vorgeschlagen
        $all = DeclinedMatching::all();
        $declined_matchings = [];
        foreach(DeclinedMatching::all() as $declined) {

            $lehr = User::find($declined->lehr_id);
            $stud = User::find($declined->stud_id);

            $role = ucfirst($declined->role);
            if($role == 'Lehr') {
                $d = [
                    isset($lehr) ? "$lehr->vorname $lehr->nachname" : "Account nicht mehr vorhanden.",
                    $lehr->email,
                    $role,
                    $declined->schulart,
                    $declined->text,
                    isset($stud) ? "$stud->vorname $stud->nachname" : "Account nicht mehr vorhanden.",
                    isset($stud->email) ? $stud->email : null
                ];
            } elseif($role == 'Stud') {
                $d = [
                    isset($stud) ? "$stud->vorname $stud->nachname" : "Account nicht mehr vorhanden.",
                    $stud->email,
                    $role,
                    $declined->schulart,
                    $declined->text,
                    isset($lehr) ? "$lehr->vorname $lehr->nachname" : "Account nicht mehr vorhanden.",
                    isset($lehr->email) ? $lehr->email : null
                ];
            }
            $declined_matchings[] = $d;
        }

        return view('declined_matchings', compact(['declined_matchings']));
    }

}
