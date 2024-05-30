<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchFilterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});


Route::get('about-us', function () {
    return view('frontend.about-us');
})->name('about');


Route::get('domestic-travels', function () {
    return view('frontend.domestic-travels');
})->name('domestic');

Route::get('international-package', function () {
    return view('frontend.international-package');
})->name('international');

Route::get('our-gallery', function () {
    return view('frontend.our-gallery');
})->name('gallery');

Route::get('blog', function () {
    return view('frontend.blog');
})->name('blog');

Route::get('contact-us', function () {
    return view('frontend.contact-us');
})->name('contact');

Route::get('login', function () {
    return view('frontend.login');
})->name('login');

Route::get('package-details', function () {
    return view('frontend.tour-Package-details');
})->name('Package-details');

Route::get('privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');

Route::get('cookie-policy', function () {
    return view('frontend.cookie-policy');
})->name('cookie-policy');

// Backend


Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('backend.index');
    })->name('dashboard');
});


Route::post('auth-check',[HomeController::class,'authCheck'])->name('auth.check');
Route::post('auth-login',[HomeController::class,'loginAuth'])->name('auth.login');


Auth::routes();
// Route::middleware('auth')->group( function(){
    Route::post('search-flight', [SearchFilterController::class, 'filter'])->name('flight.filter');
    Route::get('booking', [SearchFilterController::class, 'flightBooking'])->name('flight.filter.booking');
    Route::post('flight-pricing', [SearchFilterController::class, 'pricing'])->name('flight.pricing');
// });

// Route::get('/home', [HomeController::class, 'index'])->name('home');
