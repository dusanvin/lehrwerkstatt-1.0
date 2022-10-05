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

        // Lehrkräfte mit ausgefülltem Bewerbungsbogen
        $lehr_valid = User::role('Lehr')->where('valid', true)->count();

        // Studenten mit ausgefülltem Bewerbungsbogen
        $stud_valid = User::role('Stud')->where('valid', true)->count();


        $lehr_grundschule = 0;
        $lehr_realschule = 0;
        $lehr_gymnasium = 0;

        $stud_grundschule = 0;
        $stud_realschule = 0;
        $stud_gymnasium = 0;

        $users = User::all();
        foreach($users as $user) {
            $user->survey_data = json_decode($user->survey_data);
            if($user->role == 'Lehr') {
                if($user->survey_data->schulart == 'Grundschule') {
                    $lehr_grundschule++;
                } elseif($user->survey_data->schulart == 'Realschule') {
                    $lehr_realschule++;
                } elseif($user->survey_data->schulart == 'Gymnasium') {
                    $lehr_gymnasium++;
                }
            } elseif($user->role == 'Stud') {
                if($user->survey_data->schulart == 'Grundschule') {
                    $lehr_grundschule++;
                } elseif($user->survey_data->schulart == 'Realschule') {
                    $lehr_realschule++;
                } elseif($user->survey_data->schulart == 'Gymnasium') {
                    $lehr_gymnasium++;
                }
            }
        }


        $m09_last_year = 0;
        $m09_last_year_helfende = 0;
        $m09_last_year_lehrende = 0;
        $m09_last_year_moderation = 0;
            
        $m10_last_year = 0;
        $m10_last_year_helfende = 0;
        $m10_last_year_lehrende = 0;
        $m10_last_year_moderation = 0;

        $m11_last_year = 0;
        $m11_last_year_helfende = 0;
        $m11_last_year_lehrende = 0;
        $m11_last_year_moderation = 0;

        $m12_last_year = 0;
        $m12_last_year_helfende = 0;
        $m12_last_year_lehrende = 0;
        $m12_last_year_moderation = 0;

        $m01_current_year = 0;
        $m01_current_year_helfende = 0;
        $m01_current_year_lehrende = 0;
        $m01_current_year_moderation = 0;

        $m02_current_year = 0;
        $m02_current_year_helfende = 0;
        $m02_current_year_lehrende = 0;
        $m02_current_year_moderation = 0;

        $m03_current_year = 0;
        $m03_current_year_helfende = 0;
        $m03_current_year_lehrende = 0;
        $m03_current_year_moderation = 0;

        $m04_current_year = 0;
        $m04_current_year_helfende = 0;
        $m04_current_year_lehrende = 0;
        $m04_current_year_moderation = 0;

        $m05_current_year = 0;
        $m05_current_year_helfende = 0;
        $m05_current_year_lehrende = 0;
        $m05_current_year_moderation = 0;

        $m06_current_year = 0;
        $m06_current_year_helfende = 0;
        $m06_current_year_lehrende = 0;
        $m06_current_year_moderation = 0;

        $m07_current_year = 0;
        $m07_current_year_helfende = 0;
        $m07_current_year_lehrende = 0;
        $m07_current_year_moderation = 0;

        $m08_current_year = 0;
        $m08_current_year_helfende = 0;
        $m08_current_year_lehrende = 0;
        $m08_current_year_moderation = 0;


        foreach($verifiedUsers as $verifiedUser) {
            if($verifiedUser->email_verified_at->format('Y') == (Carbon::now()->format('Y') - 1)) 
                switch($verifiedUser->email_verified_at->format('m')) {
                    case(9):
                        $m09_last_year++;
                        if($verifiedUser->role_id == 4)
                            $m09_last_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m09_last_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m09_last_year_moderation++;
                        break;
                    case(10):
                        $m10_last_year++;
                        if($verifiedUser->role_id == 4)
                            $m10_last_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m10_last_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m10_last_year_moderation++;
                        break;                        
                    case(11):
                        $m11_last_year++;
                        if($verifiedUser->role_id == 4)
                            $m11_last_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m11_last_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m11_last_year_moderation++;
                        break;                        
                    case(12):
                        $m12_last_year++;
                        if($verifiedUser->role_id == 4)
                            $m12_last_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m12_last_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m12_last_year_moderation++;
                        break;                                                                             
                }
            if($verifiedUser->email_verified_at->format('Y') == Carbon::now()->format('Y')) 
                switch($verifiedUser->email_verified_at->format('m')) {
                    case(1):
                        $m01_current_year++;
                        if($verifiedUser->role_id == 4)
                            $m01_current_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m01_current_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m01_current_year_moderation++;
                        break;                        
                    case(2):
                        $m02_current_year++;
                        if($verifiedUser->role_id == 4)
                            $m02_current_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m02_current_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m02_current_year_moderation++;
                        break;                          
                    case(3):
                        $m03_current_year++;
                        if($verifiedUser->role_id == 4)
                            $m03_current_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m03_current_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m03_current_year_moderation++;     
                        break;                     
                    case(4):
                        $m04_current_year++;
                        if($verifiedUser->role_id == 4)
                            $m04_current_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m04_current_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m04_current_year_moderation++; 
                        break;                                         
                    case(5):
                        $m05_current_year++;
                        if($verifiedUser->role_id == 4)
                            $m05_current_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m05_current_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m05_current_year_moderation++;  
                        break;                        
                    case(6):
                        $m06_current_year++;
                        if($verifiedUser->role_id == 4)
                            $m06_current_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m06_current_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m06_current_year_moderation++; 
                        break;                         
                    case(7):
                        $m07_current_year++;
                        if($verifiedUser->role_id == 4)
                            $m07_current_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m07_current_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m07_current_year_moderation++; 
                        break;                         
                    case(8):
                        $m08_current_year++;
                        if($verifiedUser->role_id == 4)
                            $m08_current_year_helfende++;
                        if($verifiedUser->role_id == 5)
                            $m08_current_year_lehrende++;
                        if($verifiedUser->role_id == 3)
                            $m08_current_year_moderation++; 
                        break;                                                                                                                                    
                }            
        }




        return view('stats',
            compact(
                'users',
                'roles',
                'adminsCount',
                'modsCount',
                'helfendeCount',
                'lehrendeCount',
                'alleAngeboteCount',
                'aktiveAngeboteCount',
                'inaktiveAngeboteCount',
                'alleBedarfeCount',
                'aktiveBedarfeCount',
                'inaktiveBedarfeCount',
                'hfDazCount',
                'nfDazCount',
                'gsCount',
                'msCount',
                'rsCount',
                'gymCount',
                'sonstigesCount',
                'm09_last_year_helfende',
                'm09_last_year_lehrende',
                'm09_last_year_moderation',
                'm10_last_year_helfende',
                'm10_last_year_lehrende',
                'm10_last_year_moderation',
                'm11_last_year_helfende',
                'm11_last_year_lehrende',
                'm11_last_year_moderation',
                'm12_last_year_helfende',
                'm12_last_year_lehrende',
                'm12_last_year_moderation',
                'm01_current_year_helfende',
                'm01_current_year_lehrende',
                'm01_current_year_moderation',
                'm02_current_year_helfende',
                'm02_current_year_lehrende',
                'm02_current_year_moderation',
                'm03_current_year_helfende',
                'm03_current_year_lehrende',
                'm03_current_year_moderation',
                'm04_current_year_helfende',
                'm04_current_year_lehrende',
                'm04_current_year_moderation',
                'm05_current_year_helfende',
                'm05_current_year_lehrende',
                'm05_current_year_moderation',
                'm06_current_year_helfende',
                'm06_current_year_lehrende',
                'm06_current_year_moderation',
                'm07_current_year_helfende',
                'm07_current_year_lehrende',
                'm07_current_year_moderation',
                'm08_current_year_helfende',
                'm08_current_year_lehrende',
                'm08_current_year_moderation'
            )
        );
    }

}
