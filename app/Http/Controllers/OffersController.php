<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OffersController extends Controller
{


    public function all()
    {
        $offers = Offer::with([
            'user',
            'likes'
        ])->latest()->simplePaginate(10);

        return view('offers.all', [
            'offers' => $offers
        ]);
    }


    public function user()
    {
        $offers = Offer::where('user_id', auth()->user()->id)->latest()->simplePaginate(10); //latest('updated_at')

        return view('offers.user', [
            'offers' => $offers
        ]);
    }


    public function make()
    {
        return view('offers.make');
    }


    public function edit(Offer $offer)
    {
        return view('offers.edit', ['offer' => $offer]);
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

        $offer_id = request('offer_id');

        if (isset($offer_id)) {
            $offer = Offer::where('id', $offer_id)->first();
            if (!$offer->ownedBy(auth()->user())) {
                return back();
            }
            $offer->body = $request->body;
            $offer->rahmen = $request->rahmen;
            $offer->sprachkenntnisse = $request->sprachkenntnisse;
            $offer->interessen = $request->interessen;
            $offer->studiengang = $request->studiengang;
            $offer->fachsemester = $request->fachsemester;
            $offer->datum_start = $startDate;
            $offer->datum_end = $endDate;
            $offer->schulart = $request->schulart;
            $offer->save();

        } else {
            $request->user()->offers()->create([
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

        $offers = Offer::where('user_id', auth()->user()->id)->latest()->simplePaginate(10); //'updated_at'
        return redirect()->route('offers.user', [
            'offers' => $offers
        ]); 
    }


    public function setinactive(Offer $offer)
    {
        if (!$offer->ownedBy(auth()->user())) {
            return back();
        }

        $offer->active = 0;
        $offer->save();
        return back();
    }


    public function setactive(Offer $offer)
    {
        if (!$offer->ownedBy(auth()->user())) {
            return back();
        }

        $offer->active = 1;
        $offer->save();
        return back();
    }


    public function destroy(Offer $offer)
    {
        if (!$offer->ownedBy(auth()->user())) {
            return back();
        }

        $offer->delete();
        return back();
    }
}
