<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TagController;

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
    
    // Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts');    
    Route::get('/post/create', [PostController::class, 'create']);  
    Route::post('/post/', [PostController::class, 'store']);    
    Route::get('/post/{slug}', [PostController::class, 'show']);      
    Route::get('/post/{slug}/edit', [PostController::class, 'edit']);      
    Route::post('/post/{slug}/edit', [PostController::class, 'update']);      
    Route::delete('/post/{id}', [PostController::class, 'destroy']);  
    
    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories'); 
    Route::get('/category/create', [CategoryController::class, 'create']);    
    Route::post('/category/', [CategoryController::class, 'store']); 
    Route::get('/category/{slug}', [CategoryController::class, 'show']);
    Route::get('/category/{slug}/edit', [CategoryController::class, 'edit']);      
    Route::post('/category/{slug}/edit', [CategoryController::class, 'update']);      
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
    
    // Tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags'); 
    Route::get('/tag/create', [TagController::class, 'create']);    
    Route::post('/tag/', [TagController::class, 'store']); 
    Route::get('/tag/{slug}', [TagController::class, 'show']);
    Route::get('/tag/{slug}/edit', [TagController::class, 'edit']);      
    Route::post('/tag/{slug}/edit', [TagController::class, 'update']);      
    Route::delete('/tag/{id}', [TagController::class, 'destroy']);  
});