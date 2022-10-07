<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use DB;
use App\Notifications\MatchingProposal;
use Carbon\Carbon;

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

    public function matchings(Request $request)
    {
        $lehr = User::where('role', 'lehr')->where('valid', true)->where('assigned', false)->get();
        $stud = User::where('role', 'stud')->where('valid', true)->where('assigned', false)->get();

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
            $assigned_lehr = User::where('role', 'lehr')->where('valid', true)->where('assigned', true)->where('id', $am->lehr_id)->get();
            $assigned_stud = User::where('role', 'stud')->where('valid', true)->where('assigned', true)->where('id', $am->stud_id)->get();
            $assigned[] = ['lehr' => $assigned_lehr[0], 'stud' => $assigned_stud[0], 'is_accepted_lehr' => $am->is_accepted_lehr, 'is_accepted_stud' => $am->is_accepted_stud, 'mse' => $am->mse, 'elapsed_time' => Carbon::parse($am->created_at)->diffForHumans(Carbon::now())];
        }
        // dd($assigned_matchings);

        return view('matchings', ['users' => $lehr, 'matchings' => $matchings, 'assigned_matchings' => $assigned, 'unmatchable_lehr' => $unmatchable_lehr]);
    }

    public function setAssigned(Request $request, $lehrid, $studid, $mse)
    {
        $lehr = User::where('role', 'lehr')->where('valid', true)->where('assigned', false)->where('id', $lehrid)->get();
        $stud = User::where('role', 'stud')->where('valid', true)->where('assigned', false)->where('id', $studid)->get();

        $lehr = $lehr[0];
        $stud = $stud[0];

        $lehr->matchings()->attach($stud, ['mse' => $mse]);
        // DB::insert('insert into lehr_stud (lehr_id, stud_id, mse) values (?, ?, ?)', [$lehrid, $studid, $mse]);

        $lehr->assigned = true;
        $lehr->save();

        $stud->assigned = true;
        $stud->save();

        return redirect()->route('users.matchings');
    }

    public function setUnassigned(Request $request, $lehrid, $studid)
    {
        $lehr = User::where('role', 'lehr')->where('valid', true)->where('assigned', true)->where('id', $lehrid)->get();
        $stud = User::where('role', 'stud')->where('valid', true)->where('assigned', true)->where('id', $studid)->get();

        $lehr = $lehr[0];
        $stud = $stud[0];

        $lehr->assigned = false;
        $lehr->save();

        $stud->assigned = false;
        $stud->save();

        DB::table('lehr_stud')->where('lehr_id', $lehrid)->where('stud_id', $studid)->delete();

        return redirect()->route('users.matchings');
    }


    public function acceptMatching(Request $request)
    {
        // $matching = DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->first();
        if ($request->input('role') == 'Lehr') {
            DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->update([
                'is_accepted_lehr' => true
            ]);
        }

        if ($request->input('role') == 'Stud') {
            DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->update([
                'is_accepted_stud' => true
            ]);
        }

        $matching = DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->first();
        if ($matching->is_accepted_lehr && $matching->is_accepted_stud) {
        }

        return back();
    }


    public function declineMatching(Request $request)
    {
        // $matching = DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->first();
        if ($request->input('role') == 'Lehr') {
            DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->update([
                'is_accepted_lehr' => false
            ]);
        }

        if ($request->input('role') == 'Stud') {
            DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->update([
                'is_accepted_stud' => false
            ]);
        }

        $matching = DB::table('lehr_stud')->where('lehr_id', $request->input('lehrid'))->where('stud_id', $request->input('studid'))->first();
        if ($matching->is_accepted_lehr == 0 ||  $matching->is_accepted_stud == 0) {
        }

        return back();
    }


    public function notifyMatchings()
    {

        $matchings = DB::table('lehr_stud')->where('is_notified', false)->get();

        foreach ($matchings as $matching) {

            $lehr = User::find($matching->lehr_id);
            $lehr->notify(new MatchingProposal());

            $stud = User::find($matching->stud_id);
            $stud->notify(new MatchingProposal());

            DB::table('lehr_stud')->where('lehr_id', $lehr->id)->where('stud_id', $stud->id)->update(['created_at' => Carbon::now(), 'is_notified' => true]);
        }

        return back();
    }


    public function acceptedMatchings(Request $request)
    {
        $accepted_matchings = DB::table('lehr_stud')->where('is_accepted_lehr', true)->where('is_accepted_stud', true)->get();

        foreach ($accepted_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
        }

        $notified_matchings = DB::table('lehr_stud')->where('is_notified', true)->get();

        foreach ($notified_matchings as $am) {
            $am->lehr = User::find($am->lehr_id);
            $am->stud = User::find($am->stud_id);
            $am->elapsed_time = Carbon::parse($am->created_at)->diffForHumans(Carbon::now());
        }

        return view('accepted_matchings', ['accepted_matchings' => $accepted_matchings, 'notified_matchings' => $notified_matchings]);
    }
}
