<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Games\GamesController;
use App\Http\Controllers\Manga\MangaController;

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

//     // return view('welcome');
// });

Route::controller(MangaController::class)->group(function() {
    Route::get('/', 'getMangaData')->name('home');
    Route::get('/filter/anime', 'filter')->name('filter.anime');

});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
    Route::post('/animes', 'animes')->name('animes');
});

Route::controller(gameController::class)->group(function() {
    Route::get('/games', 'games')->name('games');
});
