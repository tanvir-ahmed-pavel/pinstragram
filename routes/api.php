<?php

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

Route::middleware('auth:sanctum')->group(function () {

//    User Data

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get("/profile/post/{id}", [\App\Http\Controllers\ProfileController::class, 'profilePost']);
    Route::put("/profile/{id}", [\App\Http\Controllers\ProfileController::class, 'update']);

});

Route::resource("post", '\App\Http\Controllers\PostController');
Route::get("profile/{id}", [\App\Http\Controllers\ProfileController::class, 'index']);




