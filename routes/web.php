<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\CheckoutController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/checkout/success', [CheckoutController::class, 'successCheckout'])->name('checkout.success');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//socialite routes
Route::get('sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('/auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');
require __DIR__.'/auth.php';
