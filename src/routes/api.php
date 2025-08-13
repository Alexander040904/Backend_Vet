<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Emergency_Request\EmergencyRequestController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Vet\VetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

    /* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum') */;

//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {

    #usuario
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'show']);
        Route::patch('/', [UserController::class, 'update']);
        Route::delete('/', [UserController::class, 'destroy']);
        ROute::get('/{id}', [UserController::class, 'showById']);
    });

    #veterinario
    Route::prefix('vet')->group(function () {
        Route::get('/', [VetController::class, 'show']);
        Route::patch('/', [VetController::class, 'update']);
        Route::post('/', [VetController::class, 'store']);
        Route::get('/me', [VetController::class, 'showVet']);
    });

    #emergencia
    Route::prefix('emergency-requests')->group(function () {
        Route::post('/', [EmergencyRequestController::class, 'store']);
        Route::put('/{id}', [EmergencyRequestController::class, 'update']);
        Route::get('/my', [EmergencyRequestController::class, 'myRequest']);
    });


    Route::prefix('notifications')->controller(NotificationController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/unread', 'unread');
        Route::post('/{id}/read', 'markAsRead');
        Route::post('/read-all', 'markAllAsRead');
        Route::delete('/all', 'allDestroy');
        Route::delete('/{id}', 'destroy');
    });
});
