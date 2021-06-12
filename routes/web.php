<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/newpost/create', [App\Http\Controllers\AddController::class, 'create']);
Route::post('/newpost', [App\Http\Controllers\AddController::class, 'store']);

Route::get('/home', [App\Http\Controllers\ProfileController::class, 'create']);
Route::post('/comment', [App\Http\Controllers\ProfileController::class, 'addComment']);

Route::get('/profileimg', [App\Http\Controllers\UpdateProfileController::class, 'createProfileImg']);
Route::post('/profileimg', [App\Http\Controllers\UpdateProfileController::class, 'storeProfileImg']);
