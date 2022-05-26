<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            request()->session()->forget("user");
            request()->session()->forget("admin");
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

    public function userLogout()
    {
        if (request()->session()->has("user")) {
            request()->session()->forget("user");
        }
        if (request()->session()->has("admin")) {
            request()->session()->forget("admin");
        }
        return redirect(route("index"));
    }

    public function userRegister(Request $request)
    {
        $rules = [
            "username" => ["required", "string", "bail", "min:5", "max:8"],
            "password" => ["required", "string", "min:5", "max:8"],
            "captcha" => ["required", "captcha"],
        ];
        $messages = [
            "username.required" => "用户名不能为空",
            "username.min" => "用户名长度必须大于5位",
            "username.max" => "用户名长度必须小于8位",
            "password.required" => "密码不能为空",
            "captcha.required" => "验证码不能为空",
            "password.min" => "密码长度必须大于5位",
            "password.max" => "密码长度必须小于8位",
            "captcha.captcha" => "验证码错误",
        ];
        $validator = Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("register")->withErrors($validator);
        } else {
            $user = new User();
            $user->username = $request->input("username");
            $user->password = $request->input("password");
            $user->name = $request->input("name");
            $user->phone = $request->input("phone");
            $user->address = $request->input("address");
            try {
                if ($user->save()) {
                    return $this->writeJSAlert("注册成功！", route("index"));
                } else {
                    return $this->writeJSAlert("注册失败！", route("register"));
                }
            } catch (\Exception $e) {
                return $this->writeJSAlert("注册失败！", route("index"));
            }
        }
    }

    private function writeJSAlert($msg, $address)
    {
        return response("<script>alert('" . $msg . "');window.location.href='" . $address . "'</script>");
    }
}
