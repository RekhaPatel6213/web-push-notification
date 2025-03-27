<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('notification');
});
Route::post('/save-token', [NotificationController::class, 'saveToken']);
Route::post('/remove-token', [NotificationController::class, 'removeToken']);
Route::post('/send-notification', [NotificationController::class, 'sendNotification'])->name('send.notification');
