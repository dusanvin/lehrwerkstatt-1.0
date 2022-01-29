<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;
use Auth;

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
        $needs = Need::with([
            'user',
            'likes'
        ]);

        $needs = Need::where('user_id', auth()->user()->id)->latest()->simplePaginate(10);

        return view('needs.user', [
            'needs' => $needs
        ]);
    }


    public function make()
    {

        return view('needs.make');
    }


    public function edit(Need $need)
    {
        return view('needs.edit', ['need' => $need]);
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
            $need->body = $request->body;
            $need->rahmen = $request->rahmen;
            $need->sprachkenntnisse = $request->sprachkenntnisse;
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
                'studiengang' => $request->studiengang,
                'fachsemester' => $request->fachsemester,
                'datum_start' => $startDate,
                'datum_end' => $endDate,
                'schulart' => $request->schulart,
                'active' => 1,
            ]);
        }

        session()->flash('success', 'true');

        // $needs = Need::with([
        //     'user',
        //     'likes'
        // ]);

        $needs = Need::where('user_id', auth()->user()->id)->latest()->simplePaginate(10);

        return view('needs.user', [
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
