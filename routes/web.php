<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\MessageController;

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
});

// Login: 
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/authenticate', [HomeController::class, 'authenticate'])->name('authenticate');

// Logout:
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

// Other Routes: 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard.index');
    Route::resource('/app-settings', AppSettingController::class);
    Route::get('/message', [MessageController::class, 'index'])->name('message');
    Route::post('/message', [MessageController::class, 'store'])->name('message.store');
   
});
Route::get('/read',[MessageController::class, 'read']);

Route::fallback(function () {
    return redirect()->guest(route('login'))->with('error', 'Please log in.');
});