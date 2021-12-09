<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OffersController extends Controller
{

	/* Nur erreichbar, wenn eingeloggt */

    // public function __construct()
    // {
    // 	$this->middleware(['auth']);
    // }

    public function index()
    {
    	/*dd(auth()->user());*/
        $offers = Offer::with([
            'user',
            'likes'
        ])->latest()->simplePaginate(10);

    	//return view('offers');
        return view('offers',[
            'offers' => $offers
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

        $request->user()->offers()->create([
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

    public function setinactive(Offer $offer) {
        if(!$offer->ownedBy(auth()->user())) {
            return back();
        }
        $offer->active = 0;
        $offer->save();

        return back();
    }

    public function destroy(Offer $offer)
    {
        if(!$offer->ownedBy(auth()->user())) {
            return back();
        }

        $offer->delete();

        return back();
        
    }
}
