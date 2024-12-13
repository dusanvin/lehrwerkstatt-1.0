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
        if ($user->role == 'Lehr' || $user->role == 'Stud') {
            if ($user->survey_data->bestaetigung ?? false) {
                $attention = 'Die Bewerbung für den aktuellen Jahrgang '.config('site_vars.jahrgang').' liegt uns vor. Sie können Angaben korrigieren, während Sie das Formular durchgehen. Bitte beachten Sie, dass Pflichtfelder weiterhin ausgefüllt sein und Änderungen anschließend bestätigt werden müssen, bevor diese wirksam werden können.';
            } else {
                $attention = 'Zum aktuellen Jahrgang '.config('site_vars.jahrgang').' liegt uns keine vollständige Bewerbung vor. Bitte füllen Sie das Bewerbungsformular vollständig aus und klicken Sie am Ende auf "Abschließen", um am Bewerbungsverfahren '.config('site_vars.jahrgang').' teilzunehmen. <br> <br> Falls Sie das Formular bereits ausgefüllt haben, ist ein Großteil Ihrer Daten noch gespeichert. Bitte ergänzen Sie die fehlenden Daten und Haken und klicken Sie auf "Abschließen", um das Formular erneut einzureichen.';
            }
        } elseif ($user->role == 'Moderierende') {
            if (!isset($user->survey_data)) {
                $attention = 'Bitte vervollständigen Sie die Daten.';
            } elseif (!isset($user->survey_data->schulart)) {
                $attention = 'Bitte vervollständigen Sie die Daten und geben eine Schulart an.';
            } else {
                $attention = 'Hier können Sie Ihre Daten korrigieren.';
            }
        } elseif ($user->role == 'Admin') {
                $attention = $user->survey_data ? 'Hier können Sie Ihre Daten korrigieren.' : 'Bitte vervollständigen Sie die Daten.';
        }

        return view('surveys.' . lcfirst($user->role), ['attention' => $attention, 'user' => $user]);

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

        // if checkbox is checked in account.blade.php: $input['is_evaluable'] == 0
        $user->update($input);
        // if user was in a match dependencies have to be resolved
        if (isset($input['is_evaluable'])) {  // only true if checked
            $user->excludeFromMatching();
        }

        session()->flash('success', 'true');
        return redirect()->route('profile.account');
    }

    public function matchings()
    {
        $user = auth()->user();
        
        foreach ($user->matchable as $m) {
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
