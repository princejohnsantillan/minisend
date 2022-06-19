<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\RequestUserTokenController;
use Illuminate\Support\Facades\Route;

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

/**
 * Get a token for a user using this route.
 * This is just for demo purposes.
 */
Route::post('/user-token', RequestUserTokenController::class);

Route::middleware('auth:sanctum')->apiResource('/email', EmailController::class)->only(['store', 'destroy']);
