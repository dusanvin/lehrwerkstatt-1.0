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
        $data = User::orderByRaw('CASE WHEN nachname IS NULL THEN 1 ELSE 0 END')
            ->orderBy('nachname', 'asc')
            ->orderBy('vorname', 'asc')
            ->paginate(20);

        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }


    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }


    public function edit($id)
    {
        $user = User::find($id);
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
        if (isset($input['password']))
            $user->password = $input['password'];
    
        // nutzer soll genau 1 rolle haben
        $user->role = $input['roles'][0];
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles')[0]);

        $user->save();

        if (!empty($user->survey_data)) {
            $user->survey_data->vorname = $input['vorname'];
            $user->survey_data->nachname = $input['nachname'];
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

        
        if (!$user->is_evaluable) {
            $user->is_evaluable = true;
            $user->is_available = true;
        }

        $user->save();
    }
}
