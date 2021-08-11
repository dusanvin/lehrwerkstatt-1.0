<?php

/* Controller */

	/* Guest */

	use App\HTTP\Controllers\Auth\RegisterController;
	use App\HTTP\Controllers\Auth\LoginController;
	use App\HTTP\Controllers\Auth\LogoutController;

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

	/* Allgemein */

	use Illuminate\Support\Facades\Route;

	/* Verification */
	use Illuminate\Foundation\Auth\EmailVerificationRequest;
	use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*--------------------------------------------------------------------------*/

/* Guest */

	/* Functionality */
		Route::post('/register', [RegisterController::class,'store']);

		Route::post('/login', [LoginController::class,'store']);

	/* Sites */

		/* Landing Page */
		Route::get('/', function () {
		    return view('layouts.hero');
		})->name('home');

		/* Registrieren */
		Route::get('/register', [RegisterController::class,'index'])
			->name('register');

		/* Anmelden */
		Route::get('/login', [LoginController::class,'index'])
			->name('login');

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

		/* Functionality */
		/* Ausloggen */
		Route::post('/logout', [LogoutController::class,'store'])
			->name('logout');

	/* Sites */
		/* Dashboard */
		Route::get('/dashboard', [DashboardController::class,'index'])
			->name('dashboard');

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


// verfication notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// verfication link was clicked 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');


// resend verfication link
Route::post('/email/verification-notification', function (Request $request) {
	//dd($request->all());
    $request->user()->sendEmailVerificationNotification();


    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
