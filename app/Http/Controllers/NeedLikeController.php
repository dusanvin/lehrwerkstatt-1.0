<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;

class NeedLikeController extends Controller
{
    // public function __construct () 
    // {
    // 	$this->middleware(['auth']);
    // }

    public function store(Need $need, Request $request)
    {

    	// Das kann man beliebig oft machen
    	$need->likes()->create([
    		'user_id' => $request->user()->id,
    	]);

    	return back();
    }

    public function destroy(Need $need, Request $request)
    {
    	$need->likes()->where('user_id', $request->user()->id)->delete();

    	return back();
    }

}
