<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;

class NeedsController extends Controller
{

	/* Nur erreichbar, wenn eingeloggt */

    // public function __construct()
    // {
    // 	$this->middleware(['auth']);
    // }
	
    public function index()
    {
        /*dd(auth()->user());*/
        $needs = Need::with([
            'user',
            'likes'
        ])->latest()->simplePaginate(10);

        //return view('needs');
        return view('needs',[
            'needs' => $needs
        ]);
    }

    public function store(Request $request)
    {
        $dates = explode('bis', $request->datum);
        $startDate = trim($dates[0]);
        if (1 == preg_match('/bis/', $request->datum)) {
            $endDate = trim($dates[1]);
        }
        else $endDate = $startDate;

        $this->validate($request, [
            'body' => 'required',
            'rahmen' => 'required',
            'sprachkenntnisse' => 'required',
            'studiengang' => 'required',
            'fachsemester' => 'required',
            'datum' => 'required'
        ]);

        $request->user()->needs()->create([
            'body' => $request->body,
            'rahmen' => $request->rahmen,
            'sprachkenntnisse' => $request->sprachkenntnisse,
            'studiengang' => $request->studiengang,
            'fachsemester' => $request->fachsemester,
            'datum_start' => $startDate,
            'datum_end' => $endDate,
            'active' => 1,
        ]);

        return back();
    }

    public function destroy(Need $need)
    {
        if(!$need->ownedBy(auth()->user())) {
            return back();
        }

        $need->delete();

        return back();
        
    }

}
