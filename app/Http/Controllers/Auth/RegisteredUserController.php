<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Validation\Rules\Password;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
    		'firstname' => 'required|max:255',
    		'lastname' => 'required|max:255',
    		'email' => 'required|unique:users,email|max:255',
            //'role' => 'required|max:40',
    		'password' => ['required', 'confirmed', Password::min(10)
				->numbers()
				->symbols()
				->mixedCase()
				->letters(),
			],
        ]);

        $request->request->add(['role' => 'Lehrer']);

        $user = User::create([
    		'vorname' => $request->firstname,
    		'nachname' => $request->lastname,
    		'email' => $request->email,
            'role' => $request->role,
    		'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Integration last_login_at 
        $user = Auth::user();
        $user->timestamps = false;
        $user->last_login_at = now();
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
