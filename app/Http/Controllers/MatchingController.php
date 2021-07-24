<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Need;

class MatchingController extends Controller
{

	/* Nur erreichbar, wenn eingeloggt */

    // public function __construct()
    // {
    // 	$this->middleware(['auth']);
    // }
	
    public function index()
    {

        $offers = Offer::with([
            'user'
        ])->latest()->get();

        $needs = Need::with([
            'user'
        ])->latest()->get();

        $zahl = 0;
        $rahmen = 0;
        $sprache = 0;
        $studium = 0;
        $fachsemester = 0;
        //datum

        return view('matching',[
            'offers' => $offers,
            'needs' => $needs,
            'zahl' => $zahl,
            'rahmen' => $rahmen,
            'sprache' => $sprache,
            'studium' => $studium,
            'fachsemester' => $fachsemester,
        ]);
    }
}
