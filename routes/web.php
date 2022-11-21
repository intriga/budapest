<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PostController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Dashboard
Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
    Route::get('/posts', [PostController::class, 'index'])->name('posts');    
    Route::get('/posts/{id}', [PostController::class, 'show']);      
});