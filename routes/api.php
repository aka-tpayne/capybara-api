<?php

use App\Http\Controllers\Api\CapybaraController;
use App\Http\Controllers\Api\CapybaraObservationController;
use Illuminate\Http\Request;
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

Route::post('/capybara', [CapybaraController::class, 'store'])->name('api.capybara.store');
Route::post('/observation', [CapybaraObservationController::class, 'store'])->name('api.observation.store');
