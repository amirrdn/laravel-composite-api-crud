<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrgainizerController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'views'])->name('login-form');
Route::post('/auth-login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

Route::group(['prefix' => 'organizer'], function(){
    Route::get('/',[OrgainizerController::class, 'index'])->name('organizer');
    Route::get('/create',[OrgainizerController::class, 'create'])->name('create-organizer');
    Route::post('/store',[OrgainizerController::class, 'store'])->name('store-organizer');
    Route::get('/edit/{id}',[OrgainizerController::class, 'view'])->name('edit-organizer');
    Route::put('/update/{id}',[OrgainizerController::class, 'update'])->name('update-organizer');
    Route::delete('/delete/{id}',[OrgainizerController::class, 'destroy'])->name('delete-organizer');
});
Route::group(['prefix' => 'sport-event'], function(){
    Route::get('/',[EventController::class, 'index'])->name('event');
    Route::get('/create',[EventController::class, 'create'])->name('create-event');
    Route::post('/store',[EventController::class, 'store'])->name('store-event');
    Route::get('/view/{id}',[EventController::class, 'view'])->name('view-event');
    Route::put('/update/{id}',[EventController::class, 'update'])->name('update-event');
    Route::delete('/delete/{id}',[EventController::class, 'destroy'])->name('delete-event');
});
