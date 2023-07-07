<?php
namespace  App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return auth()->user();
});

//Route::group()

Route::post('/register', [AuthUserController::class, 'register'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthUserController::class, 'login'])
    ->middleware('guest')
    ->name('login');


Route::post('/logout', [AuthUserController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
//
Route::get('products',[ProductController::class,'index']);
Route::middleware(['auth:sanctum'])->resource('products',ProductController::class)
    ->except(['index']);

