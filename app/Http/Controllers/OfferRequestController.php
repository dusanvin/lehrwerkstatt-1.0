<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OfferRequestController extends Controller
{
    public function store(Offer $offer, Request $request)
    {

    	// Das kann man beliebig oft machen
    	$offer->requests()->create([
    		'user_id' => $request->user()->id,
    	]);

    	return back();
    }

    public function destroy(Offer $offer, Request $request)
    {
    	$offer->requests()->where('user_id', $request->user()->id)->delete();

    	return back();
    }
}
