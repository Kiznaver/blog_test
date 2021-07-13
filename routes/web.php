<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\HomeController;



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



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [HomeController::class, 'postcategory'])->name('postcategory');
Route::get('/category/{category_id}/{post_id}', [HomeController::class, 'getpost'])->name('getpost');

Auth::routes();
Route::middleware(['role:admin'])->prefix('admin_panel')->group(function(){
    Route::get('/',[App\Http\Controllers\Admin\HomeController::class, 'index'])->name('homeAdmin');
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
});
