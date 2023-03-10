<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NewsUploadController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('cors')->group(function () {

//Route::post('/register',[UserController::class, 'register']);
//Route::post('/NewsUpload',[NewsUploadController::class, 'onNewsUpload']);
Route::get('/NewsRetrieve/{parameter?}',[NewsUploadController::class, 'onNewsRetrieve']);
Route::get('/NewsRetrieveOnCategory/{category}',[NewsUploadController::class, 'NewsRetrieveUsingCategory']);

});
