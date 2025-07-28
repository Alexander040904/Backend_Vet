<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Vet\VetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum') */;

//Auth
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth:sanctum');


#use

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [UserController::class, 'show']);
    Route::patch('profile', [UserController::class, 'update']);
    Route::delete('profile', [UserController::class, 'destroy']);

});


#Vet

Route::middleware('auth:sanctum')->group((function(){
    Route::get('vet', [VetController::class, 'show']);
    Route::patch('vet',[VetController::class, 'update']);
    Route::post('vet', [VetController::class, 'store']);
    Route::get('me/vet', [VetController::class, 'showVet']);

}));
