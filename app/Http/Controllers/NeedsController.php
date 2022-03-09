<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;
use App\Models\Language;
use Carbon\Carbon;

class NeedsController extends Controller
{


    public function all()
    {
        $needs = Need::with([
            'user',
            'likes'
        ])->latest()->simplePaginate(10);

        $languages = Language::all();
        foreach ($languages as $language => $value) {
            if ($value->Sprache == 'Keine') {
                $languages->forget($language);
            }
        }
        return view('needs.all', [
            'needs' => $needs, 
            'languages' => $languages, 
            'startDate' => '',
            'endDate' => '',
            'rahmen' => 'Beliebig',
            'schulart' => 'Beliebig',
            'sprachkenntnisse' => 'Beliebig',
            'studiengang' => 'Beliebig',
            'fachsemester' => 'Beliebig',
            'interessen' => []
        ]);
    }


    public function filtered(Request $request)
    {
        $needs = Need::query();

        $dates = explode('bis', $request->datum);
        if (!is_null($request->datum)) {
            $startDate = trim($dates[0]);
            if (1 == preg_match('/bis/', $request->datum)) {
                $endDate = trim($dates[1]);
            } else $endDate = $startDate;

            $startDate = new Carbon($startDate);
            $endDate = new Carbon($endDate);

            $needs = $needs->where([
                ['datum_end', '>', $startDate],
                ['datum_start', '<', $endDate],
            ]);
        } else {
            $startDate = '';
            $endDate = '';
        }

        if ($request->rahmen != 'Beliebig') {
            $needs = $needs->where('rahmen', '<=', $request->rahmen);
        }
        if ($request->schulart != 'Beliebig') {
            $needs = $needs->where('schulart', $request->schulart);
        }
        if ($request->sprachkenntnisse != 'Beliebig') {
            $needs = $needs->where('sprachkenntnisse', $request->sprachkenntnisse);
        }
        if ($request->studiengang != 'Beliebig') {
            $needs = $needs->where('studiengang', $request->studiengang);
        }
        if ($request->fachsemester != 'Beliebig') {
            $needs = $needs->where('fachsemester', '>=', $request->fachsemester);
        }

        $interessen = $request->interessen;
        $interessen = explode(',', $interessen);

        foreach($interessen as $interesse) {
            $needs = $needs->where('interessen', 'LIKE', '%'.$interesse.'%');
        }

        $needs = $needs->with([
            'user',
            'likes'
        ])->latest()->simplePaginate(10);

        $languages = Language::all();
        foreach ($languages as $language => $value) {
            if ($value->Sprache == 'Keine') {
                $languages->forget($language);
            }
        }

        return view('needs.all', [
            'needs' => $needs,
            'languages' => $languages,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'rahmen' => $request->rahmen,
            'schulart' => $request->schulart,
            'sprachkenntnisse' => $request->sprachkenntnisse,
            'studiengang' => $request->studiengang,
            'fachsemester' => $request->fachsemester,
            'interessen' => $interessen
        ]);
    }


    public function user()
    {
        $needs = Need::where('user_id', auth()->user()->id)->latest()->simplePaginate(10); //latest('updated_at')

        return view('needs.user', [
            'needs' => $needs
        ]);
    }


    public function make()
    {
        $languages = Language::all();
        return view('needs.make', ['languages' => $languages]);
    }


    public function edit(Need $need)
    {
        $languages = Language::all();
        $interessen = $need->interessen;
        $interessen = explode(',', $interessen);
        return view(
            'needs.edit',
            [
                'need' => $need,
                'languages' => $languages,
                'interessen' => $interessen
            ]
        );
    }


    public function store(Request $request)
    {
        $dates = explode('bis', $request->datum);
        $startDate = trim($dates[0]);
        if (1 == preg_match('/bis/', $request->datum)) {
            $endDate = trim($dates[1]);
        } else $endDate = $startDate;

        $this->validate($request, [
            'body' => 'required',
            'rahmen' => 'required',
            'sprachkenntnisse' => 'required',
            'studiengang' => 'required',
            'fachsemester' => 'required',
            'schulart' => 'required',
            'datum' => 'required'
        ]);

        $need_id = request('need_id');

        if (isset($need_id)) {

            $need = need::where('id', $need_id)->first();
            if (!$need->ownedBy(auth()->user())) {
                return back();
            }
            $need->body = $request->body;
            $need->rahmen = $request->rahmen;
            $need->sprachkenntnisse = $request->sprachkenntnisse;
            $need->interessen = $request->interessen;
            $need->studiengang = $request->studiengang;
            $need->fachsemester = $request->fachsemester;
            $need->datum_start = $startDate;
            $need->datum_end = $endDate;
            $need->schulart = $request->schulart;
            $need->save();
        } else {

            $request->user()->needs()->create([
                'body' => $request->body,
                'rahmen' => $request->rahmen,
                'sprachkenntnisse' => $request->sprachkenntnisse,
                'interessen' => $request->interessen,
                'studiengang' => $request->studiengang,
                'fachsemester' => $request->fachsemester,
                'datum_start' => $startDate,
                'datum_end' => $endDate,
                'schulart' => $request->schulart,
                'active' => 1,
            ]);
        }

        session()->flash('success', 'true');

        $needs = Need::where('user_id', auth()->user()->id)->latest()->simplePaginate(10);
        return redirect()->route('needs.user', [
            'needs' => $needs
        ]);
    }

    public function setinactive(Need $need)
    {
        if (!$need->ownedBy(auth()->user())) {
            return back();
        }

        $need->active = 0;
        $need->save();
        return back();
    }

    public function setactive(Need $need)
    {
        if (!$need->ownedBy(auth()->user())) {
            return back();
        }

        $need->active = 1;
        $need->save();
        return back();
    }

    public function destroy(Need $need)
    {
        if (!$need->ownedBy(auth()->user())) {
            return back();
        }

        $need->delete();
        return back();
    }
}
