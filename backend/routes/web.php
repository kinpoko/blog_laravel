<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\FrontBlogController;
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

Route::get('/', [FrontBlogController::class ,'index'])->name('front_index');
Route::get('show/{article_id}',[FrontBlogController::class ,'showpost'])->name('single_show');


// ログイン状態の'admin'ユーザーのみアクセス可能
Route::group(['middleware' => ['auth', 'can:admin']], function () {
Route::prefix('admin')->group(function(){
    Route::post('post', [AdminBlogController::class, 'post'])->name('admin_post');
    Route::get('form/{article_id?}', [AdminBlogController::class,'form'])->name('admin_form');
    Route::post('post', [AdminBlogController::class,'post'])->name('admin_post');
    Route::post('delete', [AdminBlogController::class,'delete'])->name('admin_delete');
    Route::get('list', [AdminBlogController::class,'list'])->name('admin_list');

    Route::get('category', [AdminBlogController::class, 'category'])->name('admin_category');
    Route::post('category/edit', [AdminBlogController::class,'editCategory'])->name('admin_category_edit');
    Route::post('category/delete', [AdminBlogController::class, 'deleteCategory'])->name('admin_category_delete');
});});
Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
