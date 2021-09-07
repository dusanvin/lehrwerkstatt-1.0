<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Need;

class NeedRequestController extends Controller
{
    public function store(Need $need, Request $request)
    {

    	// Das kann man beliebig oft machen
    	$need->requests()->create([
    		'user_id' => $request->user()->id,
    	]);

    	return back();
    }

    public function destroy(Need $need, Request $request)
    {
    	$need->requests()->where('user_id', $request->user()->id)->delete();

    	return back();
    }
}
