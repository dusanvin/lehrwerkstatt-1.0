<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
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


    public function matchable()
    {
        $graph = new Graph();
        $source_vertex = $graph->createVertex('s');
        $sink_vertex = $graph->createVertex('t');


        $all_lehr = User::where('role', 'Lehr')->where('is_evaluable', true)->get();
        $all_stud = User::where('role', 'Stud')->where('is_evaluable', true)->get();

        // DB::table('lehr_stud_matchable')->truncate();

        foreach ($all_lehr as $lehr) {
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

        foreach ($all_stud as $stud) {
            $stud->survey_data = json_decode($stud->survey_data);

            $stud_vertex = $graph->createVertex($stud->id);
            $stud_vertex->setAttribute('data', $stud->survey_data);
            $edge = $stud_vertex->createEdgeTo($sink_vertex);
            $edge->setCapacity(1);

            // $stud_vertex->setAttribute('graphviz.shape', 'box');
            $stud_vertex->setAttribute('graphviz.label', $stud->vorname . ' ' . $stud->nachname);
        }

        foreach ($all_lehr as $lehr) {

            foreach ($all_stud as $stud) {

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
                        $edge->setAttribute('graphviz.color', 'blue');
                        $edge->setAttribute('graphviz.dir', 'both');
                        $stud_vertex = $edge->getVertexEnd();

                        $lehr = User::find($lehr_vertex->getId());

                        if(count($lehr_vertex->getEdgesOut()) == 1) {
                            $has_no_alternative_lehr = true;
                            $edge->setAttribute('graphviz.color', 'yellow');
                        } else $has_no_alternative_lehr = false;

                        $stud = User::find($stud_vertex->getId());

                        if(count($stud_vertex->getEdgesIn()) == 1) {
                            $has_no_alternative_stud = true;
                            $edge->setAttribute('graphviz.color', 'yellow');
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

        // $evaluable_users = User::where('is_evaluable', true)->get();
        // foreach ($evaluable_users as $user) {
        //     if (!$user->is_matchable) {
        //         if ($resultGraph->hasVertex($user->id)) {
        //             $resultGraph->getVertex($user->id)->destroy();
        //         }
        //     }
        // }

        // $notified_lehr = User::find(DB::table('lehr_stud')->where('is_notified', true)->pluck('lehr_id'));
        // $notified_stud = User::find(DB::table('lehr_stud')->where('is_notified', true)->pluck('stud_id'));

        $assigned_lehr_ids = DB::table('lehr_stud')->where('is_matched', true)->orWhere('is_notified', true)->pluck('lehr_id');
        $assigned_stud_ids = DB::table('lehr_stud')->where('is_matched', true)->orWhere('is_notified', true)->pluck('stud_id');

        $assigned_lehr = User::find($assigned_lehr_ids);
        $assigned_stud = User::find($assigned_stud_ids);

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

        $matched_lehr = User::find(DB::table('lehr_stud')->where('is_matched', true)->where('is_notified', false)->pluck('lehr_id'));

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


        $strongly_recommended = DB::table('lehr_stud')->where('recommended', true)->whereNotIn('lehr_id', $assigned_lehr_ids)->whereNotIn('stud_id', $assigned_stud_ids)->where(function ($query) {
            $query->where('has_no_alternative_lehr', true)->orWhere('has_no_alternative_stud', true);
        })->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud')->get();
        foreach ($strongly_recommended as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        $remaining_recommended = DB::table('lehr_stud')->where('recommended', true)->whereNotIn('lehr_id', $assigned_lehr_ids)->whereNotIn('stud_id', $assigned_stud_ids)->where('has_no_alternative_lehr', false)->where('has_no_alternative_stud', false)->get();

        foreach ($remaining_recommended as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }




        $remaining_matches = DB::table('lehr_stud')->whereNotIn('lehr_id', $assigned_lehr_ids)->whereNotIn('stud_id', $assigned_stud_ids)->orderBy('mse', 'asc')->get();

        foreach ($remaining_matches as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }


        return view('matchable', compact('graph_img', 'max_flow', 'matched_lehr', 'strongly_recommended', 'remaining_recommended', 'remaining_matches'));
    }

    //set matched
    public function setAssigned(Request $request, $lehrid, $studid)
    {
        $lehr = User::find($lehrid);
        $stud = User::find($studid);

        $lehr->matchable()->updateExistingPivot($stud, ['is_matched' => true]);

        return back();
    }

    //set unmatched
    public function setUnassigned(Request $request, $lehrid, $studid)
    {
        $lehr = User::find($lehrid);
        $stud = User::find($studid);

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


            // DB::table('lehr_stud')->where('lehr_id', $lehr->id)->where('stud_id', $stud->id)->update(['created_at' => Carbon::now(), 'is_notified' => true]);

            // is_matched muss nach dem folgenden aufruf false werden
            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['is_matched' => false, 'is_notified' => true]]);
        }

        return back();
    }


    public function resetMatching($lehr_id, $stud_id) {
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

        $graph = new Graph();
        $source_vertex = $graph->createVertex('s');
        $sink_vertex = $graph->createVertex('t');


        $all_lehr = User::where('role', 'Lehr')->where('is_evaluable', true)->get();
        $all_stud = User::where('role', 'Stud')->where('is_evaluable', true)->get();

        foreach ($all_lehr as $lehr) {
            $lehr->survey_data = json_decode($lehr->survey_data);

            $lehr_vertex = $graph->createVertex($lehr->id);
            $lehr_vertex->setAttribute('data', $lehr->survey_data);
            $edge = $source_vertex->createEdgeTo($lehr_vertex);
            $edge->setCapacity(1);
        }

        foreach ($all_stud as $stud) {
            $stud->survey_data = json_decode($stud->survey_data);

            $stud_vertex = $graph->createVertex($stud->id);
            $stud_vertex->setAttribute('data', $stud->survey_data);
            $edge = $stud_vertex->createEdgeTo($sink_vertex);
            $edge->setCapacity(1);
        }

        foreach ($all_lehr as $lehr) {

            foreach ($all_stud as $stud) {

                if ($lehr->survey_data->schulart == $stud->survey_data->schulart) {

                    if (in_array($lehr->survey_data->landkreis,  $stud->survey_data->landkreise)) {

                        if ($lehr->survey_data->schulart == 'Grundschule') {

                            $lehr_vertex = $graph->getVertex($lehr->id);
                            $stud_vertex = $graph->getVertex($stud->id);
                            $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                            $edge->setCapacity(1);

                            $mse = $this->mse($lehr, $stud);
                            $edge->setAttribute('graphviz.label', $mse . ', ');
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

        $ek = new EdmondsKarp($source_vertex, $sink_vertex);

        $resultGraph = $ek->createGraph();
        $source_vertex = $resultGraph->getVertex('s');

        foreach ($source_vertex->getEdges() as $edge) {
            if ($edge->getFlow() == 1) {
                $lehr_vertex = $edge->getVertexEnd();

                foreach ($lehr_vertex->getEdges() as $edge) {
                    if ($edge->getFlow() == 1 && $edge->getVertexStart() != 's') {
                        //recommended
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






    public function matchingsA(Request $request)
    {
        $lehr = User::where('role', 'lehr')->where('is_evaluable', true)->where('matching_state', 'unmatched')->get();
        $stud = User::where('role', 'stud')->where('is_evaluable', true)->where('matching_state', 'unmatched')->get();

        foreach ($stud as $current_stud) {
            $current_stud->survey_data = json_decode($current_stud->survey_data);
        }


        foreach ($lehr as $current_lehr) {

            $current_lehr->survey_data = json_decode($current_lehr->survey_data);
            $current_lehr->matchings = [];

            $matchings = [];

            foreach ($stud as $current_stud) {

                if ($current_lehr->survey_data->schulart == $current_stud->survey_data->schulart) {
                    if (in_array($current_lehr->survey_data->landkreis,  $current_stud->survey_data->landkreise)) {
                        if ($current_lehr->survey_data->schulart == 'Grundschule') {
                            $current_stud->count_matchings += 1;
                            $current_stud->mse = $this->mse($current_lehr, $current_stud);
                            $matchings[] = $current_stud;
                        } elseif (array_intersect($current_lehr->survey_data->faecher, $current_stud->survey_data->faecher)) {
                            if (in_array($current_lehr->survey_data->landkreis,  $current_stud->survey_data->landkreise)) {
                                $current_stud->count_matchings += 1;
                                $current_stud->mse = $this->mse($current_lehr, $current_stud);
                                $matchings[] = $current_stud;
                            }
                        }
                    }
                }
            }

            usort($matchings, array('App\Http\Controllers\MatchingController', 'compareMatchings'));


            $current_lehr->matchings = $matchings;

            $current_lehr->mses = [];
            $mses = [];
            if (count($matchings)) {
                foreach ($matchings as $matching) {
                    $mses[] = $matching->mse;
                }
                $current_lehr->mses = $mses;
            }

            if (isset($current_lehr->survey_data->faecher))
                $current_lehr->survey_data->faecher = implode(', ', $current_lehr->survey_data->faecher);
        }
        // alle studenten matchen für die nur ein lehrer gefunden wurde
        $unmatchable_lehr = [];
        $matchings = [];
        foreach ($lehr as $key => $current_lehr) {
            // falls lehrkraft keine matchings
            if (count($current_lehr->matchings) == 0) {
                $unmatchable_lehr[] = $current_lehr;
                $lehr->forget($key);
            } else
                foreach ($current_lehr->matchings as $current_stud) {
                    if ($current_stud->count_matchings == 1) {
                        // für diesen student gibt es genau nur diesen lehrer als matching
                        // da bereits sortiert wird stud mit besserem mse mit der lehrkräft falls mehrere studenten nur mit dieser lehrkraft können

                        $matching = [
                            'lehr' => $current_lehr,
                            'stud' => $current_stud
                        ];
                        $matchings[] = $matching;
                        $lehr->forget($key);

                        break; // nachdem der bestmöglich student daraus zugewiesen wurde abbruch
                    }
                }
        }
        $assigned_matchings = DB::table('lehr_stud')->where('is_notified', false)->get();
        $assigned = [];
        foreach ($assigned_matchings as $am) {
            $assigned_lehr = User::where('role', 'lehr')->where('is_evaluable', true)->where('matching_state', 'prematched')->where('id', $am->lehr_id)->get();
            $assigned_stud = User::where('role', 'stud')->where('is_evaluable', true)->where('matching_state', 'prematched')->where('id', $am->stud_id)->get();
            $assigned[] = ['lehr' => $assigned_lehr[0], 'stud' => $assigned_stud[0], 'is_accepted_lehr' => $am->is_accepted_lehr, 'is_accepted_stud' => $am->is_accepted_stud, 'mse' => $am->mse, 'elapsed_time' => Carbon::parse($am->created_at)->diffForHumans(Carbon::now())];
        }
        // dd($assigned_matchings);

        return view('matchings', ['users' => $lehr, 'matchings' => $matchings, 'assigned_matchings' => $assigned, 'unmatchable_lehr' => $unmatchable_lehr]);
    }
}
