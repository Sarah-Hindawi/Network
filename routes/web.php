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
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('welcome');
});

Auth::routes();
Route::get('/newpost/create', [App\Http\Controllers\AddController::class, 'create']);
Route::post('/newpost', [App\Http\Controllers\AddController::class, 'store']);

Route::get('/home', [App\Http\Controllers\ProfileController::class, 'create']);
Route::post('/comment', [App\Http\Controllers\ProfileController::class, 'addComment']);

Route::get('/profileimg', [App\Http\Controllers\UpdateProfileController::class, 'createProfileImg']);
Route::post('/profileimg', [App\Http\Controllers\UpdateProfileController::class, 'storeProfileImg']);
Route::get('/settings', [App\Http\Controllers\UpdateProfileController::class, 'create']);
Route::post('/updateSettings', [App\Http\Controllers\UpdateProfileController::class, 'updateSettings']);
Route::get('/deleteAccount', [App\Http\Controllers\UpdateProfileController::class, 'deleteAccount']);


Route::get('/friends', [App\Http\Controllers\FriendsController::class, 'create']);
Route::post('/addFriend', [App\Http\Controllers\FriendsController::class, 'addFriend']);
Route::post('/removeFriend', [App\Http\Controllers\FriendsController::class, 'removeFriend']);
Route::get('/requests', [App\Http\Controllers\FriendsController::class, 'displayFriendRequests']);
Route::post('/addFriend', [App\Http\Controllers\FriendsController::class, 'addFriend']);
Route::post('/acceptFriend', [App\Http\Controllers\FriendsController::class, 'acceptFriend']);
Route::post('/removeRequest', [App\Http\Controllers\FriendsController::class, 'removeRequest']);
Route::post('/cancelRequest', [App\Http\Controllers\FriendsController::class, 'cancelRequest']);


Route::get('/profile', [App\Http\Controllers\OthersProfileController::class, 'create']);
Route::post('/addcomment', [App\Http\Controllers\OthersProfileController::class, 'addComment']);
Route::post('/search', [App\Http\Controllers\OthersProfileController::class, 'search']);

