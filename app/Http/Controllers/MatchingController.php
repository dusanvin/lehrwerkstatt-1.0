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

                            // User::find($lehr->id)->update(['is_matchable' => true]);
                            // User::find($stud->id)->update(['is_matchable' => true]);
                        } elseif (array_intersect($lehr->survey_data->faecher, $stud->survey_data->faecher)) {
                            $lehr_vertex = $graph->getVertex($lehr->id);
                            $stud_vertex = $graph->getVertex($stud->id);
                            $edge = $lehr_vertex->createEdgeTo($stud_vertex);
                            $edge->setCapacity(1);

                            $mse = $this->mse($lehr, $stud);
                            $edge->setAttribute('graphviz.label', $mse . ', ');
                            // $lehr->matchable()->attach($stud, ['mse' => $mse]);
                            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['mse' => $mse]]);

                            // User::find($lehr->id)->update(['is_matchable' => true]);
                            // User::find($stud->id)->update(['is_matchable' => true]);
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
                        $edge->setAttribute('graphviz.dir', 'both');
                        $stud_vertex = $edge->getVertexEnd();
                        $lehr = User::find($lehr_vertex->getId());
                        $stud = User::find($stud_vertex->getId());
                        $lehr->matchable()->updateExistingPivot($stud, ['recommended' => true]);
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

        $evaluable_users = User::where('is_evaluable', true)->get();
        foreach ($evaluable_users as $user) {
            if (!$user->is_matchable) {
                if ($resultGraph->hasVertex($user->id)) {
                    $resultGraph->getVertex($user->id)->destroy();
                }
            }
        }

        $matchable_lehr = User::find(DB::table('lehr_stud')->pluck('lehr_id'));
        $matched_lehr = User::find(DB::table('lehr_stud')->where('is_matched', true)->pluck('lehr_id'));



        $resultGraph->setAttribute('graphviz.graph.rankdir', 'LR');
        $resultGraph->setAttribute('graphviz.graph.bgcolor', 'transparent');
        // $graphviz->display($resultGraph);
        // $graphviz->setFormat('svg');
        $graph_img = $graphviz->createImageHtml($resultGraph);

        $matched_graph = $resultGraph->createGraphClone();
        foreach ($matched_graph->getEdges() as $edge) {

            $edge->setAttribute('graphviz.dir', 'none');
            $edge_lehr_id = $edge->getVertexStart()->getId();
            $edge_stud_id = $edge->getVertexEnd()->getId();

            foreach ($matchable_lehr as $lehr) {
                if ($edge_lehr_id == $lehr->id) {

                    if ($lehr->matching_state == 'matched') {
                        if ($lehr->matched_user->id == $edge_stud_id) {
                            $edge->setAttribute('graphviz.color', 'green');
                            $edge->setAttribute('graphviz.dir', 'both');
                        } else {
                            $edge->setAttribute('graphviz.color', 'red');
                        }
                    } else {
                        if (User::find($edge_stud_id)->matching_state == 'matched') {
                            $edge->setAttribute('graphviz.color', 'red');
                        } else {
                            $edge->setAttribute('graphviz.color', 'black');
                        }
                    }
                }
            }
        }
        $matched_graph->setAttribute('graphviz.graph.rankdir', 'LR');
        $matched_graph->setAttribute('graphviz.graph.bgcolor', 'transparent');
        $matched_graph_img = $graphviz->createImageHtml($matched_graph);


        return view('matchable', compact('graph_img', 'matched_graph_img', 'max_flow', 'matched_lehr', 'matchable_lehr'));
    }


    public function setAssigned(Request $request, $lehrid, $studid)
    {
        $lehr = User::find($lehrid);
        $stud = User::find($studid);

        $lehr->matchable()->updateExistingPivot($stud, ['is_matched' => true]);

        return back();
    }


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

        $unnotified_matchings = DB::table('lehr_stud')->where('is_notified', false)->get();

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
            $lehr->matchable()->syncWithoutDetaching([$stud->id => ['is_notified' => true]]);
        }

        return back();
    }


    public function acceptedMatchings(Request $request)
    {
        $notified_matchings = DB::table('lehr_stud')->where('is_notified', true)->get();
        foreach ($notified_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        $accepted_matchings = DB::table('lehr_stud')->where('is_accepted_lehr', true)->where('is_accepted_stud', true)->get();
        foreach ($accepted_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
        }
        return view('accepted_matchings', ['notified_matchings' => $notified_matchings, 'accepted_matchings' => $accepted_matchings]);
    }









    public function matchings(Request $request)
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
