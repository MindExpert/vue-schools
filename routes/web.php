<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/update-user-attributes', [\App\Http\Controllers\UsersController::class, 'updateUserAttributes']);
