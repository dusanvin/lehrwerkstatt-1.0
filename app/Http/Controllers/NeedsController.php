<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;
use App\Models\Language;

class NeedsController extends Controller
{


    public function all()
    {
        $needs = Need::with([
            'user',
            'likes'
        ])->latest()->simplePaginate(10);

        return view('needs.all', [
            'needs' => $needs
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
        return view('needs.edit', ['need' => $need, 'languages' => $languages]);
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
