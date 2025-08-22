<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserAuthController;




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
Route::post('/send-email', [EmailController::class, 'send']);




Route::post('login', [UserAuthController::class, 'login']);
Route::post('signup', [UserAuthController::class, 'signUp']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('list',[StudentController::class, 'index']);
    Route::post('add/student', [StudentController::class, 'addStudent']);
    Route::put('update/student/{id}', [StudentController::class, 'updateStudent']);
    Route::delete('delete/student/{id}', [StudentController::class, 'deleteStudent']);
    Route::get('search/student/{name}',[StudentController::class, 'searchStudent']);

});

Route::get('login', [UserAuthController::class, 'login'])->name('login');





