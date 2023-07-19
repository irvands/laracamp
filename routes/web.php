<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CheckoutController as AdminCheckout;

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

//midtrans routes
Route::get('/payment/success', [CheckoutController::class, 'midtransCallback']);
Route::post('/payment/success', [CheckoutController::class, 'midtransCallback']);
Route::get('/invoice/{checkout}', [CheckoutController::class, 'invoice'])->name('invoice');


Route::middleware(['auth'])->group(function (){
    
    //checkout routes
    Route::get('/checkout/success', [CheckoutController::class, 'successCheckout'])->name('checkout.success')->middleware('ensureUserRole:user');
    Route::get('/checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create')->middleware('ensureUserRole:user');
    Route::post('/checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('ensureUserRole:user');

    //user dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('user.dashboard');
    // Route::get('/dashboard/checkout/invoice/{checkout}', [CheckoutController::class, 'invoice'])->name('user.checkout.invoice');

    Route::prefix('/user')->namespace('user')->name('user.')->middleware('ensureUserRole:user')->group(function (){
        Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    });

    Route::prefix('/admin')->namespace('admin')->name('admin.')->middleware('ensureUserRole:admin')->group(function (){
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::POST('/checkout/{checkout}', [AdminCheckout::class, 'setToPaid'])->name('checkout.setToPaid');
    });
});


Route::get('/debug', [CheckoutController::class, 'debug']);


// Route::get('/dashboard', function () { 
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


//socialite routes
Route::get('/sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('/auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');
require __DIR__.'/auth.php';
