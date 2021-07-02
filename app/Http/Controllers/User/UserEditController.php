<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserEditController extends Controller
{

	/* Nur erreichbar, wenn eingeloggt */

    public function __construct()
    {
    	$this->middleware(['auth']);
    }
	
    public function index()
    {
    	/*dd(auth()->user());*/
    	return view('user.user');
    }
}
