<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\RepresentativesController;
use App\Http\Controllers\RepresentativeAddressesController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('news', NewsController::class);
Route::resource('advertisements', AdvertisementController::class);
Route::resource('requirements', RequirementController::class);
Route::resource('categories', CategoryController::class);
Route::resource('roles', RoleController::class);
Route::resource('representatives', RepresentativesController::class);
Route::resource('representatives.addresses', RepresentativeAddressesController::class);