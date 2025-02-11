<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;


Route::get('/', function () {
    return view('welcome');
});


Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('news', NewsController::class);