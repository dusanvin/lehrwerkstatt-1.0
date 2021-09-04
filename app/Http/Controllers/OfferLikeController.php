<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Like;

class OfferLikeController extends Controller
{
    // public function __construct () 
    // {
    // 	$this->middleware(['auth']);
    // }

    public function store(Offer $offer, Request $request)
    {

    	// Das kann man beliebig oft machen
    	$offer->likes()->create([
    		'user_id' => $request->user()->id,
    	]);

    	return back();
    }

    public function destroy(Offer $offer, Request $request)
    {
    	$offer->likes()->where('user_id', $request->user()->id)->delete();

    	return back();
    }

}
