<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\MessageController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route for Topic controllers
Route::apiResource('topics', 'App\Http\Controllers\TopicController');

Route::post('subscribe/{topic}', [SubscriberController::class, 'create'])->name('subscribe');

Route::post('publish/{topic}', [TopicController::class, 'publish'])->name('publish');
