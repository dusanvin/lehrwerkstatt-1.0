<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LehrStud;

use DB;

class FilterController extends Controller
{
    private static $faecher = [
        "Deutsch",
        "Didaktik des Deutschen als Zweitsprache (Erw.)*",
        "Englisch",
        "Ethik (Erw.)*",
        "Französisch",
        "Geographie",
        "Geschichte",
        "Italienisch",
        "Kunst",
        "Mathematik",
        "Musik",
        "Physik",
        "Religionslehre ev.",
        "Religionslehre kath.",
        "Sozialkunde",
        "Spanisch",
        "Sport weiblich",
        "Sport männlich"
    ];

    private static $landkreise = [
        "Augsburg Stadt",
        "Augsburg Land",
        "Aichach-Friedberg",
        "Dillingen a. d. Donau",
        "Donau-Ries",
        "Günzburg",
        "Kaufbeuren",
        "Kempten",
        "Lindau",
        "Memmingen",
        "Neu-Ulm",
        "Oberallgäu",
        "Ostallgäu",
        "Unterallgäu"
    ];

    // für csv export
    static function getRegisteredUsers($roleName, $schulart=null) {
        $users = User::where('role', ucfirst($roleName))
            ->where('email_verified_at', '!=', null)
            ->when($schulart, function ($query, $schulart) {
                return $query->where('survey_data->schulart', $schulart);
            })
            ->orderBy('nachname', 'asc')->get();

        return $users;
    }

    static function getAvailableUsers($schulart = null, $role = null)
    {
        return User::where('is_evaluable', true)->where('is_available', true)
        ->when($schulart, function($query, $schulart) {
            return $query->where('survey_data->schulart', $schulart);
        })
        ->when($role, function($query, $role) {
            return $query->where('role', $role);
        })
        ->orderBy('nachname', 'asc')
        ->get();
    }

    static function getAssignedUsers($schulart = null, $role = null)
    {
        return User::where('is_evaluable', true)->where('is_available', false)
        ->when($schulart, function($query, $schulart) {
            return $query->where('survey_data->schulart', $schulart);
        })
        ->when($role, function($query, $role) {
            return $query->where('role', $role);
        })
        ->get();
    }

    private function filterFaecher($selected_faecher, $users)
    {
        $users = $users->reject(function ($user, $key) use ($selected_faecher) {
            if (isset($user->survey_data->faecher)) {
                foreach ($selected_faecher as $fach) {
                    $v = true;
                    if (in_array($fach, $user->survey_data->faecher))
                        $v = false;
                    return $v;
                }
            }
        });
        return $users;
    }

    private function filterLandkreise($selected_landkreise, $users)
    {
        $users = $users->reject(function ($user, $key) use ($selected_landkreise) {
            foreach ($selected_landkreise as $landkreis) {
                if (isset($user->survey_data->landkreis)) {
                    if ($user->survey_data->landkreis == $landkreis)
                        return false;
                }
                elseif (isset($user->survey_data->landkreise)) {
                    foreach ($user->survey_data->landkreise as $lk) {
                        if ($lk == $landkreis)
                            return false;
                    }
                }
            }
            return true;
        });
        return $users;
    }


    // View: Lehrkräfte
    public function lehr(Request $request, $schulart=null)
    {
        $users = $this->getAvailableUsers($schulart, 'Lehr');

        return view('offers.all', [
            'users' => $users,
            'schulart' => $schulart,
            'faecher' => FilterController::$faecher,
            'landkreise' => FilterController::$landkreise,
        ]);
    }

    // View: 
    public function filteredLehr(Request $request, $schulart=null)
    {
        $users = $this->getAvailableUsers($schulart, 'Lehr');

        $selected_faecher = [];
        if ($request->faecher) {
            $selected_faecher = explode(',', $request->faecher);
            $users = $this->filterFaecher($selected_faecher, $users);
        }

        $selected_landkreise = [];
        if ($request->landkreise) {
            $selected_landkreise = explode(',', $request->landkreise);
            $users = $this->filterLandkreise($selected_landkreise, $users);
        }

        $users = $users->values();  // resets keys of the collection to sequential keys starting from 0

        return view('offers.all', [
            'users' => $users,
            'schulart' => $request->schulart,
            'selected_schulart' => $request->selected_schulart,
            'selected_faecher' => $selected_faecher,
            'selected_landkreise' => $selected_landkreise,
            'faecher' => FilterController::$faecher,
            'landkreise' => FilterController::$landkreise,
        ]);
    }


    // View: Studenten 
    public function stud(Request $request, $schulart=null)
    {
        $users = $this->getAvailableUsers($schulart, 'Stud');

        return view('needs.all', [
            'users' => $users,
            'schulart' => $schulart,
            'faecher' => FilterController::$faecher,
            'landkreise' => FilterController::$landkreise,
        ]);
    }

    // View:
    public function filteredStud(Request $request, $schulart=null)
    {
        $users = $this->getAvailableUsers($schulart, 'Stud');

        $selected_faecher = [];
        if ($request->faecher) {
            $selected_faecher = explode(',', $request->faecher);
            $users = $this->filterFaecher($selected_faecher, $users);
        }
        
        $selected_landkreise = [];
        if ($request->landkreise) {
            $selected_landkreise = explode(',', $request->landkreise);
            $users = $this->filterLandkreise($selected_landkreise, $users);
        }

        $users = $users->values();  // resets keys of the collection to sequential keys starting from 0

        return view('needs.all', [
            'users' => $users,
            'schulart' => $request->schulart,
            'selected_schulart' => $request->selected_schulart,
            'selected_faecher' => $selected_faecher,
            'selected_landkreise' => $selected_landkreise,
            'faecher' => FilterController::$faecher,
            'landkreise' => FilterController::$landkreise,
        ]);
    }

}
