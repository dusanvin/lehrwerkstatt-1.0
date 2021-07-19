<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{

    /* Nur erreichbar, wenn eingeloggt */

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
    	return view('auth.register');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'vorname' => 'required|max:255',
    		'nachname' => 'required|max:255',
    		//'email' => 'required|email|max:255',
    		'email' => 'required|unique:users,email|max:255',
            'role' => 'required|max:40',
    		//'password' => 'required|confirmed',
    		'password' => ['required', 'confirmed', Password::min(10)
				->numbers()
				->symbols()
				->mixedCase()
				->letters(),
			],
    	]);

    	User::create([
    		'vorname' => $request->vorname,
    		'nachname' => $request->nachname,
    		'email' => $request->email,
            'role' => $request->role,
    		'password' => Hash::make($request->password),
    	]);

    	auth()->attempt($request->only('email','password'));

    	return redirect()->route('dashboard'); 
    	// view('auth.register');

    }

}
