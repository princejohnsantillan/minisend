<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\EmailController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\LogoutController;
use Illuminate\Support\Facades\Route;

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

Route::resource('/login', LoginController::class)->only(['index', 'store']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', LogoutController::class);

    Route::get('/', DashboardController::class);

    Route::resource('/email', EmailController::class)->only(['index', 'show']);
});
