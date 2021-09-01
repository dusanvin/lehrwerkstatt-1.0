<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* user */
use App\Http\Controllers\DateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\ModController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\OfferLikeController;
use App\Http\Controllers\NeedsController;
use App\Http\Controllers\MatchingController;
use App\HTTP\Controllers\User\UserEditController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Sites */

		// /* Landing Page */
		// Route::get('/', function () {
		//     return view('layouts.hero');
		// })->name('home');

		/* Log */
		Route::get('/log', function () {
		    return view('layouts.content');
		});

		/* FAQ */
		Route::get('/faq', function () {
		    return view('faq');
		});

		/* Näheres zum digi:match */
		Route::get('/about', function () {
		    return view('about');
		});

/*--------------------------------------------------------------------------*/

/* User */
Route::middleware(['auth', 'verified'])->group(function() {

    /* Statistiken */
    Route::get('/stats', [StatsController::class,'index'])
        ->name('stats');

    /* Helfende */
    Route::get('/help', [HelpController::class,'index'])
        ->name('help');

    /* Lernende */
    Route::get('/learn', [LearnController::class,'index'])
        ->name('learn');

    /* Moderierende/Beauftragte */
    Route::get('/mod', [ModController::class,'index'])
        ->name('mod');



    /* Angebote */
    Route::get('/offers', [OffersController::class,'index'])
        ->name('offers');

    Route::post('/offers', [OffersController::class,'store']);

    /* Angebot: Löschen */
    Route::delete('/offers/{offer}', [OffersController::class,'destroy'])
        ->name('offers.destroy');

        /* Angebote Likes Hinzufügen */
        Route::post('/offers/{offer}/likes', [OfferLikeController::class,'store'])
            ->name('offers.likes');

        /* Angebote Likes Löschen */
        Route::delete('/offers/{offer}/likes', [OfferLikeController::class,'destroy'])
            ->name('offers.likes');



    /* Bedarfe */
    Route::get('/needs', [NeedsController::class,'index'])
        ->name('needs');

    /* Bedarf: Hinzufügen */
    Route::post('/needs', [NeedsController::class,'store']);

    /* Bedarf: Löschen */
    Route::delete('/needs/{need}', [NeedsController::class,'destroy'])
        ->name('needs.destroy');


    /* Zuweisungen */
    Route::get('/matching', [MatchingController::class,'index'])
        ->name('matching');

    /* Account bearbeiten */
    Route::get('/user', [UserEditController::class,'index'])
        ->name('user');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});



/*--------------------------------------------------------------------------*/


Route::get('/datepicker', [DateController::class,'index']);
