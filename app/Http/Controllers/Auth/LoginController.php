<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /* Nur erreichbar, wenn eingeloggt */

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index() {

    	return view('auth.login');

    }

    public function store(Request $request) {

    	$this->validate($request, [
    		//'vorname' => 'required|max:255',
    		//'nachname' => 'required|max:255',
    		//'email' => 'required|email|max:255',
    		'email' => 'required|email',
    		'password' => 'required',
    	]);

    	//dd('ok');

    	if(!auth()->attempt($request->only('email','password'), $request->remember)) {
    		return back()->with('status','Ungültige Anmeldedaten');
    	}

    	return redirect()->route('dashboard');

    }

    public function authenticated(Request $request, $user)
    {
        $user->timestamps = false;
        $user->last_login_at = now();
        $user->save();
    }
}
