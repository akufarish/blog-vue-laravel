<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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
    return $request->user();
});

Route::post("/auth/register", [AuthController::class, "doRegister"]);
Route::post("/auth/login", [AuthController::class, "doLogin"]);
Route::post("/post/create", [PostController::class, "create"]);
Route::get("/post", [PostController::class, "index"]);
Route::get("/post/{post:id}", [PostController::class, "getSingle"]);