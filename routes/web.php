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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, "indexpage"])->name("index");
Route::get("/admin/index", [AdminController::class, "adminIndex"])->name("admin.index")->middleware("admincheck");

Route::get("/product/{id}", [ProductController::class, "show"])->name("product.show");
Route::resource("product", "ProductController")->middleware("admincheck");
Route::get("/product/{id}/delete", [ProductController::class, "destroy"])->name("product.delete")->middleware("admincheck");

Route::resource("category", "CategoryController")->middleware("admincheck");
Route::get("/category/{id}/delete", [CategoryController::class, "destroy"])->name("category.delete")->middleware("admincheck");

Route::view("/login", "login")->name("login");
Route::post("/userLogin", [UserController::class, "userLogin"])->name("userLogin");
Route::get("/userLogout", [UserController::class, "userLogout"])->name("userLogout")->middleware("checklogin");
Route::post('/create/uploadFile', [ProductController::class, "uploadFile"])->name("uploadfile")->middleware("admincheck");
