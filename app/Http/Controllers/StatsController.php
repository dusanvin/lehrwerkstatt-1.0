<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Offer;
use App\Models\Need;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class StatsController extends Controller
{
	
    public function index()
    {

        $user_count = DB::table('users')->whereNotNull('email_verified_at')->count();

        $admin_count = User::role('Admin')->whereNotNull('email_verified_at')->count();
        $mod_count = User::role('Moderierende')->whereNotNull('email_verified_at')->count();
        $lehr_count = User::role('Lehr')->whereNotNull('email_verified_at')->count();
        $stud_count = User::role('Stud')->whereNotNull('email_verified_at')->count();


        $lehr_incomplete_form = User::role('Lehr')->whereNotNull('email_verified_at')->where('valid', false)->count();
        $lehr_complete_form = User::role('Lehr')->where('valid', true)->count();

        $stud_incomplete_form = User::role('Stud')->whereNotNull('email_verified_at')->where('valid', false)->count();
        $stud_complete_form = User::role('Stud')->where('valid', true)->count();


        $lehr_grundschule = 0;
        $lehr_realschule = 0;
        $lehr_gymnasium = 0;

        $stud_grundschule = 0;
        $stud_realschule = 0;
        $stud_gymnasium = 0;


        $users = User::whereNotNull('email_verified_at')->where('valid', true)->get();
        $landkreise = [
            "Augsburg Stadt",
            "Augsburg Land",
            "Aichach-Friedberg",
            "Dillingen a. d. Donau",
            "Donau-Ries",
            "Günzburg",
            "Kaufbeuren",
            "Kempten",
            "Lindau",
            "Memmingen",
            "Neu-Ulm",
            "Oberallgäu",
            "Ostallgäu",
            "Unterallgäu"
        ];
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
            $user->survey_data = json_decode($user->survey_data);
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
                'stud_landkreise'
            )
        );
    }

}
