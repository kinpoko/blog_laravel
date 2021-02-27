<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminBlogController;


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
Route::get('admin/form', [AdminBlogController::class, 'form'])->name('admin_form');
Route::post('admin/post', [AdminBlogController::class, 'post'])->name('admin_post');
Route::get('admin/form/{article_id?}', [AdminBlogController::class,'form'])->name('admin_form');
Route::post('admin/post', [AdminBlogController::class,'post'])->name('admin_post');
