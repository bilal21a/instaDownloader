<?php

use App\Http\Controllers\InstaController;
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
Route::get('/index', [InstaController::class, 'index']);
Route::post('/insta', [InstaController::class, 'insta_save'])->name('insta.save');
Route::post('/youtube', [InstaController::class, 'youtube_save'])->name('youtube.save');

