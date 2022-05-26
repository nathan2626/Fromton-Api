<?php

use App\Http\Controllers\CategoryCheeseController;
use App\Http\Controllers\CheeseController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Auth
Route::post('auth/register', [\App\Http\Controllers\ApiTokenController::class, 'register']);
Route::post('auth/login', [\App\Http\Controllers\ApiTokenController::class, 'login']);
Route::middleware('auth:sanctum')->post('auth/me', [\App\Http\Controllers\ApiTokenController::class, 'me']);
Route::middleware('auth:sanctum')->post('auth/logout', [\App\Http\Controllers\ApiTokenController::class, 'logout']);

Route::get('/cheeses', [CheeseController::class, 'index']);
Route::get('/cheeses/{id}', [CheeseController::class, 'show']);

Route::get('/categories', [CategoryCheeseController::class, 'index']);
Route::get('/categories/{id}', [CategoryCheeseController::class, 'show']);


Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/{id}', [RecipeController::class, 'show']);
