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

use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;


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
            'role' => ['required', Rule::in(['btn-helfende', 'btn-lehrende'])],
    		'password' => ['required', 'confirmed', Password::min(10)
				->numbers()
				->symbols()
				->mixedCase()
				->letters(),
			],
            'user_agreement' => 'accepted',
            'privacy_statement' => 'accepted'
        ]);

        //$request->request->add(['role' => 'Lehrer']);

        $user = User::create([
    		'vorname' => $request->firstname,
    		'nachname' => $request->lastname,
    		'email' => $request->email,
            //'role' => $request->role,
    		'password' => Hash::make($request->password),
        ]);

        // Helfende 4, Lehrende 5
        $role = $request->input('role');
        
        $role_id = 0;
        if ($role == 'btn-helfende') {
            $role_id = 4;
        }
            

        if ($role == 'btn-lehrende') {
            $role_id = 5;
        }
            

        DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?, ?, ?)', [$role_id, 'App\Models\User', $user->id]);
        
        // create([
        //     'role_id' => $role_id,
        //     'model_type' => 'App\Models\User',
        //     'model_id' => $user->id
        // ]);

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
