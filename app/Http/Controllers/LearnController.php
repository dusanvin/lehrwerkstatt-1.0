<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnController extends Controller
{

	/* Nur erreichbar, wenn eingeloggt */

    public function __construct()
    {
    	$this->middleware(['auth']);
    }

    public function index()
    {
    	/*dd(auth()->user());*/
    	return view('learn');
    }
}
