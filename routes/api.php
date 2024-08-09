<?php

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('events', EventController::class);
Route::apiResource('events.attendees', AttendeeController::class)->scoped()->except('update');
