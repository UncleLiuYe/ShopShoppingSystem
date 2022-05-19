<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userLogin()
    {
        $rules = [
            "username" => ["required", "string", "bail"],
            "password" => ["required", "string"],
            "captcha" => ["required", "captcha"],
        ];
        $messages = [
            "username.required" => "用户名不能为空",
            "password.required" => "密码不能为空",
            "captcha.required" => "验证码不能为空",
            "captcha.captcha" => "验证码错误",
        ];
        $validator = Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("login")->withErrors($validator);
        } else {
            if (request()->session()->has("admin") || request()->session()->has("user")) {
                return "<script>alert('已经登录了！请勿重复登陆！');window.location.href='./login';</script>";
            } else {
                $userService = new UserService();
                $user = $userService->userLogin(request()->input("username"), request()->input("password"));
                if (!is_null($user)) {
                    if ($user->isadmin == 1) {
                        request()->session()->push("admin", $user);
                        return redirect(route("admin.index"));
                    }
                    request()->session()->push("user", $user);
                    return redirect("/");
                } else {
                    return "<script>alert('用户名或密码错误！');window.location.href='./login';</script>";
                }
            }
        }
    }

    public function userLogout()
    {
        if (request()->session()->has("user")) {
            request()->session()->pull("user", session("users"));
        }
        return redirect("/");
    }
}
