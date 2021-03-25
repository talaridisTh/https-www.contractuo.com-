<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('api')->group(function () {
    Route::get('/user', [UserController::class,"index"]);
    Route::post('/user/store',  [UserController::class,"store"]);
    Route::get('/user/edit/{id}',  [UserController::class,"edit"]);
    Route::put('/user/update',  [UserController::class,"update"]);
    Route::delete('/user/delete/{id}',  [UserController::class,"destroy"]);
});