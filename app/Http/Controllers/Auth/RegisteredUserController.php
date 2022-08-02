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
            'role' => ['required', Rule::in(['lehr', 'stud'])],
            'password' => ['required', 'confirmed', Password::min(10)
            ->numbers()
            ->symbols()
            ->mixedCase()
            ->letters(),
        ]
        ]);
        // Lehr 3, Stud 4
        $role = $request->input('role');
        
        $role_id = 0;
        if ($role == 'lehr') {
            $role_id = 3;
        }
            
        if ($role == 'stud') {
            $role_id = 4;
        }

        if($role_id == 3) {
            $request->validate([
                'email' => 'required|max:255', //'required|unique:users,email|max:255',

            ]);
        } elseif($role_id == 4) {
            $request->validate([
                'email' => ['required', 'regex:/^.+@(student.uni-augsburg|uni-a)\.de$/', 'max:255'], //'required|unique:users,email|max:255',
            ]);
        }


        $user = User::create([
    		'email' => $request->email,
    		'password' => Hash::make($request->password),
            'role' => $request->role
        ]);



        event(new Registered($user));
        Auth::login($user);

        // Integration last_login_at 
        $user = Auth::user();
        $user->timestamps = false;
        $user->last_login_at = now();
        $user->save();


        DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?, ?, ?)', [$role_id, 'App\Models\User', $user->id]);

        return redirect(RouteServiceProvider::HOME);
    }
}
