<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\LehrStud;
use DB;
use App\Notifications\MatchingProposal;
use Carbon\Carbon;
use Exception;
use Fhaculty\Graph\Graph;
use Graphp\Algorithms\MaxFlow;
use Graphp\Algorithms\MaxFlow\EdmondsKarp;

use Graphp\GraphViz\GraphViz;
use Illuminate\Auth\Notifications\VerifyEmail;

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


    private function getAvailableLehrUsers() {
        return User::where('role', 'Lehr')->where('is_evaluable', true)->where('is_available', true)->get();
    }


    private function getAvailableStudUsers() {
        return User::where('role', 'Stud')->where('is_evaluable', true)->where('is_available', true)->get();
    }


    private function getAvailableUsers() {
        return User::where('is_evaluable', true)->where('is_available', true)->get();
    }


    private function getAssignedLehrUsers() {
        return User::where('role', 'Lehr')->where('is_evaluable', true)->where('is_available', false)->get();
    }


    private function getAssignedStudUsers() {
        return User::where('role', 'Stud')->where('is_evaluable', true)->where('is_available', false)->get();
    }


    private function getAssignedUsers() {
        return User::where('is_evaluable', true)->where('is_available', false)->get();
    }


    public function matchable()
    {
        $graph = new Graph();
        $source_vertex = $graph->createVertex('s');
        $sink_vertex = $graph->createVertex('t');


        // user ausschließen, die nicht mehr gematched werden wollen, aber in der vorauswahl sind
        $exclude_ids = User::where('is_evaluable', false)->where('is_available', false)->pluck('id');

        DB::table('lehr_stud')->where('is_matched', false)->where('is_notified', false)->delete();

        // user deren matchings aufgehoben werden müssen wieder auf available gesetzt werden
        $inactive_matched_users = User::where('is_evaluable', false)->where('is_available', false)->get();  // ->update(['is_available' => true]);
        foreach($inactive_matched_users as $user) {
            $user->is_available = true;
            $user->save();
            // dd($user->matched_user); // null
            User::where('id', $user->matched_user->id)->update(['is_available' => true]);
        }

        DB::table('lehr_stud')->whereIn('lehr_id', $exclude_ids)->delete();
        DB::table('lehr_stud')->whereIn('stud_id', $exclude_ids)->delete();

        DB::table('lehr_stud')->update(['recommended' => 0, 'has_no_alternative_lehr' => 0, 'has_no_alternative_stud' => 0]); // ->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud')


        $available_lehr = $this->getAvailableLehrUsers();
        $available_stud = $this->getAvailableStudUsers();

        foreach ($available_lehr as $lehr) {
            $lehr->survey_data = json_decode($lehr->survey_data);

            $lehr_vertex = $graph->createVertex($lehr->id);
            $lehr_vertex->setAttribute('data', $lehr->survey_data);
            $edge = $source_vertex->createEdgeTo($lehr_vertex);
            $edge->setCapacity(1);

            // $lehr_vertex->setAttribute('graphviz.shape', 'box');
            $lehr_vertex->setAttribute('graphviz.label', $lehr->vorname . ' ' . $lehr->nachname);
            // $lehr_vertex->setAttribute('graphviz.fontname', 'arial');
            // $lehr_vertex->setAttribute('graphviz.fontcolor', 'white');
            // $lehr_vertex->setAttribute('graphviz.color', 'grey');
        }

        foreach ($available_stud as $stud) {
            $stud->survey_data = json_decode($stud->survey_data);

            $stud_vertex = $graph->createVertex($stud->id);
            $stud_vertex->setAttribute('data', $stud->survey_data);
            $edge = $stud_vertex->createEdgeTo($sink_vertex);
            $edge->setCapacity(1);

            // $stud_vertex->setAttribute('graphviz.shape', 'box');
            $stud_vertex->setAttribute('graphviz.label', $stud->vorname . ' ' . $stud->nachname);
        }

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
                            $edge->setAttribute('graphviz.label', $mse . ', ');
                            // $lehr->matchable()->attach($stud, ['mse' => $mse]);
                            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);

                        } elseif (array_intersect($lehr->survey_data->faecher, $stud->survey_data->faecher)) {
                            $lehr_vertex = $graph->getVertex($lehr->id);
                            $stud_vertex = $graph->getVertex($stud->id);
                            $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                            $edge->setCapacity(1);

                            $mse = $this->mse($lehr, $stud);
                            $edge->setAttribute('graphviz.label', $mse . ', ');
                            // $lehr->matchable()->attach($stud, ['mse' => $mse]);
                            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);

                        }
                    }
                }
            }
        }

        $ek = new EdmondsKarp($source_vertex, $sink_vertex);

        $resultGraph = $ek->createGraph();
        $source_vertex = $resultGraph->getVertex('s');
        foreach ($source_vertex->getEdges() as $edge) {
            if ($edge->getFlow() == 1) {
                $lehr_vertex = $edge->getVertexEnd();
                foreach ($lehr_vertex->getEdges() as $edge) {
                    if ($edge->getFlow() == 1 && $edge->getVertexStart() != 's') {
                        $edge->setAttribute('graphviz.color', 'yellow');
                        $edge->setAttribute('graphviz.dir', 'none');
                        $stud_vertex = $edge->getVertexEnd();

                        $lehr = User::find($lehr_vertex->getId());

                        if(count($lehr_vertex->getEdgesOut()) == 1) {
                            $has_no_alternative_lehr = true;
                            // $edge->setAttribute('graphviz.color', 'yellow');
                        } else $has_no_alternative_lehr = false;

                        $stud = User::find($stud_vertex->getId());

                        if(count($stud_vertex->getEdgesIn()) == 1) {
                            $has_no_alternative_stud = true;
                            // $edge->setAttribute('graphviz.color', 'yellow');
                        } else $has_no_alternative_stud = false;

                        // $lehr->matchable()->syncWithoutDetaching([$stud->id => ['recommended' => true, 'has_no_alternative_lehr' => $has_no_alternative_lehr,'has_no_alternative_stud' => $has_no_alternative_stud]]);
                        $lehr->matchable()->updateExistingPivot($stud, ['recommended' => true, 'has_no_alternative_lehr' => $has_no_alternative_lehr,'has_no_alternative_stud' => $has_no_alternative_stud]);

                    } else {
                        $edge->setAttribute('graphviz.dir', 'none');
                    }
                }
            } else {
                $lehr_vertex = $edge->getVertexEnd();
                foreach ($lehr_vertex->getEdges() as $edge) {
                    $edge->setAttribute('graphviz.dir', 'none');
                }
            }
        }

        $max_flow = $ek->getFlowMax();
        $graphviz = new GraphViz();

        $resultGraph->getVertex('s')->destroy();
        $resultGraph->getVertex('t')->destroy();


        $assigned_lehr = $this->getAssignedLehrUsers();
        $assigned_stud = $this->getAssignedStudUsers();

        foreach ($assigned_lehr as $user) {
                if ($resultGraph->hasVertex($user->id)) {
                    $resultGraph->getVertex($user->id)->destroy();
                }
        }

        foreach ($assigned_stud as $user) {
            if ($resultGraph->hasVertex($user->id)) {
                $resultGraph->getVertex($user->id)->destroy();
            }
        }

        //ungültige paarungen mit is_notified raus
        $notified_matchings = DB::table('lehr_stud')->where('is_notified', true)->get();
        foreach($resultGraph->getEdges() as $edge) {
            $lehr_vertex = $edge->getVertexStart();
            $stud_vertex = $edge->getVertexEnd();
            foreach($notified_matchings as $matching) {
                if($lehr_vertex->getId() == $matching->lehr_id && $stud_vertex->getId() == $matching->stud_id) {
                    $edge->destroy();
                }
            }

        }

        foreach($resultGraph->getVertices() as $vertex) {
            if(count($vertex->getEdges()) == 0) {
                $vertex->destroy();
            }
        }

        $resultGraph->setAttribute('graphviz.graph.rankdir', 'LR');
        $resultGraph->setAttribute('graphviz.graph.bgcolor', 'transparent');
        // $graphviz->display($resultGraph);
        // $graphviz->setFormat('svg');

        $graph_img = $graphviz->createImageHtml($resultGraph);

        
        // $matched_graph = $resultGraph->createGraphClone();

        $matched_lehr = User::find(DB::table('lehr_stud')->where('is_matched', true)->pluck('lehr_id'));

        // foreach ($matched_graph->getEdges() as $edge) {

        //     $edge->setAttribute('graphviz.dir', 'none');
        //     $edge_lehr_id = $edge->getVertexStart()->getId();
        //     $edge_stud_id = $edge->getVertexEnd()->getId();

        //     foreach ($matchable_lehr as $lehr) {
        //         if ($edge_lehr_id == $lehr->id) {

        //             if ($lehr->matching_state == 'matched') {
        //                 if ($lehr->matched_user->id == $edge_stud_id) {
        //                     $edge->setAttribute('graphviz.color', 'green');
        //                     $edge->setAttribute('graphviz.dir', 'both');
        //                 } else {
        //                     $edge->setAttribute('graphviz.color', 'red');
        //                 }
        //             } else {
        //                 if (User::find($edge_stud_id)->matching_state == 'matched') {
        //                     $edge->setAttribute('graphviz.color', 'red');
        //                 } else {
        //                     $edge->setAttribute('graphviz.color', 'black');
        //                 }
        //             }
        //         }
        //     }
        // }
        // $matched_graph->setAttribute('graphviz.graph.rankdir', 'LR');
        // $matched_graph->setAttribute('graphviz.graph.bgcolor', 'transparent');
        // $matched_graph_img = $graphviz->createImageHtml($matched_graph);


        $recommended = DB::table('lehr_stud')->where('recommended', true)->where('is_notified', false)->whereNotIn('lehr_id', $assigned_lehr->pluck('id'))->whereNotIn('stud_id', $assigned_stud->pluck('id'))->orderBy('mse', 'asc')->get();
        foreach ($recommended as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            // $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        $recommended->reject(function($match, $key) {
            return !$match->lehr->is_evaluable || !$match->stud->is_evaluable;
        });

        // $remaining_recommended = DB::table('lehr_stud')->where('recommended', true)->where('is_notified', false)->whereNotIn('lehr_id', $assigned_lehr->pluck('id'))->whereNotIn('stud_id', $assigned_stud->pluck('id'))->where('has_no_alternative_lehr', false)->where('has_no_alternative_stud', false)->get();

        // foreach ($remaining_recommended as $am) {
        //     $am->lehr = User::find($am->lehr_id);
        //     $am->stud = User::find($am->stud_id);
        //     $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        // }


        $remaining_matches = DB::table('lehr_stud')->where('is_notified', false)->whereNotIn('lehr_id', $assigned_lehr->pluck('id'))->whereNotIn('stud_id', $assigned_stud->pluck('id'))->orderBy('mse', 'asc')->get();

        foreach ($remaining_matches as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            // $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        $remaining_matches->reject(function($match, $key) {
            return !$match->lehr->is_evaluable || !$match->stud->is_evaluable;
        });

        return view('matchable', compact('graph_img', 'max_flow', 'matched_lehr', 'recommended', 'remaining_matches'));
    }


    // updates current status of each possible matching regarding the current available users
    private function updateMatchings() {

        // init
        $graph = new Graph();
        $source_vertex = $graph->createVertex('s');
        $sink_vertex = $graph->createVertex('t');


        $available_lehr = $this->getAvailableLehrUsers();
        $available_stud = $this->getAvailableStudUsers();

        DB::table('lehr_stud')->update(['recommended' => 0]);

        foreach ($available_lehr as $lehr) {
            $lehr->survey_data = json_decode($lehr->survey_data);

            $lehr_vertex = $graph->createVertex($lehr->id);
            $edge = $source_vertex->createEdgeTo($lehr_vertex);
            $edge->setCapacity(1);
        }

        foreach ($available_stud as $stud) {
            $stud->survey_data = json_decode($stud->survey_data);

            $stud_vertex = $graph->createVertex($stud->id);
            $edge = $stud_vertex->createEdgeTo($sink_vertex);
            $edge->setCapacity(1);
        }

        // create edges
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

                        } elseif (array_intersect($lehr->survey_data->faecher, $stud->survey_data->faecher)) {

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
        }

        // max flow algorithm
        $ek = new EdmondsKarp($source_vertex, $sink_vertex);
        $resultGraph = $ek->createGraph();


        // check recommended
        $source_vertex = $resultGraph->getVertex('s');

        foreach ($source_vertex->getEdges() as $edge) {
            if ($edge->getFlow() == 1) {
                $lehr_vertex = $edge->getVertexEnd();

                foreach ($lehr_vertex->getEdges() as $edge) {
                    if ($edge->getFlow() == 1 && $edge->getVertexStart() != 's') {

                        $stud_vertex = $edge->getVertexEnd();
                        $lehr = User::find($lehr_vertex->getId());

                        if(count($lehr_vertex->getEdgesOut()) == 1) {
                            $has_no_alternative_lehr = true;
                        } else $has_no_alternative_lehr = false;

                        $stud = User::find($stud_vertex->getId());

                        if(count($stud_vertex->getEdgesIn()) == 1) {
                            $has_no_alternative_stud = true;
                        } else $has_no_alternative_stud = false;

                        // $lehr->matchable()->syncWithoutDetaching([$stud->id => ['recommended' => true, 'has_no_alternative_lehr' => $has_no_alternative_lehr,'has_no_alternative_stud' => $has_no_alternative_stud]]);
                        $lehr->matchable()->updateExistingPivot($stud, ['recommended' => true, 'has_no_alternative_lehr' => $has_no_alternative_lehr,'has_no_alternative_stud' => $has_no_alternative_stud]);
                    
                    }
                }
            }
        }

        // $max_flow = $ek->getFlowMax();
    }


    public function preferences($schulart=null) {

        $this->updateMatchings();

        $assigned_lehr_ids = LehrStud::where('is_matched', true)->orWhere('is_notified', true)->pluck('lehr_id');
        $assigned_stud_ids = LehrStud::where('is_matched', true)->orWhere('is_notified', true)->pluck('stud_id');

        if(isset($schulart)) {
            $unassigned = User::where('is_evaluable', true)->where('is_available', true)->where('survey_data->schulart', $schulart)->get();
        } else {
            $unassigned = User::where('is_evaluable', true)->where('is_available', true)->get();
        }
        

        $wunschtandem_lehr = $unassigned->where('role', 'Lehr')->reject(function ($lehr, $key) {
            !isset($lehr->data()->wunschtandem);
        });
        $matchings_lehr_stud_wunschtandem = LehrStud::where('is_matched', false)->where('is_notified', false)->whereIn('lehr_id', $wunschtandem_lehr->pluck('id'))->orderBy('lehr_id', 'asc')->orderBy('mse', 'asc')->get();

        $wunschtandem_stud = $unassigned->where('role', 'Stud')->reject(function ($stud, $key) {
            !(isset($stud->data()->wunschtandem) || isset($stud->data()->wunschorte));
        });
        $matchings_stud_lehr_wunschtandem = LehrStud::where('is_matched', false)->where('is_notified', false)->whereIn('stud_id', $wunschtandem_stud->pluck('id'))->orderBy('stud_id', 'asc')->orderBy('mse', 'asc')->get();


        $matched_lehr = User::find(LehrStud::where('is_matched', true)->pluck('lehr_id'));

        return view('matchings.preferences', compact(['schulart', 'matched_lehr', 'matchings_lehr_stud_wunschtandem', 'matchings_stud_lehr_wunschtandem']));

    }

    //set matched
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

    //set unmatched
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


    public function acceptMatching(Request $request)
    {
        $lehr = User::find($request->input('lehrid'));
        $stud = User::find($request->input('studid'));
        // $matching = DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->first();
        if ($request->input('role') == 'Lehr') {
            // DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->update([
            //     'is_accepted_lehr' => true
            // ]);
            // $lehr->matchable()->updateExistingPivot($stud, ['is_accepted_lehr' => true]);
            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['is_accepted_lehr' => true]]);
        }

        if ($request->input('role') == 'Stud') {
            // DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->update([
            //     'is_accepted_stud' => true
            // ]);
            // $stud->matchable()->updateExistingPivot($stud, ['is_accepted_stud' => true]);
            $stud->matchable()->syncWithoutDetaching([$lehr->id => ['is_accepted_stud' => true]]);
        }

        return back();
    }


    public function declineMatching(Request $request)
    {
        $lehr = User::find($request->input('lehrid'));
        $stud = User::find($request->input('studid'));

        $lehr->is_available = true;
        $stud->is_available = true;

        $lehr->save();
        $stud->save();

        // $matching = DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->first();
        if ($request->input('role') == 'Lehr') {
            // DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->update([
            //     'is_accepted_lehr' => false
            // ]);
            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['is_accepted_lehr' => false]]);
        }

        if ($request->input('role') == 'Stud') {
            // DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->update([
            //     'is_accepted_stud' => false
            // ]);
            $stud->matchable()->syncWithoutDetaching([$lehr->id => ['is_accepted_stud' => false]]);
        }

        return back();
    }


    public function notifyMatchings()
    {
        // nur die, die in der vorauswahl (is_matched) sind
        $unnotified_matchings = DB::table('lehr_stud')->where('is_matched', true)->get();

        foreach ($unnotified_matchings as $unnotified_matching) {

            try {
                $lehr = User::find($unnotified_matching->lehr_id);
                $lehr->notify(new MatchingProposal());
            } catch (\Exception $e) {
                $lehr->email_still_exists = false;
                $lehr->save();
            }

            try {
                $stud = User::find($unnotified_matching->stud_id);
                $stud->notify(new MatchingProposal());
            } catch (\Exception $e) {
                $stud->email_still_exists = false;
                $stud->save();
            }

            $lehr->is_available = false;
            $stud->is_available = false;

            $lehr->save();
            $stud->save();

            // DB::table('lehr_stud')->where('lehr_id', $lehr->id)->where('stud_id', $stud->id)->update(['created_at' => Carbon::now(), 'is_notified' => true]);

            // is_matched muss nach dem folgenden aufruf false werden
            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['is_matched' => false, 'is_notified' => true]]);
        }

        return back();
    }


    public function resetMatching($lehr_id, $stud_id) {

        $lehr = User::find($lehr_id);
        $stud = User::find($stud_id);

        $lehr->is_available = true;
        $stud->is_available = true;

        $lehr->save();
        $stud->save();

        DB::table('lehr_stud')->where('lehr_id', $lehr_id)->where('stud_id', $stud_id)->update(['is_accepted_lehr' => null, 'is_accepted_stud' => null, 'is_matched' => false, 'is_notified' => false]);
        
        return back();
    }


    public function acceptedMatchings(Request $request)
    {
        $notified_matchings = DB::table('lehr_stud')->where('is_notified', true)->where(function ($query) {

                                $query->whereNull('is_accepted_lehr')->where('is_accepted_stud', true)->orWhere(function ($query) {
                                        $query->where('is_accepted_lehr', true)->whereNull('is_accepted_stud');
                                    })->orWhere(function ($query) {
                                        $query->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud');
                                    });
                            })->get();

        foreach ($notified_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        $accepted_matchings = DB::table('lehr_stud')->where('is_accepted_lehr', true)->where('is_accepted_stud', true)->get();
        foreach ($accepted_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        $declined_matchings = DB::table('lehr_stud')->where(function ($query) {
            $query->where('is_accepted_lehr', false)->orWhere('is_accepted_stud', false);
        })->get();
        foreach ($declined_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        return view('accepted_matchings', compact(['notified_matchings', 'accepted_matchings', 'declined_matchings']));
    }


    public function matchings(Request $request) {

        $this->updateMatchings();

        $matched = DB::table('lehr_stud')->where('is_matched', true)->where('is_notified', false)->get();
        foreach ($matched as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        $strongly_recommended = DB::table('lehr_stud')->where('is_matched', false)->where('is_notified', false)->where(function ($query) {
            $query->where('has_no_alternative_lehr', true)->orWhere('has_no_alternative_stud', true);
        })->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud')->get();
        foreach ($strongly_recommended as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        $remaining_recommended = DB::table('lehr_stud')->where('is_matched', false)->where('is_notified', false)->where('recommended', true)->where('has_no_alternative_lehr', false)->where('has_no_alternative_stud', false)->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud')->get();
        foreach ($remaining_recommended as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        // es kann lehrer geben die bei einem matching gemachted sind, aber bei anderen nicht: verhindern
        $matched_ids = DB::table('lehr_stud')->where('is_matched', true)->pluck('lehr_id');
        // $unmatched_ids = DB::table('lehr_stud')->where('is_matched', false)->where('is_notified', false)->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud')->distinct()->pluck('lehr_id');
        $unmatched_ids = DB::table('lehr_stud')->where('is_matched', false)->where('is_notified', false)->distinct()->pluck('lehr_id');


        $unmatched_lehr = User::find($unmatched_ids->diff($matched_ids));

        // $unmatched = DB::table('lehr_stud')->where('is_matched', false)->where('is_notified', false)->get();
        // foreach ($unmatched as $am) {
        //     $am->lehr = User::find($am->lehr_id);
        //     $am->stud = User::find($am->stud_id);
        //     $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        // }

        return view('matchings', compact('matched', 'strongly_recommended', 'remaining_recommended', 'unmatched_lehr'));
    }


}
