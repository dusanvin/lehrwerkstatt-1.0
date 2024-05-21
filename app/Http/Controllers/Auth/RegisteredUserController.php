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
            'role' => ['required', Rule::in(['Lehr', 'Stud'])],
            'email' => 'email:rfc,dns',
            'password' => [
                'required', 'confirmed', Password::min(10)
                    ->numbers()
                    ->symbols()
                    ->mixedCase()
                    ->letters(),
            ],
            // 'user_agreement' => 'accepted',
            'privacy_statement' => 'accepted'
        ]);


        $role = $request->input('role');
        if (in_array($role, ['Lehr', 'Stud'])) {
            if ($role == 'Lehr') {
                $request->validate(['email' => 'required|max:255']);
            }

            if ($role == 'Stud') {
                $request->validate(['email' => ['required', 'regex:/^.+@(student.uni-augsburg|uni-a)\.de$/', 'max:255']]);
            }

            $user = User::where('email', $request->email)->whereNull('email_verified_at')->first(); // null if not exist
            if($user) {
                $user->delete();
            }
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
                // 'nutzungsbedingungen' => true,
                'datenschutz' => true
            ]);
            $user->assignRole($role);
        }
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
