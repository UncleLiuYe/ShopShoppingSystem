<?php

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

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [ProductController::class, "indexpage"])->name("index");

Route::resource("product", "ProductController");

Route::view("/login", "login")->name("login");
Route::post("/userLogin", [UserController::class, "userLogin"])->name("userLogin");
Route::get("/userLogout", [UserController::class, "userLogout"])->name("userLogout");
Route::post('/create/uploadFile', [ProductController::class, "uploadFile"])->name("uploadfile");
Route::get("/addProduct", [ProductController::class, "create"]);
