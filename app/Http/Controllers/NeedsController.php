<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;

class NeedsController extends Controller
{

	/* Nur erreichbar, wenn eingeloggt */

    public function __construct()
    {
    	$this->middleware(['auth']);
    }
	
    public function index()
    {
        /*dd(auth()->user());*/
        $needs = Need::with([
            'user'
        ])->latest()->simplePaginate(5);

        //return view('needs');
        return view('needs',[
            'needs' => $needs
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'rahmen' => 'required',
            'sprachkenntnisse' => 'required',
            'studiengang' => 'required',
            'fachsemester' => 'required'
        ]);

        $request->user()->needs()->create([
            'body' => $request->body,
            'rahmen' => $request->rahmen,
            'sprachkenntnisse' => $request->sprachkenntnisse,
            'studiengang' => $request->studiengang,
            'fachsemester' => $request->fachsemester
        ]);

        return back();
    }

    public function destroy(Need $need)
    {

        $need->delete();

        return back();
        
    }

}
