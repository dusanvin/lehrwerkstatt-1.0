<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FilterController;
use App\Models\User;
use App\Models\LehrStud;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class StatsController extends Controller
{
	
    public function index()
    {
        $registered_users = [
            'Lehr' => FilterController::getRegisteredUsers('Lehr'),
            'Stud' => FilterController::getRegisteredUsers('Stud'),
        ];

        $available_users = [
            'Lehr' => [
                'Grundschule' => FilterController::getAvailableUsers('Lehr', 'Grundschule'),
                'Realschule' => FilterController::getAvailableUsers('Lehr', 'Realschule'),
                'Gymnasium' => FilterController::getAvailableUsers('Lehr', 'Gymnasium'),
                'Mittelschule' => FilterController::getAvailableUsers('Lehr', 'Mittelschule'),
            ],
            'Stud' => [
                'Grundschule' => FilterController::getAvailableUsers('Stud', 'Grundschule'),
                'Realschule' => FilterController::getAvailableUsers('Stud', 'Realschule'),
                'Gymnasium' => FilterController::getAvailableUsers('Stud', 'Gymnasium'),
                'Mittelschule' => FilterController::getAvailableUsers('Stud', 'Mittelschule'),
            ]
        ];

        // nutzer die vorschlag erhalten haben, aufgeteilt bzgl des status
        $accepted_matchings = LehrStud::with('lehr_id', 'stud_id')->where('is_accepted_lehr', true)->where('is_accepted_stud', true)->get();

        $notified_matchings = LehrStud::with('lehr_id', 'stud_id')->where('is_notified', true)->where(function ($query) {
            $query->whereNull('is_accepted_lehr')->where('is_accepted_stud', true)->orWhere(function ($query) {
                $query->where('is_accepted_lehr', true)->whereNull('is_accepted_stud');
            })->orWhere(function ($query) {
                $query->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud');
            });
        })->get();

        $declined_matchings = LehrStud::with('lehr_id', 'stud_id')->where(function ($query) {
            $query->where('is_accepted_lehr', false)->orWhere('is_accepted_stud', false);
        })->get();


        $matchings = [];

        foreach($accepted_matchings as $matching) {
            $lehr = $matching->lehr;
            $lehr['matchingnummer'] = $matching->lehr_id.$matching->stud_id;

            $stud = $matching->stud;
            
            $stud['matchingnummer'] = $matching->lehr_id.$matching->stud_id;
            if(is_null($matching->is_accepted_lehr)) {
                $lehr['matching_status'] = 'ausstehend';
            } elseif(empty($matching->is_accepted_lehr)) {
                $lehr['matching_status'] = 'abgelehnt';
            } else {
                $lehr['matching_status'] = 'akzeptiert';
            }
            if(is_null($matching->is_accepted_stud)) {
                $stud['matching_status'] = 'ausstehend';
            } elseif(empty($matching->is_accepted_stud)) {
                $stud['matching_status'] = 'abgelehnt';
            } else {
                $stud['matching_status'] = 'akzeptiert';
            }
            $matchings[] = $lehr;
            $matchings[] = $stud;
        }

        foreach($notified_matchings as $matching) {
            $lehr = $matching->lehr;
            $lehr['matchingnummer'] = $matching->lehr_id.$matching->stud_id;

            $stud = $matching->stud;
            
            $stud['matchingnummer'] = $matching->lehr_id.$matching->stud_id;
            if(is_null($matching->is_accepted_lehr)) {
                $lehr['matching_status'] = 'ausstehend';
            } elseif(empty($matching->is_accepted_lehr)) {
                $lehr['matching_status'] = 'abgelehnt';
            } else {
                $lehr['matching_status'] = 'akzeptiert';
            }
            if(is_null($matching->is_accepted_stud)) {
                $stud['matching_status'] = 'ausstehend';
            } elseif(empty($matching->is_accepted_stud)) {
                $stud['matching_status'] = 'abgelehnt';
            } else {
                $stud['matching_status'] = 'akzeptiert';
            }
            $matchings[] = $lehr;
            $matchings[] = $stud;
        }

        foreach($declined_matchings as $matching) {
            $lehr = $matching->lehr;
            $lehr['matchingnummer'] = $matching->lehr_id.$matching->stud_id;

            $stud = $matching->stud;
            
            $stud['matchingnummer'] = $matching->lehr_id.$matching->stud_id;
            if(is_null($matching->is_accepted_lehr)) {
                $lehr['matching_status'] = 'ausstehend';
            } elseif(empty($matching->is_accepted_lehr)) {
                $lehr['matching_status'] = 'abgelehnt';
            } else {
                $lehr['matching_status'] = 'akzeptiert';
            }
            if(is_null($matching->is_accepted_stud)) {
                $stud['matching_status'] = 'ausstehend';
            } elseif(empty($matching->is_accepted_stud)) {
                $stud['matching_status'] = 'abgelehnt';
            } else {
                $stud['matching_status'] = 'akzeptiert';
            }
            $matchings[] = $lehr;
            $matchings[] = $stud;
        }

        $matchings = collect($matchings);

        $accepted_matchings_count = $accepted_matchings->count();
        $notified_matchings_count = $notified_matchings->count();
        $declined_matchings_count = $declined_matchings->count();



        // get count of users with verified email
        $user_count = DB::table('users')->whereNotNull('email_verified_at')->count();

        $admin_count = User::where('role', 'Admin')->whereNotNull('email_verified_at')->count();
        $mod_count = User::where('role', 'Moderierende')->whereNotNull('email_verified_at')->count();
        $lehr_count = User::where('role', 'Lehr')->whereNotNull('email_verified_at')->count();
        $stud_count = User::where('role', 'Stud')->whereNotNull('email_verified_at')->count();


        $lehr_incomplete_form = User::role('Lehr')->whereNotNull('email_verified_at')->where('is_evaluable', false)->count();
        $lehr_complete_form = User::role('Lehr')->where('is_evaluable', true)->count();

        $stud_incomplete_form = User::role('Stud')->whereNotNull('email_verified_at')->where('is_evaluable', false)->count();
        $stud_complete_form = User::role('Stud')->where('is_evaluable', true)->count();


        $lehr_grundschule = 0;
        $lehr_realschule = 0;
        $lehr_gymnasium = 0;

        $stud_grundschule = 0;
        $stud_realschule = 0;
        $stud_gymnasium = 0;


        $users = User::whereNotNull('email_verified_at')->where('is_evaluable', true)->get();
        
        $lehr_landkreise = [
            "Augsburg Stadt" => 0,
            "Augsburg Land" => 0,
            "Aichach-Friedberg" => 0,
            "Dillingen a. d. Donau" => 0,
            "Donau-Ries" => 0,
            "Günzburg" => 0,
            "Kaufbeuren" => 0,
            "Kempten" => 0,
            "Lindau" => 0,
            "Memmingen" => 0,
            "Neu-Ulm" => 0,
            "Oberallgäu" => 0,
            "Ostallgäu" => 0,
            "Unterallgäu" => 0
        ];
        $stud_landkreise = [
            "Augsburg Stadt" => 0,
            "Augsburg Land" => 0,
            "Aichach-Friedberg" => 0,
            "Dillingen a. d. Donau" => 0,
            "Donau-Ries" => 0,
            "Günzburg" => 0,
            "Kaufbeuren" => 0,
            "Kempten" => 0,
            "Lindau" => 0,
            "Memmingen" => 0,
            "Neu-Ulm" => 0,
            "Oberallgäu" => 0,
            "Ostallgäu" => 0,
            "Unterallgäu" => 0
        ];
        foreach($users as $user) {
            if($user->role == 'Lehr') {
                switch($user->survey_data->landkreis) {
                    case "Augsburg Stadt":
                        $lehr_landkreise["Augsburg Stadt"]++;
                        break;
                    case "Augsburg Land":
                        $lehr_landkreise["Augsburg Land"]++;
                        break;
                    case "Aichach-Friedberg":
                        $lehr_landkreise["Aichach-Friedberg"]++;
                        break;
                    case "Dillingen a. d. Donau":
                        $lehr_landkreise["Dillingen a. d. Donau"]++;
                        break;
                    case "Donau-Ries":
                        $lehr_landkreise["Donau-Ries"]++;
                        break;
                    case "Günzburg":
                        $lehr_landkreise["Günzburg"]++;
                        break;
                    case "Kaufbeuren":
                        $lehr_landkreise["Kaufbeuren"]++;
                        break;
                    case "Kempten":
                        $lehr_landkreise["Kempten"]++;
                        break;
                    case "Lindau":
                        $lehr_landkreise["Lindau"]++;
                        break;
                    case "Memmingen":
                        $lehr_landkreise["Memmingen"]++;
                        break;
                    case "Neu-Ulm":
                        $lehr_landkreise["Neu-Ulm"]++;
                        break;
                    case "Oberallgäu":
                        $lehr_landkreise["Oberallgäu"]++;
                        break;
                    case "Ostallgäu":
                        $lehr_landkreise["Ostallgäu"]++;
                        break;
                    case "Unterallgäu":
                        $lehr_landkreise["Unterallgäu"]++;
                        break;
                }
                if($user->survey_data->schulart == 'Grundschule') {
                    $lehr_grundschule++;
                } elseif($user->survey_data->schulart == 'Realschule') {
                    $lehr_realschule++;
                } elseif($user->survey_data->schulart == 'Gymnasium') {
                    $lehr_gymnasium++;
                }
            } elseif($user->role == 'Stud') {
                foreach($user->survey_data->landkreise as $landkreis) {
                    switch($landkreis) {
                        case "Augsburg Stadt":
                            $stud_landkreise["Augsburg Stadt"]++;
                            break;
                        case "Augsburg Land":
                            $stud_landkreise["Augsburg Land"]++;
                            break;
                        case "Aichach-Friedberg":
                            $stud_landkreise["Aichach-Friedberg"]++;
                            break;
                        case "Dillingen a. d. Donau":
                            $stud_landkreise["Dillingen a. d. Donau"]++;
                            break;
                        case "Donau-Ries":
                            $stud_landkreise["Donau-Ries"]++;
                            break;
                        case "Günzburg":
                            $stud_landkreise["Günzburg"]++;
                            break;
                        case "Kaufbeuren":
                            $stud_landkreise["Kaufbeuren"]++;
                            break;
                        case "Kempten":
                            $stud_landkreise["Kempten"]++;
                            break;
                        case "Lindau":
                            $stud_landkreise["Lindau"]++;
                            break;
                        case "Memmingen":
                            $stud_landkreise["Memmingen"]++;
                            break;
                        case "Neu-Ulm":
                            $stud_landkreise["Neu-Ulm"]++;
                            break;
                        case "Oberallgäu":
                            $stud_landkreise["Oberallgäu"]++;
                            break;
                        case "Ostallgäu":
                            $stud_landkreise["Ostallgäu"]++;
                            break;
                        case "Unterallgäu":
                            $stud_landkreise["Unterallgäu"]++;
                            break;
                    }
                }
                if($user->survey_data->schulart == 'Grundschule') {
                    $stud_grundschule++;
                } elseif($user->survey_data->schulart == 'Realschule') {
                    $stud_realschule++;
                } elseif($user->survey_data->schulart == 'Gymnasium') {
                    $stud_gymnasium++;
                }
            }
        }


        $recent_month_names = [];
        $lehr_registrations_recent_months = [];
        $stud_registrationss_recent_months = [];
        Carbon::now()->locale('de_DE');
        for($i=12; $i>0; $i--) {
            $recent_month_names[$i] = Carbon::now()->subMonthsNoOverflow($i)->shortMonthName;
            $lehr_registrations_recent_months[$i] = DB::table('users')->whereMonth('email_verified_at', Carbon::now()->subMonthsNoOverflow($i)->month)->where('role', 'Lehr')->count();
            $stud_registrations_recent_months[$i] = DB::table('users')->whereMonth('email_verified_at', Carbon::now()->subMonthsNoOverflow($i)->month)->where('role', 'Stud')->count();
        }


        $current_month_name = Carbon::now()->monthName;
        $lehr_registrations_current_month = DB::table('users')->whereMonth('email_verified_at', Carbon::now()->month)->where('role', 'Lehr')->count();
        $stud_registrations_current_month = DB::table('users')->whereMonth('email_verified_at', Carbon::now()->month)->where('role', 'Stud')->count();


        return view('stats',
            compact(
                'user_count',
                'admin_count',
                'mod_count',
                'lehr_count',
                'stud_count',
                'current_month_name',
                'lehr_registrations_current_month',
                'stud_registrations_current_month',
                'recent_month_names',
                'lehr_registrations_recent_months',
                'stud_registrations_recent_months',
                'lehr_incomplete_form',
                'lehr_complete_form',
                'stud_incomplete_form',
                'stud_complete_form',

                'lehr_grundschule',
                'lehr_realschule',
                'lehr_gymnasium',
                'stud_grundschule',
                'stud_realschule',
                'stud_gymnasium',

                'lehr_landkreise',
                'stud_landkreise',

                'accepted_matchings',
                'notified_matchings',
                'declined_matchings',
                'matchings',
                'accepted_matchings_count',
                'notified_matchings_count',
                'declined_matchings_count',

                'registered_users',
                'available_users'

            )
        );
    }

}