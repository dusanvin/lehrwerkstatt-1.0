<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DateController;
use App\Http\Controllers\StatsController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\MatchingController;
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

    Route::group(['middleware' => ['role:Lehr']], function () {

        Route::post('/bewerbungsformular/registrierungscode', function(Request $request) {
            $codes = DB::table('registration_codes')->where('code', $request->code)->get();
            return $codes->count();
        });
 
    });


    // Alle Nutzer
    Route::group(['middleware' => ['role:Admin|Moderierende|Lehr|Stud']], function () {

        Route::post('/bewerbungsformular', [UserController::class, 'save']);

        Route::post('/acceptMatching', [MatchingController::class, 'acceptMatching'])->name('acceptMatching');
        Route::post('/declineMatching', [MatchingController::class, 'declineMatching'])->name('declineMatching');

    });

    // Adminbereich
    Route::group(['middleware' => ['role:Admin|Moderierende']], function () {

        // Lehrkräfte
        Route::get('/angebote/lehr/{schulart?}', [FilterController::class, 'lehr'])
            ->name('users.lehr');

        Route::post('/angebote/lehr/{schulart?}', [FilterController::class, 'filteredLehr'])
            ->name('users.lehr');

        // Student*innen
        Route::get('/angebote/stud/{schulart?}', [FilterController::class, 'stud'])
            ->name('users.stud');

        Route::post('/angebote/stud/{schulart?}', [FilterController::class, 'filteredStud'])
            ->name('users.stud');

        Route::get('/mode', function() {
            return dd(config('app.debug'));
        });

        
        // Wunschtandems
        Route::get('/matchings/preferences/{schulart?}', [MatchingController::class, 'preferences'])->name('matchings.preferences');

        // Tandemvorschläge
        Route::get('/matchable/{schulart?}', [MatchingController::class, 'matchable'])->name('users.matchable');

        // Tandems
        Route::get('/accepted-matchings/{schulart?}', [MatchingController::class, 'acceptedMatchings'])->name('acceptedMatchings');
        Route::get('/declined-matchings/{schulart?}', [MatchingController::class, 'declinedMatchings'])->name('declinedMatchings');

        Route::get('/matchings/{lehr}/{stud}/assign', [MatchingController::class, 'setAssigned'])->name('matchings.setassigned');
        Route::get('/matchings/{lehr}/{stud}/unassign', [MatchingController::class, 'setUnassigned'])->name('matchings.setunassigned');

        Route::get('/notifyMatchings/{schulart?}', [MatchingController::class, 'notifyMatchings'])->name('notifyMatchings');

        Route::get('/resetMatching/{lehr}/{stud}', [MatchingController::class, 'resetMatching'])->name('resetMatching');

        Route::get('/profile/details/{id}', [ProfileController::class, 'show'])
        ->name('profile.details');

    });


    /*--------------------------------------------------------------------------*/

    /* Profilbereich */
    Route::group(['middleware' => ['role:Admin|Moderierende|Lehr|Stud']], function () {

        // Route::get('/profile/details/{id}', [ProfileController::class, 'show'])
        //     ->name('profile.details');

        Route::get('/profile/edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::get('/profile/account', [ProfileController::class, 'account'])
            ->name('profile.account');

        Route::get('/profile/matchings', [ProfileController::class, 'matchings'])
            ->name('profile.matchings');

        Route::resource('profiles', ProfileController::class);


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

        /* Statistiken */
        Route::get('/stats', [StatsController::class, 'index'])
            ->name('stats');

        /* Nutzende */
        Route::resource('users', UserController::class);

    });

    /* Zugriffsrechte Admin */
    Route::group(['middleware' => ['role:Admin']], function () {

        /* Rollen */
        Route::resource('roles', RoleController::class);
    });

    /*--------------------------------------------------------------------------*/

});
