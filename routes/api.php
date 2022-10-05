<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ResourceController;


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

Route::post('/signin',[UserController::class, 'signin']);
Route::post('/signup',[UserController::class, 'signup']);

Route::get('/getdata',[UserController::class, 'getdata']);

Route::get('/search/{searchkeyword}',[UserController::class, 'search']);
// parameter
Route::get('/getdata/{id}',[UserController::class, 'getdatawithid']);


Route::put('update',[UserController::class, 'update']);

Route::post('/validate',[UserController::class, 'test']);

Route::delete('delete/{id}',[UserController::class, 'delete']);

Route::apiResource("member",ResourceController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
