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
use App\Http\Controllers\OfferRequestController;
use App\Http\Controllers\NeedsController;
use App\Http\Controllers\NeedLikeController;
use App\Http\Controllers\NeedRequestController;
use App\Http\Controllers\MatchingController;
use App\HTTP\Controllers\User\UserEditController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MessagesController;

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
Route::middleware(['auth', 'verified'])->group(function () {

    /* Helfende */
    Route::get('/help', [HelpController::class, 'index'])
        ->name('help');

    /* Lernende */
    Route::get('/learn', [LearnController::class, 'index'])
        ->name('learn');

    /* Moderierende/Beauftragte */
    Route::get('/mod', [ModController::class, 'index'])
        ->name('mod');



    /* Angebote */
    Route::get('/offers/all', [OffersController::class, 'all'])
        ->name('offers.all');

    Route::get('/offers/myoffers', [OffersController::class, 'user'])
        ->name('offers.user');

    Route::get('/offers/make', [OffersController::class, 'make'])
        ->name('offers.make');

    Route::post('/offers', [OffersController::class, 'store'])
        ->name('offers');

    /* Angebot: Löschen */
    Route::delete('/offers/{offer}', [OffersController::class, 'destroy'])
        ->name('offers.destroy');

    /* Angebote Likes Hinzufügen */
    Route::post('/offers/{offer}/likes', [OfferLikeController::class, 'store'])
        ->name('offers.likes');

    /* Angebote: inaktiv setzen */
    Route::post('/offers/{offer}/setinactive', [OffersController::class, 'setinactive'])
        ->name('offers.setinactive');

    /* Angebote: aktiv setzen */
    Route::post('/offers/{offer}/setactive', [OffersController::class, 'setactive'])
        ->name('offers.setactive');

    /* Angebote Likes Löschen */
    Route::delete('/offers/{offer}/likes', [OfferLikeController::class, 'destroy'])
        ->name('offers.likes');

    /* Angebote Requests Hinzufügen */
    Route::post('/offers/{offer}/requests', [OfferRequestController::class, 'store'])
        ->name('offers.requests');

    /* Angebote Requests Löschen */
    Route::delete('/offers/{offer}/requests', [OfferRequestController::class, 'destroy'])
        ->name('offers.requests');



    /* Bedarfe 
    Route::group(['prefix' => 'needs'], function () {
        Route::get('{id}', ['as' => 'needs.show', 'uses' => 'App\Http\Controllers\MessagesController@show']);
    });*/

    Route::get('/needs/all', [NeedsController::class, 'all'])
        ->name('needs.all');

    Route::get('/needs/myneeds', [NeedsController::class, 'user'])
        ->name('needs.user');

    Route::get('/needs/make', [NeedsController::class, 'make'])
        ->name('needs.make');

    /* Bedarf: Hinzufügen */
    Route::post('/needs', [NeedsController::class, 'store'])
        ->name('needs');

    /* Bedarf: inaktiv setzen */
    Route::post('/needs/{need}/setinactive', [NeedsController::class, 'setinactive'])
        ->name('needs.setinactive');

    /* Bedarf: aktiv setzen */
    Route::post('/needs/{need}/setactive', [NeedsController::class, 'setactive'])
        ->name('needs.setactive');

    /* Bedarf: Löschen */
    Route::delete('/needs/{need}', [NeedsController::class, 'destroy'])
        ->name('needs.destroy');

    /* Needs Likes Hinzufügen */
    Route::post('/needs/{need}/likes', [NeedLikeController::class, 'store'])
        ->name('needs.likes');

    /* Needs Likes Löschen */
    Route::delete('/needs/{need}/likes', [NeedLikeController::class, 'destroy'])
        ->name('needs.likes');

    /* Needs Anfrage Hinzufügen */
    Route::post('/needs/{need}/requests', [NeedRequestController::class, 'store'])
        ->name('needs.requests');

    /* Needs Anfrage Löschen */
    Route::delete('/needs/{need}/requests', [NeedRequestController::class, 'destroy'])
        ->name('needs.requests');


    /* Zuweisungen */
    Route::get('/matching', [MatchingController::class, 'index'])
        ->name('matching');

    /* Nachrichten */
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'App\Http\Controllers\MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'App\Http\Controllers\MessagesController@create']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'App\Http\Controllers\MessagesController@store']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'App\Http\Controllers\MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'App\Http\Controllers\MessagesController@update']);
        Route::get('{id}/delete', 'App\Http\Controllers\MessagesController@delete')->name('messages.delete');
    });

    Route::group(['middleware' => ['role:Admin|Moderierende|Lehrende|Helfende', 'auth', 'verified']], function () {
        Route::get('/profile/details', [UserController::class, 'details'])
            ->name('profile.details');
        Route::get('/profile/edit', [UserController::class, 'uedit'])
            ->name('profile.edit');
        Route::resource('profiles', ProfileController::class);
    });
});


/* Rollen und Zugriffsrechte */
Route::group(['middleware' => ['role:Admin|Moderierende', 'auth', 'verified']], function () {
    //
    /* Account bearbeiten */
    Route::get('/user', [UserEditController::class, 'index'])
        ->name('user');

    /* Statistiken */
    Route::get('/stats', [StatsController::class, 'index'])
        ->name('stats');


    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});


/*--------------------------------------------------------------------------*/


Route::get('/datepicker', [DateController::class, 'index']);
