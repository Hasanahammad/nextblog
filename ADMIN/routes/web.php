<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Upload_Article_Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;


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

Route::get('/',[HomeController::class, 'HomeIndex'])->middleware('LoginCheckMiddleware');
Route::get('/upload_article',[Upload_Article_Controller::class, 'ArticleIndex'])->name('upload_article')->middleware('LoginCheckMiddleware');


//Service Panel Routes
// Route::get('/service','ServiceController@ServiceIndex');
Route::get('/getArticleData',[Upload_Article_Controller::class, 'getArticleData'])->name('articleDetails')->middleware('LoginCheckMiddleware');
Route::post('/articleDelete',[Upload_Article_Controller::class, 'articleDelete'])->middleware('LoginCheckMiddleware');
Route::post('/articleDetails',[Upload_Article_Controller::class, 'getArticleDetails'])->middleware('LoginCheckMiddleware');
Route::post('/articleUpdate',[Upload_Article_Controller::class, 'articleUpdate'])->middleware('LoginCheckMiddleware');
Route::post('/articleAdd',[Upload_Article_Controller::class, 'articleAdd'])->name('article_add')->middleware('LoginCheckMiddleware');

Route::get('/articleform',[Upload_Article_Controller::class, 'ArticleForm'])->middleware('LoginCheckMiddleware');



//Category Routes
Route::get('/add_category', function () {
    return view('Add_Category');
})->middleware('LoginCheckMiddleware');

Route::post('/categoryAdd',[CategoryController::class, 'categoryAdd'])->middleware('LoginCheckMiddleware');
Route::get('/getCategoryData',[CategoryController::class, 'getCategoryData'])->middleware('LoginCheckMiddleware');


Route::get('/add_sub_category', [CategoryController::class, 'subCategory'])->middleware('LoginCheckMiddleware');


//login route
Route::get('/login', [LoginController::class, 'LoginIndex']);
Route::post('/onLogin',[LoginController::class, 'onLogin']);
Route::get('/logout', [LoginController::class, 'onLogout']);

Route::get('/storagelink', function(){
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder,$linkFolder);
});
