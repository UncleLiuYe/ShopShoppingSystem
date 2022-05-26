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
use App\Http\Controllers\CartController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ProductController::class, "indexpage"])->name("index");
Route::get("/admin/index", [AdminController::class, "adminIndex"])->name("admin.index")->middleware("admincheck");

Route::get("/product/show/{id}", [ProductController::class, "show"]);
Route::resource("product", "ProductController")->middleware("admincheck");
Route::get("/product/{id}/delete", [ProductController::class, "destroy"])->name("product.delete")->middleware("admincheck");

Route::resource("cart", "CartController")->middleware("checklogin");
Route::post("/cart/delete/{id}", [CartController::class, "destroy"])->middleware("checklogin");

Route::resource("category", "CategoryController")->middleware("admincheck");
Route::get("/category/{id}/delete", [CategoryController::class, "destroy"])->name("category.delete")->middleware("admincheck");

Route::resource("order", "OrderController")->middleware("checklogin");
Route::get("/pay/{oid}", [PayController::class, "pay"])->middleware("checklogin")->name("pay.pay");

Route::view("/login", "login")->name("login");
Route::post("/userLogin", [UserController::class, "userLogin"])->name("userLogin");
Route::get("/userLogout", [UserController::class, "userLogout"])->name("userLogout")->middleware("checklogin");
Route::post('/create/uploadFile', [ProductController::class, "uploadFile"])->name("uploadfile")->middleware("admincheck");
Route::get("/register", function () {
    return view("register", ["categorylist" => Category::all()]);
})->name("register");
Route::post("/userRegister", [UserController::class, "userRegister"])->name("userRegister");
Route::get("/returnurl", [PayController::class, "gotoPage"]);

Route::post("/notifyurl", function () {
    date_default_timezone_set("Asia/Shanghai");
    $ono = request()->input("out_trade_no");
    $status = request()->input("trade_status");
    $trade_no = request()->input("trade_no");
    if ($status === "TRADE_SUCCESS") {
        Order::where("ono", "=", $ono)->update([
            "status" => 1,
            "alipay_trade_no" => $trade_no,
            "update_time" => now(),
        ]);
    }
});
