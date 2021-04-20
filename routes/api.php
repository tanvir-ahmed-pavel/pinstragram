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
        return $request->user()->load(['profile']);
    });

    Route::get("/profile/post/{id}", [\App\Http\Controllers\ProfileController::class, 'profilePost']);
    Route::put("/profile/{id}", [\App\Http\Controllers\ProfileController::class, 'update']);
    Route::put("/profile/u_p_img/{id}", [\App\Http\Controllers\ProfileController::class, 'profileImgUpdate']);
    Route::get("/isFollowing/{id}", [\App\Http\Controllers\FollowController::class, 'isFollowing']);
    Route::get("/authFollowings", [\App\Http\Controllers\FollowController::class, 'authFollowings']);
    Route::post("/follow/{id}", [\App\Http\Controllers\FollowController::class, 'store']);
    Route::post("/like/{id}", [\App\Http\Controllers\LikeController::class, 'store']);
    Route::get("/isLiked/{id}", [\App\Http\Controllers\LikeController::class, 'isLiked']);

});

Route::resource("post", '\App\Http\Controllers\PostController');
Route::get("profile/{id}", [\App\Http\Controllers\ProfileController::class, 'index']);




