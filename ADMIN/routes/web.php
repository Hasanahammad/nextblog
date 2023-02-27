<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Upload_Article_Controller;
use App\Http\Controllers\CategoryController;

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

Route::get('/',[HomeController::class, 'HomeIndex']);
Route::get('/upload_article',[Upload_Article_Controller::class, 'ArticleIndex'])->name('upload_article');


//Service Panel Routes
// Route::get('/service','ServiceController@ServiceIndex');
Route::get('/getArticleData',[Upload_Article_Controller::class, 'getArticleData'])->name('articleDetails');
Route::post('/articleDelete',[Upload_Article_Controller::class, 'articleDelete']);
Route::post('/articleDetails',[Upload_Article_Controller::class, 'getArticleDetails']);
Route::post('/articleUpdate',[Upload_Article_Controller::class, 'articleUpdate']);
Route::post('/articleAdd',[Upload_Article_Controller::class, 'articleAdd'])->name('article_add');

Route::get('/articleform',[Upload_Article_Controller::class, 'ArticleForm']);



//Category Routes
Route::get('/add_category', function () {
    return view('Add_Category');
});
Route::post('/categoryAdd',[CategoryController::class, 'categoryAdd']);
Route::get('/getCategoryData',[CategoryController::class, 'getCategoryData']);


Route::get('/add_sub_category', [CategoryController::class, 'subCategory']);
