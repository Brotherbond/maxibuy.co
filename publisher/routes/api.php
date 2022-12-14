<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

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
Route::apiResource('topics', TopicController::class);

Route::post('subscribe/{topic}', [SubscriberController::class, 'create'])->name('subscribe');

Route::post('publish/{topic}', [MessageController::class, 'publish'])->name('publish');


Route::post('/messageWebhook', function (Request $request) { //making external request NB won't work making request to itself
    $url = 'http://subscriber.test/api/messageWebhook';
    $response = Http::post($url)->json();
    return response()->json(['messagepub' => $request->all(), 'test' => $response], 200);
});
