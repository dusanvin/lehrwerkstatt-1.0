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
use App\Http\Controllers\FilterController;


class MatchingController extends Controller
{

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

    private function getMatchedLehr($schulart) {
        // Lehrer, die in der Vorauswahl sind nach Schulart filtern
        return User::whereIn('id', LehrStud::where('is_matched', true)->pluck('lehr_id'))
            ->when($schulart, function($query, $schulart) {
                return $query->where('survey_data->schulart', $schulart);
            })
            ->orderBy('nachname', 'asc')
            ->get();
    }

    private function updateMatchings($schulart = null) 
    {
        // verbleibende mögliche und nicht vergebene Matchings werden nach einer getätigten Auswahl gelöscht,
        // da manche dadurch nicht mehr möglich sein könnten, werden dann neu berechnet
        LehrStud::where('is_matched', false)->where('is_notified', false)->delete();

        // bei verbleibenden matchings recommended auf false setzen
        // bleiben unverändert, da diese zwischen assigned nutzern bestehen und im folgenden ausschließlich beziehungen zwischen available nutzern 
        LehrStud::query()->update(['recommended' => 0]);

        // matchings die bereits abgelehnt wurden, bleiben erhalten da is_notified==true
        $declined_matchings = LehrStud::where('is_accepted_lehr', false)->orWhere('is_accepted_stud', false)->get();


        $graph = new Graph();
        $source_vertex = $graph->createVertex('s');
        $sink_vertex = $graph->createVertex('t');

        // Nutzer für den Matchingalgorithmus
        $available_lehr = FilterController::getAvailableUsers($schulart, 'Lehr');
        $available_stud = FilterController::getAvailableUsers($schulart, 'Stud');

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

        // mögliche matchings werden neu berechnet und einträge erstellt
        foreach ($available_lehr as $lehr) {

            foreach ($available_stud as $stud) {

                // abgelehnte matchings nicht mehr berechnen
                $decline = false;
                foreach($declined_matchings as $declined_matching) {
                    if ($declined_matching->lehr_id == $lehr->id && $declined_matching->stud_id == $stud->id) {
                        $decline = true;
                    }
                }

                if ($decline) {
                    continue;
                }


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
                        } elseif ($lehr->survey_data->schulart == 'Mittelschule') {  // TODO: landkreise nachfragen
                            $lehr_vertex = $graph->getVertex($lehr->id);
                            $stud_vertex = $graph->getVertex($stud->id);
                            $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                            $edge->setCapacity(1);

                            $mse = $this->mse($lehr, $stud);
                            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);
                        }
                    } elseif ($lehr->survey_data->schulart == 'Mittelschule') {  // TODO: falls keine landkreise
                        $lehr_vertex = $graph->getVertex($lehr->id);
                        $stud_vertex = $graph->getVertex($stud->id);
                        $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                        $edge->setCapacity(1);
    
                        $mse = $this->mse($lehr, $stud);
                        $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);
                    }
                } 
            }
        }

        // TODO: aufwendigen algorithmus optional in UI machen
        // https://github.com/graphp/algorithms/blob/0.9.x/src/MaxFlow/EdmondsKarp.php
        $ek = new EdmondsKarp($source_vertex, $sink_vertex);
        $resultGraph = $ek->createGraph();  // graph that maximizes matchings

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
        

        $assigned_lehr = FilterController::getAssignedUsers($schulart, 'Lehr');
        $assigned_stud = FilterController::getAssignedUsers($schulart, 'Stud');

        // view: matchings mit nur einem möglichen partner
        $recommended = LehrStud::where('recommended', true)
            ->orderBy('mse', 'asc')
            ->get();
        
        // view: remaining matches
        $remaining_matches = LehrStud::where('recommended', false)
            ->where('is_matched', false)
            ->where('is_notified', false)
            ->orderBy('mse', 'asc')
            ->get();

        return view('matchable', compact('schulart', 'matched_lehr', 'recommended', 'remaining_matches'));
    }

    // View: Nav->Wunschtandems
    public function preferences($schulart = null)
    {
        $this->updateMatchings();

        // view: vorauswahl
        $matched_lehr = $this->getMatchedLehr($schulart);  


        $available_lehr = FilterController::getAvailableUsers($schulart, 'Lehr');
        $available_stud = FilterController::getAvailableUsers($schulart, 'Stud');

        $wunschtandem_lehr = $available_lehr->reject(function ($lehr, $key) {
            return !isset($lehr->survey_data->wunschtandem);
        });
        $matchings_lehr_stud_wunschtandem = LehrStud::where('is_matched', false)->where('is_notified', false)
            ->whereIn('lehr_id', $wunschtandem_lehr->pluck('id'))->orderBy('lehr_id', 'asc')->orderBy('mse', 'asc')->get();

        $wunschtandem_stud = $available_stud->reject(function ($stud, $key) {
            return !(isset($stud->survey_data->wunschtandem) || isset($stud->survey_data->wunschorte));
        });
        $matchings_stud_lehr_wunschtandem = LehrStud::where('is_matched', false)->where('is_notified', false)
            ->whereIn('stud_id', $wunschtandem_stud->pluck('id'))->orderBy('stud_id', 'asc')->orderBy('mse', 'asc')->get();


        return view('matchings.preferences', compact(['schulart', 'matched_lehr', 'matchings_lehr_stud_wunschtandem', 'matchings_stud_lehr_wunschtandem']));
    }


    //set matched, matchable.blade.php, preferences.blade.php, aufgerufen von moderation
    // TODO: setAssigned und setUnassigned zusammenlegen
    public function setAssigned($lehrid, $studid)
    {
        User::whereIn('id', [$lehrid, $studid])->update(['is_available' => false]);
        LehrStud::where('lehr_id', $lehrid)->where('stud_id', $studid)->update(['is_matched' => true]);
        return back();
    }

    //set unmatched, matchable.blade.php, preferences.blade.php, aufgerufen von moderation
    public function setUnassigned($lehrid, $studid)
    {
        User::whereIn('id', [$lehrid, $studid])->update(['is_available' => true]);
        LehrStud::where('lehr_id', $lehrid)->where('stud_id', $studid)->update(['is_matched' => false]);
        return back();
    }


    public function notifyMatchings($schulart = null)
    {
        // nur die, die in der vorauswahl (is_matched) sind
        $unnotified_matchings = LehrStud::where('is_matched', true)->get();

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
        // TODO: nutzer können wieder nach is_available = true gematched werden! wie verhindern?
        // evtl bei jedem nutzer eine liste anlegen, mit nutzer mit denen er nicht gematched werden möchte, die er selber resetten kann?
        $lehr->is_available = true;
        $stud->is_available = true;
        $lehr->save();
        $stud->save();

        // einträge werden nicht gelöscht, wegen is_notified == true
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

    // TODO: email an betroffene nutzer senden, im view abgelehnte matchings entfernen da es einen eigenen view gibt oder im view durch declined matchings model ersetzen!
    // was wenn nutzer doch gematched werden wollen?
    // wie merken das in zukunft user nicht mehr gematched werden?
    public function resetMatching($lehr_id, $stud_id)
    {
        $lehr = User::find($lehr_id);
        $stud = User::find($stud_id);

        // TODO: nutzer können wieder nach is_available = true gematched werden! wie verhindern?
        // evtl bei jedem nutzer eine liste anlegen, mit nutzer mit denen er nicht gematched werden möchte, die er selber resetten kann?
        $lehr->is_available = true;
        $stud->is_available = true;
        $lehr->save();
        $stud->save();

        // is_notified == true verhindert löschung in updateMatchings(), eintrag hier einfach löschen
        LehrStud::where('lehr_id', $lehr_id)->where('stud_id', $stud_id)->delete();

        return back();
    }


    // View: Nav->Tandems, Übersicht über schwebende, angenommene und abgelehnte Matchings
    public function acceptedMatchings(Request $request, $schulart = null)
    {

        // unentschiedene Matchings
        $notified_matchings = LehrStud::with(['lehr', 'stud'])
            ->where('is_notified', true)
            ->where(function ($query) { 
                $query->whereNull('is_accepted_lehr')->where('is_accepted_stud', true)
                      ->orWhere(function ($query) {
                        $query->where('is_accepted_lehr', true)->whereNull('is_accepted_stud');
                        })
                      ->orWhere(function ($query) {
                        $query->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud');
                        });
            })
            ->when($schulart, function ($query, $schulart) {
                $query->whereHas('lehr', function ($q) use ($schulart) {
                    $q->where(function ($query) use ($schulart) {
                        $query->where('survey_data->schulart', $schulart);
                    });
                });
            })
            ->get();

        // akzeptierte Matchings
        $accepted_matchings = LehrStud::with(['lehr', 'stud'])
            ->where('is_accepted_lehr', true)->where('is_accepted_stud', true)
            ->when($schulart, function ($query, $schulart) {
                $query->whereHas('lehr', function ($q) use ($schulart) {
                    $q->where(function ($query) use ($schulart) {
                        $query->where('survey_data->schulart', $schulart);
                    });
                });
            })
            ->get();

        // abgelehnte Matchings
        $declined_matchings = LehrStud::with(['lehr', 'stud'])
            ->where(function ($query) {
                $query->where('is_accepted_lehr', false)->orWhere('is_accepted_stud', false);
            })
            ->when($schulart, function ($query, $schulart) {
                $query->whereHas('lehr', function ($q) use ($schulart) {
                    $q->where(function ($query) use ($schulart) {
                        $query->where('survey_data->schulart', $schulart);
                    });
                });
            })
            ->get();

        return view('accepted_matchings', compact(['schulart', 'notified_matchings', 'accepted_matchings', 'declined_matchings']));
    }

    // View: Nav->Abgelehnte Tandems
    public function declinedMatchings(Request $request, $schulart = null)
    {
        // Lehrkraft | Student*in | Abgelehnt von | Schulart | Text
        return view('declined_matchings', ['declined_matchings' => DeclinedMatching::with(['lehr', 'stud'])->get()]);
    }

}
