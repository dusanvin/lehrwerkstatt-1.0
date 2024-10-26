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

    private static $schularten = [
        "Grundschule",
        "Realschule",
        "Gymnasium",
        "Mittelschule"
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

    static function getAvailableUsers($roleName, $schulart=null)
    {
        return User::where('role', ucfirst($roleName))
            ->where('is_evaluable', true)->where('is_available', true)
            ->when($schulart, function ($query, $schulart) {
                return $query->where('survey_data->schulart', $schulart);
            })
            ->orderBy('nachname', 'asc')
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
        $view = $schulart ?? 'all';
        $users = $this->getAvailableUsers('lehr', $schulart);

        return view('offers.'.$view, [
            'users' => $users,
            'faecher' => FilterController::$faecher,
            'landkreise' => FilterController::$landkreise,
            'schulart' => $schulart,
        ]);
    }

    // View: Studenten 
    public function stud(Request $request, $schulart=null)
    {
        $view = $schulart ?? 'all';
        $users = $this->getAvailableUsers('stud', $schulart);

        return view('needs.'.$view, [
            'users' => $users,
            'faecher' => FilterController::$faecher,
            'landkreise' => FilterController::$landkreise,
            'schulart' => $schulart,
        ]);
    }


    // View: 
    public function filteredLehr(Request $request, $schulart=null)
    {
        $view = $schulart ?? 'all';
        $users = $this->getAvailableUsers('Lehr', $schulart);

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

        return view('offers.'.$view, [
            'users' => $users,
            'schulart' => $request->schulart,
            'faecher' => $this->faecher,
            'selected_faecher' => $selected_faecher,
            'landkreise' => $this->landkreise,
            'selected_landkreise' => $selected_landkreise,
        ]);
    }

    // View:
    public function filteredStud(Request $request, $schulart=null)
    {
        $view = $schulart ?? 'all';
        $users = $this->getAvailableUsers('Stud', $schulart);

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

        return view('needs.'.$view, [
            'users' => $users,
            'schulart' => $request->schulart,
            'faecher' => $this->faecher,
            'selected_faecher' => $selected_faecher,
            'landkreise' => $this->landkreise,
            'selected_landkreise' => $selected_landkreise,
        ]);
    }

}
