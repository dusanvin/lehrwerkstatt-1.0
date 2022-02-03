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

class StatsController extends Controller
{

	/* Nur erreichbar, wenn eingeloggt */

    // public function __construct()
    // {
    // 	$this->middleware(['auth']);
    // }
	
    public function index()
    {
        //dd(auth()->user());

        // Nutzende
            // Anzahl aller Nutzenden
            $users = DB::table('users')->count();
            $roles = Role::all();

            // Anzahl aller Admins
            $adminsCount = User::role('Admin')->get()->count();

            // Anzahl aller Moderierenden
            $modsCount = User::role('Moderierende')->get()->count();

            // Anzahl aller Helfenden
            $helfendeCount = User::role('Helfende')->get()->count();

            // Anzahl aller Lehrenden
            $lehrendeCount = User::role('Lehrende')->get()->count();

        // Angebote
            // Anzahl aller Angebote
            $alleAngeboteCount = Offer::with([
                'user',
                'likes'
            ])->get()->count();

            // Anzahl aller aktiven Angebote
            $aktiveAngeboteCount = Offer::where('active', 1)->get()->count();

            // Anzahl aller inaktiven Angebote
            $inaktiveAngeboteCount = Offer::where('active', 0)->get()->count();

        // Bedarfe
            // Anzahl aller Bedarfe
            $alleBedarfeCount = Need::with([
                'user',
                'likes'
            ])->get()->count();

            // Anzahl aller aktiven Bedarfe
            $aktiveBedarfeCount = Need::where('active', 1)->get()->count();;

            // Anzahl aller inaktiven Bedarfe
            $inaktiveBedarfeCount = Need::where('active', 0)->get()->count();;


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
                'inaktiveBedarfeCount'
            )
        );
    }

}
