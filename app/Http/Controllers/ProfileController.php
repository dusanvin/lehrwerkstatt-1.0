<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->survey_data = json_decode($user->survey_data);
        if (isset($user->survey_data->faecher))
            $user->survey_data->faecher = implode(', ', $user->survey_data->faecher);
        if (isset($user->survey_data->landkreise))
            $user->survey_data->landkreise = implode(', ', $user->survey_data->landkreise);
        if (isset($user->survey_data->verkehrsmittel))
            $user->survey_data->verkehrsmittel = implode(', ', $user->survey_data->verkehrsmittel);
        if (isset($user->survey_data->praktika))
            $user->survey_data->praktika = implode(', ', $user->survey_data->praktika);
        if (isset($user->survey_data->freue_auf))
            $user->survey_data->freue_auf = implode(', ', $user->survey_data->freue_auf);
        if (!$user->survey_data) {
            $this->edit();
        } else {
            return view('profile.details', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();

        if ($user->survey_data) {
            if (strcasecmp($user->role, 'Lehr') == 0 || strcasecmp($user->role, 'Stud') == 0) {
                $attention = 'Die Bewerbung für den aktuellen Jahrgang '.config('site_vars.jahrgang').' liegt uns vor. Sie können Angaben korrigieren, während Sie das Formular durchgehen. Bitte beachten Sie, dass Pflichtfelder weiterhin ausgefüllt sein und Änderungen anschließend bestätigt werden müssen, bevor diese wirksam werden können.';
                return view('surveys.' . lcfirst($user->role), ['attention' => $attention, 'jahrgang' => config('site_vars.jahrgang'), 'user' => $user]);
            } else {
                return view('surveys.admin_mod', ['attention' => 'Hier können Sie Ihre Daten korrigieren.', 'jahrgang' => config('site_vars.jahrgang'), 'user' => $user]);
            }
        } else {
            if (strcasecmp($user->role, 'Lehr') == 0 || strcasecmp($user->role, 'Stud') == 0) {
                $attention = 'Zum aktuellen Jahrgang '.config('site_vars.jahrgang').' liegt uns keine Bewerbung vor. Wir bitten Sie, sich kurz Zeit zu nehmen und das Bewerbungsformular auszufüllen.';
                return view('surveys.' . lcfirst($user->role), ['attention' => $attention, 'jahrgang' => config('site_vars.jahrgang'), 'user' => $user]);
            } else {
                return view('surveys.admin_mod', ['attention' => 'Bitte vervollständigen Sie die Daten.', 'jahrgang' => config('site_vars.jahrgang'), 'user' => $user]);
            }
        }
    }

    public function account()
    {
        return view('profile.account', ['user' => auth()->user()]);
    }

    public function update(Request $request, $id)
    {
        $id = auth()->id();
        $user = User::find($id);

        $this->validate($request, [
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();


        // if(!isset($input['is_evaluable'])) {
        //     $input['is_evaluable'] = true;
        // }


        if(!($user->role == 'Lehr' || $user->role == 'Stud')) {
            $input['is_evaluable'] = false;
        }


        if ($input['email'] != $user->email) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        if (isset($input['password'])) {
            $this->validate($request, [
                'password' => [
                    Password::min(10)
                        ->numbers()
                        ->symbols()
                        ->mixedCase()
                        ->letters(),
                ]
            ]);
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user->update($input);

        session()->flash('success', 'true');

        return redirect()->route('profile.account');
    }

    public function matchings()
    {
        $user = auth()->user();
        
        foreach ($user->matchable as $m) {
            $m->survey_data = json_decode($m->survey_data);
            if (isset($m->survey_data->faecher))
                $m->survey_data->faecher = implode(', ', $m->survey_data->faecher);
            if (isset($m->survey_data->landkreise))
                $m->survey_data->landkreise = implode(', ', $m->survey_data->landkreise);
            if (isset($m->survey_data->verkehrsmittel))
                $m->survey_data->verkehrsmittel = implode(', ', $m->survey_data->verkehrsmittel);
        }

        return view('profile.matchings', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $id = auth()->id();
    //     $user = User::find($id);

    //     $this->validate($request, [
    //         'vorname' => 'filled|max:255',
    //         'nachname' => 'filled|max:255',
    //         'email' => 'email|unique:users,email,' . $id,
    //         'password' => 'same:confirm-password',
    //     ]);

    //     $input = $request->all();

    //     if($input['email'] != $user->email) {
    //         $user->email_verified_at = null;
    //         $user->sendEmailVerificationNotification();
    //     }

    //     if (isset($input['password'])) {
    //         $this->validate($request, [
    //             'password' => [Password::min(10)
    // 			->numbers()
    // 			->symbols()
    // 			->mixedCase()
    // 			->letters(),
    // 		    ]
    //         ]);
    //         $input['password'] = Hash::make($input['password']);
    //     } else {
    //         $input = Arr::except($input, array('password'));
    //     }

    //     $user->update($input);

    //     session()->flash('success', 'true');

    //     return redirect()->route('profile.edit');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
