<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller

{
    // Verwaltung
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->simplePaginate(50);

        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    // public function create()

    // {

    //     $roles = Role::pluck('name', 'name')->all();
    //     return view('users.create', compact('roles'));
    // }

    // public function store(Request $request)

    // {

    //     $this->validate($request, [
    //         'vorname' => 'required',
    //         'nachname' => 'required',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|same:confirm-password'
    //     ]);

    //     $input = $request->all();
    //     $input['password'] = Hash::make($input['password']);

    //     $user = User::create($input);

    //     $role = $request->input('roles');
    //     $role_id = 0;
    //     if ($role[0] == 'Admin') {
    //         $role_id = 7;
    //     }
    //     if ($role[0] == 'Helfende') {
    //         $role_id = 4;
    //     }
    //     if ($role[0] == 'Lehrende') {
    //         $role_id = 5;
    //     }
    //     if ($role[0] == 'Moderierende') {
    //         $role_id = 3;
    //     }

    //     DB::insert('insert into model_has_roles (role_id, model_type, model_id) values (?, ?, ?)', [$role_id, 'App\Models\User', $user->id]);

    //     event(new Registered($user));

    //     $user->timestamps = false;
    //     $user->last_login_at = now();

    //     return redirect()->route('users.index')
    //         ->with('success', 'Person erfolgreich erstellt.');
    // }

    public function show($id)
    {
        $user = User::find($id);
        $user->survey_data = json_decode($user->survey_data);
        return view('users.show', compact('user'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        $user->survey_data = json_decode($user->survey_data);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }


    // wenn admin einen user editiert und submittet
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vorname' => 'required',
            'nachname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);

        $user->vorname = $input['vorname'];
        $user->nachname = $input['nachname'];
        $user->role = $input['roles'][0];
        if (isset($input['password']))
            $user->password = $input['password'];

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles')[0]);

        $user->save();

        if (!empty($user->survey_data)) {
            $user->survey_data = json_decode($user->survey_data);
            // dd($user->survey_data);
            $user->survey_data->vorname = $input['vorname'];
            $user->survey_data->nachname = $input['nachname'];
            $user->survey_data = json_encode($user->survey_data);
            // dd($user->survey_data);
            $user->save();
        }



        return redirect()->route('users.index')
            ->with('success', 'Informationen erfolgreich aktualisiert.');
    }


    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'Person erfolgreich gelöscht.');
    }

    
    // wenn man den survey submittet
    public function save(Request $request)
    {
        $user = Auth::user();

        $user->vorname = $request->survey['vorname'];
        // unset($request->survey['vorname']);
        $user->nachname = $request->survey['nachname'];
        // unset($request->survey['nachname']);
        $user->survey_data = $request->survey;
        $user->is_evaluable = true;

        $user->save();
    }
}
