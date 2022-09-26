<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DateController;
use App\Http\Controllers\StatsController;

use App\Http\Controllers\OffersController;
use App\Http\Controllers\OfferLikeController;
use App\Http\Controllers\OfferRequestController;
use App\Http\Controllers\NeedsController;
use App\Http\Controllers\NeedLikeController;
use App\Http\Controllers\NeedRequestController;

use App\Http\Controllers\MatchingController;
use App\Http\Controllers\UserController;
use App\HTTP\Controllers\User\UserEditController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FilterController;

use Illuminate\Support\Facades\DB;

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

/*--------------------------------------------------------------------------*/

/* Generell erreichbar */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

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

/* Nach Verifizierung */

Route::middleware(['auth', 'verified'])->group(function () {

    /* Allgemein */
    /* Datum auswählen bei Angebot/Bedarf */
    Route::get('/datepicker', [DateController::class, 'index']);

    /*--------------------------------------------------------------------------*/

    /* Bewerbungsformular */

    // Lehrkräfte
    Route::group(['middleware' => ['role:Lehr']], function () {

        Route::get('/bewerbungsformular/lehr', function() {
            return view('surveys.lehr');
        })->name('surveys.lehr');

        Route::post('/bewerbungsformular/registrierungscode', function(Request $request) {
            $codes = DB::table('registration_codes')->where('code', $request->code)->get();
            return $codes->count();
        });
 
    });

    // Studenten
    Route::group(['middleware' => ['role:Stud']], function () {

        Route::get('/bewerbungsformular/stud', function() {
            return view('surveys.stud');
        })->name('surveys.stud');

    });

    // Alle Nutzer
    Route::group(['middleware' => ['role:Admin|Moderierende|Lehr|Stud']], function () {

        Route::post('/bewerbungsformular', [UserController::class, 'save']);

        Route::post('/acceptMatching', [UserController::class, 'acceptMatching'])->name('acceptMatching');

    });

    // Adminbereich
    Route::group(['middleware' => ['role:Admin|Moderierende']], function () {

        Route::get('/angebote/lehr/{schulart?}', [FilterController::class, 'lehr'])
            ->name('users.lehr');

        Route::post('/angebote/lehr/{schulart?}', [FilterController::class, 'filteredLehr'])
            ->name('users.lehr');

        Route::get('/angebote/stud/{schulart?}', [FilterController::class, 'stud'])
            ->name('users.stud');

        Route::post('/angebote/stud/{schulart?}', [FilterController::class, 'filteredStud'])
            ->name('users.stud');

        Route::get('/matchings', [UserController::class, 'matchings'])->name('users.matchings');

        Route::get('/accepted-matchings', [UserController::class, 'acceptedMatchings'])->name('acceptedMatchings');

        Route::get('/matchings/{lehr}/{stud}/{mse}', [UserController::class, 'setAssigned'])->name('matchings.setassigned');

        Route::get('/matchings/{lehr}/{stud}', [UserController::class, 'setUnassigned'])->name('matchings.setunassigned');

        Route::post('/addMatching', [UserController::class, 'addMatching'])->name('users.addMatching');

    });


    /*--------------------------------------------------------------------------*/

    /* Profilbereich */
    Route::group(['middleware' => ['role:Admin|Moderierende|Lehr|Stud']], function () {

        Route::get('/profile/details/{id}', [ProfileController::class, 'show'])
            ->name('profile.details');

        Route::get('/profile/edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::get('/profile/account', [ProfileController::class, 'account'])
            ->name('profile.account');

        Route::get('/profile/matchings', [ProfileController::class, 'matchings'])
            ->name('profile.matchings');

        Route::resource('profiles', ProfileController::class);

        // Route::get('/image', [ImageController::class, 'index'])
        //     ->name('images.index');
        Route::post('/image', [ImageController::class, 'store'])
            ->name('images.store');
        Route::get('/images/show/{user_id}', [ImageController::class, 'show'])
            ->name('images.show');
        Route::post('images/delete/{user_id}', [ImageController::class, 'destroy'])
            ->name('images.destroy');
    });

    /*--------------------------------------------------------------------------*/

    /* Nachrichten */
    Route::group(['prefix' => 'messages'], function () {

        Route::get('/', ['as' => 'messages', 'uses' => 'App\Http\Controllers\MessagesController@index']);

        Route::get('create/{id}', ['as' => 'messages.create', 'uses' => 'App\Http\Controllers\MessagesController@create']);

        Route::post('/', ['as' => 'messages.store', 'uses' => 'App\Http\Controllers\MessagesController@store']);

        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'App\Http\Controllers\MessagesController@show']);

        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'App\Http\Controllers\MessagesController@update']);

        Route::get('{id}/delete', 'App\Http\Controllers\MessagesController@delete')->name('messages.delete');
    });

    /*--------------------------------------------------------------------------*/

    /* Zugriffsrechte Moderierende + Admin*/
    Route::group(['middleware' => ['role:Admin|Moderierende']], function () {

        /* Account bearbeiten */
        Route::get('/user', [UserEditController::class, 'index'])
            ->name('user');

        /* Statistiken */
        Route::get('/stats', [StatsController::class, 'index'])
            ->name('stats');

        /* Nutzende */
        Route::resource('users', UserController::class);

        /* Produkte - Test */
        Route::resource('products', ProductController::class);
    });

    /* Zugriffsrechte Admin */
    Route::group(['middleware' => ['role:Admin']], function () {

        /* Rollen */
        Route::resource('roles', RoleController::class);
    });

    /*--------------------------------------------------------------------------*/

    /* Angebote */

    /* Zugriffsrechte Alle */
    Route::group(['middleware' => ['role:Admin|Moderierende|Lehr|Stud']], function () {

        /* Alle Angebote anzeigen*/
        Route::get('/offers/all', [OffersController::class, 'all'])
            ->name('offers.all');

        Route::post('/offers/all', [OffersController::class, 'filtered'])
            ->name('offers.all');

        /* Angebote Likes Hinzufügen */
        Route::post('/offers/{offer}/likes', [OfferLikeController::class, 'store'])
            ->name('offers.likes');

        /* Angebote Likes Löschen */
        Route::delete('/offers/{offer}/likes', [OfferLikeController::class, 'destroy'])
            ->name('offers.likes');

        /* Angebote Requests Hinzufügen */
        Route::post('/offers/{offer}/requests', [OfferRequestController::class, 'store'])
            ->name('offers.requests');

        /* Angebote Requests Löschen */
        Route::delete('/offers/{offer}/requests', [OfferRequestController::class, 'destroy'])
            ->name('offers.requests');
    });

    /* Zugriffsrechte Helfende im Speziellen */
    Route::group(['middleware' => ['role:Admin|Moderierende|Stud']], function () {

        /* Meine Angebote anzeigen*/
        Route::get('/offers/myoffers', [OffersController::class, 'user'])
            ->name('offers.user');

        /* Angebote erstellen*/
        Route::get('/offers/make', [OffersController::class, 'make'])
            ->name('offers.make');

        /* Angebote bearbeiten*/
        Route::post('/offers/{offer}/edit', [OffersController::class, 'edit'])
            ->name('offers.edit');

        /* Angebot: Posten */
        Route::post('/offers', [OffersController::class, 'store'])
            ->name('offers');

        /* Angebot: Löschen */
        Route::delete('/offers/{offer}', [OffersController::class, 'destroy'])
            ->name('offers.destroy');

        /* Angebote: inaktiv setzen */
        Route::post('/offers/{offer}/setinactive', [OffersController::class, 'setinactive'])
            ->name('offers.setinactive');

        /* Angebote: aktiv setzen */
        Route::post('/offers/{offer}/setactive', [OffersController::class, 'setactive'])
            ->name('offers.setactive');            

        /* Angebote: als vergeben markieren */
        Route::post('/offers/{offer}/setassigned', [OffersController::class, 'setassigned'])
            ->name('offers.setassigned');

        /* Angebote: als nicht vergeben markieren */
        Route::post('/offers/{offer}/setnotassigned', [OffersController::class, 'setnotassigned'])
            ->name('offers.setnotassigned');


    });

    /*--------------------------------------------------------------------------*/

    /* Bedarfe */

    /* Zugriffsrechte Alle */
    Route::group(['middleware' => ['role:Admin|Moderierende|Lehr|Stud']], function () {

        /* Alle Bedarfe anzeigen*/
        Route::get('/needs/all', [NeedsController::class, 'all'])
            ->name('needs.all');

        Route::post('/needs/all', [NeedsController::class, 'filtered'])
            ->name('needs.all');

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
    });

    /* Zugriffsrechte Lehrende im Speziellen */

    Route::group(['middleware' => ['role:Admin|Moderierende|Lehr']], function () {

        /* Meine Bedarfe anzeigen*/
        Route::get('/needs/myneeds', [NeedsController::class, 'user'])
            ->name('needs.user');

        /* Bedarfe erstellen*/
        Route::get('/needs/make', [NeedsController::class, 'make'])
            ->name('needs.make');

        /* Bedarfe bearbeiten*/
        Route::post('/needs/{need}/edit', [NeedsController::class, 'edit'])
            ->name('needs.edit');

        /* Bedarf: Hinzufügen */
        Route::post('/needs', [NeedsController::class, 'store'])
            ->name('needs');

        /* Bedarf: Löschen */
        Route::delete('/needs/{need}', [NeedsController::class, 'destroy'])
            ->name('needs.destroy');

        /* Bedarf: inaktiv setzen */
        Route::post('/needs/{need}/setinactive', [NeedsController::class, 'setinactive'])
            ->name('needs.setinactive');

        /* Bedarf: aktiv setzen */
        Route::post('/needs/{need}/setactive', [NeedsController::class, 'setactive'])
            ->name('needs.setactive');

        /* Bedarf: als derzeit vergeben markieren */
        Route::post('/needs/{need}/setassigned', [NeedsController::class, 'setassigned'])
            ->name('needs.setassigned');

        /* Bedarf: als derzeit vergeben markieren */
        Route::post('/needs/{need}/setnotassigned', [NeedsController::class, 'setnotassigned'])
            ->name('needs.setnotassigned');
    });

    /*--------------------------------------------------------------------------*/

    /* Matching */

    /* Zuweisungen */
    Route::get('/matching', [MatchingController::class, 'index'])
        ->name('matching');
});
