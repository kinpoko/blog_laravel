<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\FrontBlogController;
use App\Http\Controllers\UploadImageController;
use App\Http\Controllers\ImageListController;
use App\Http\Controllers\RssController;


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
Route::get('rss.xml', [RssController::class ,'index'])->name('rss');


// ログイン状態の'admin'ユーザーのみアクセス可能
// IP制限
Route::group(['prefix' => 'admin', 'middleware' => 'ip.auth'], function() {
Route::group(['middleware' => ['auth', 'can:admin']], function () {

    Route::post('post', [AdminBlogController::class, 'post'])->name('admin_post');
    Route::get('form/{article_id?}', [AdminBlogController::class,'form'])->name('admin_form');
    Route::post('post', [AdminBlogController::class,'post'])->name('admin_post');
    Route::post('delete', [AdminBlogController::class,'delete'])->name('admin_delete');
    Route::get('list', [AdminBlogController::class,'list'])->name('admin_list');

    
    Route::get('category', [AdminBlogController::class, 'category'])->name('admin_category');
    Route::post('category/edit', [AdminBlogController::class,'editCategory'])->name('admin_category_edit');
    Route::post('category/delete', [AdminBlogController::class, 'deleteCategory'])->name('admin_category_delete');
    
    
    Route::post('/upload', [UploadImageController::class, "upload"])->name("upload_image");
    Route::get('/imagelist', [ImageListController::class, "show"])->name("image_list");
    Route::post('imagedelete',[UploadImageController::class, "delete"])->name("delete_image");

});});

