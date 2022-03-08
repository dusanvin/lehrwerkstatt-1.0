<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Language;
use Carbon\Carbon;

class OffersController extends Controller
{


    public function all()
    {
        $offers = Offer::with([
            'user',
            'likes'
        ])->latest()->simplePaginate(10);

        $languages = Language::all();
        foreach ($languages as $language => $value) {
            if ($value->Sprache == 'Keine') {
                $languages->forget($language);
            }
        }
        return view('offers.all', [
            'offers' => $offers,
            'languages' => $languages,
            'startDate' => now(),
            'endDate' => now()->addMonths(1),
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
        // dd($request->interessen);
        $dates = explode('bis', $request->datum);
        $startDate = trim($dates[0]);
        if (1 == preg_match('/bis/', $request->datum)) {
            $endDate = trim($dates[1]);
        } else $endDate = $startDate;

        $startDate = new Carbon($startDate);
        $endDate = new Carbon($endDate);

        $offers = Offer::query();
        $offers = $offers->where([
            ['datum_end', '>', $startDate], // Angebote die zu Beginn des Suchzeitraums noch nicht beendet sind
            ['datum_start', '<', $endDate], // Angebote die noch vor dem Ende des Suchzeitraums beginnen
        ]);

        if ($request->rahmen != 'Beliebig') {
            $offers = $offers->where('rahmen', '<=', $request->rahmen);
        }
        if ($request->schulart != 'Beliebig') {
            $offers = $offers->where('schulart', $request->schulart);
        }
        if ($request->sprachkenntnisse != 'Beliebig') {
            $offers = $offers->where('sprachkenntnisse', $request->sprachkenntnisse);
        }
        if ($request->studiengang != 'Beliebig') {
            $offers = $offers->where('studiengang', $request->studiengang);
        }
        if ($request->fachsemester != 'Beliebig') {

            $offers = $offers->where('fachsemester', '>=', $request->fachsemester);
        }
        $offers = $offers->with([
            'user',
            'likes'
        ])->latest()->simplePaginate(10);

        $languages = Language::all();
        foreach ($languages as $language => $value) {
            if ($value->Sprache == 'Keine') {
                $languages->forget($language);
            }
        }

        $interessen = $request->interessen;
        $interessen = explode(',', $interessen);

        return view('offers.all', [
            'offers' => $offers,
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
        $offers = Offer::where('user_id', auth()->user()->id)->latest()->simplePaginate(10); //latest('updated_at')

        return view('offers.user', [
            'offers' => $offers
        ]);
    }


    public function make()
    {
        $languages = Language::all();
        return view('offers.make', ['languages' => $languages]);
    }


    public function edit(Offer $offer)
    {
        $languages = Language::all();
        $interessen = $offer->interessen;
        $interessen = explode(',', $interessen);
        return view(
            'offers.edit',
            [
                'offer' => $offer,
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
