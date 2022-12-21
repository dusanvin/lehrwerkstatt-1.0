<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use DB;

class FilterController extends Controller
{
    private $faecher = [
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

    private $landkreise = [
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

    private function getUnmatchedUsers($roleName)
    {
        if($roleName == 'lehr') {
            $assigned_lehr_ids = DB::table('lehr_stud')->where('is_matched', true)->orWhere('is_notified', true)->pluck('lehr_id');
            $unassigned = User::where('role', 'Lehr')->where('is_evaluable', true)->whereNotIn('id', $assigned_lehr_ids)->orderBy('nachname', 'asc')->get();
        }

        if($roleName == 'stud') {
            $assigned_stud_ids = DB::table('lehr_stud')->where('is_matched', true)->orWhere('is_notified', true)->pluck('stud_id');
            $unassigned = User::where('role', 'Stud')->where('is_evaluable', true)->whereNotIn('id', $assigned_stud_ids)->orderBy('nachname', 'asc')->get();
        }

        foreach ($unassigned as $user) {
            $user->survey_data = json_decode($user->survey_data);
        }

        return $unassigned;
    }

    private function implodeFaecher($users)
    {
        foreach ($users as $user) {
            if (isset($user->survey_data->faecher))
                $user->survey_data->faecher = implode(', ', $user->survey_data->faecher);
        }
        return $users;
    }

    private function implodeLandkreise($users) {
        foreach ($users as $user) {
            if (isset($user->survey_data->landkreise))
                $user->survey_data->landkreise = implode(', ', $user->survey_data->landkreise);
        }
        return $users;
    }

    private function filterSchule($request, $users)
    {
        if ($request->schulart != 'Beliebig') {
            if ($request->schulart == 'Grundschule') {
                $users = $users->reject(function ($user, $key) {
                    return $user->survey_data->schulart != 'Grundschule';
                });
            } elseif ($request->schulart == 'Realschule') {
                $users = $users->reject(function ($user, $key) {
                    return $user->survey_data->schulart != 'Realschule';
                });
            } elseif ($request->schulart == 'Gymnasium') {
                $users = $users->reject(function ($user, $key) {
                    return $user->survey_data->schulart != 'Gymnasium';
                });
            }
        }
        return $users;
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


    public function lehr(Request $request, $schulart=null)
    {
        $view = 'all';
        $users = $this->getUnmatchedUsers('lehr');
        if(!empty($schulart)) {
            $view = $schulart;
            $request->schulart = $schulart;
            $users = $this->filterSchule($request, $users);
        }
        $this->implodeFaecher($users);
        return view('offers.'.$view, [
            'users' => $users,
            'faecher' => $this->faecher,
            'landkreise' => $this->landkreise,
            'schulart' => $schulart,
        ]);
    }


    public function stud(Request $request, $schulart=null)
    {
        $view = 'all';
        $users = $this->getUnmatchedUsers('stud');
        if(!empty($schulart)) {
            $view = $schulart;
            $request->schulart = $schulart;
            $users = $this->filterSchule($request, $users);
        }
        $users = $this->implodeFaecher($users);
        $users = $this->implodeLandkreise($users);
        return view('needs.'.$view, [
            'users' => $users,
            'faecher' => $this->faecher,
            'landkreise' => $this->landkreise
        ]);
    }


    public function filteredLehr(Request $request, $schulart=null)
    {
        $view = $schulart == null ? 'all': $schulart;
        $users = $this->getUnmatchedUsers('lehr');
        $users = $this->filterSchule($request, $users);

        $selected_faecher = [];
        if ($request->faecher) {
            $selected_faecher = explode(',', $request->faecher);
            $users = $this->filterFaecher($selected_faecher, $users);
        }
        $users = $this->implodeFaecher($users);

        $selected_landkreise = [];
        if ($request->landkreise) {
            $selected_landkreise = explode(',', $request->landkreise);
            $users = $this->filterLandkreise($selected_landkreise, $users);
        }
        $users = $users->values(); // reset keys
        return view('offers.'.$view, [
            'users' => $users,
            'schulart' => $request->schulart,
            'faecher' => $this->faecher,
            'selected_faecher' => $selected_faecher,
            'landkreise' => $this->landkreise,
            'selected_landkreise' => $selected_landkreise,
            // 'berufserfahrung' => $request->berufserfahrung,
        ]);
    }


    public function filteredStud(Request $request, $schulart=null)
    {
        $view = $schulart == null ? 'all': $schulart;
        $users = $this->getUnmatchedUsers('stud');
        $users = $this->filterSchule($request, $users);

        $selected_faecher = [];
        if ($request->faecher) {
            $selected_faecher = explode(',', $request->faecher);
            $users = $this->filterFaecher($selected_faecher, $users);
        }
        $users = $this->implodeFaecher($users);
        
        $selected_landkreise = [];
        if ($request->landkreise) {
            $selected_landkreise = explode(',', $request->landkreise);
            $users = $this->filterLandkreise($selected_landkreise, $users);
        }
        $users = $this->implodeLandkreise($users);

        return view('needs.'.$view, [
            'users' => $users,
            'schulart' => $request->schulart,
            'faecher' => $this->faecher,
            'selected_faecher' => $selected_faecher,
            'landkreise' => $this->landkreise,
            'selected_landkreise' => $selected_landkreise,
        ]);
    }


    static function getAllLehr($schulart=null) {
        $users = User::where('role', 'Lehr')->where('is_evaluable', true)->orderBy('nachname', 'asc')->get();

        foreach ($users as $user) {
            $user->survey_data = json_decode($user->survey_data);
        }

        if ($schulart == 'Grundschule') {
            $users = $users->reject(function ($user, $key) {
                return $user->survey_data->schulart != 'Grundschule';
            });
        } elseif ($schulart == 'Realschule') {
            $users = $users->reject(function ($user, $key) {
                return $user->survey_data->schulart != 'Realschule';
            });
        } elseif ($schulart == 'Gymnasium') {
            $users = $users->reject(function ($user, $key) {
                return $user->survey_data->schulart != 'Gymnasium';
            });
        }

        foreach ($users as $user) {
            if (isset($user->survey_data->faecher))
                $user->survey_data->faecher = implode(', ', $user->survey_data->faecher);
        }

        $users = $users->values();
        return $users;
    }


    static function getAllStud($schulart=null) {
        $users = User::where('role', 'Stud')->where('is_evaluable', true)->orderBy('nachname', 'asc')->get();

        foreach ($users as $user) {
            $user->survey_data = json_decode($user->survey_data);
        }

        if ($schulart == 'Grundschule') {
            $users = $users->reject(function ($user, $key) {
                return $user->survey_data->schulart != 'Grundschule';
            });
        } elseif ($schulart == 'Realschule') {
            $users = $users->reject(function ($user, $key) {
                return $user->survey_data->schulart != 'Realschule';
            });
        } elseif ($schulart == 'Gymnasium') {
            $users = $users->reject(function ($user, $key) {
                return $user->survey_data->schulart != 'Gymnasium';
            });
        }

        foreach ($users as $user) {
            if (isset($user->survey_data->faecher))
                $user->survey_data->faecher = implode(', ', $user->survey_data->faecher);
        }

        foreach ($users as $user) {
            if (isset($user->survey_data->landkreise))
                $user->survey_data->landkreise = implode(', ', $user->survey_data->landkreise);
        }

        foreach ($users as $user) {
            if (isset($user->survey_data->anmerkungen))
                $user->survey_data->anmerkungen = str_replace('"', "'", $user->survey_data->anmerkungen);
        }

        $users = $users->values();
        return $users;

    }

}
