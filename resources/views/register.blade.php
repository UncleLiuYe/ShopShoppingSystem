<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>用户注册</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/js/bootstrap.min.js"></script>
</head>
<body>
@extends("nav")
@section("nav")
    @parent
@endsection
<br/>
<br/>
<br/>
<br/>
<div class="container text-center">
    <form action="{{route("userRegister")}}"
          method="post">
        <h3>注册新用户</h3>
        <div class="form-group">
            <input type="text" name="username" class="form-control {{$errors->has("username")? 'is-invalid': '' }}"
                   placeholder="请输入用户名" required>
            @if ($errors->has('username'))
                <p class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </p>
            @endif
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control {{$errors->has("password")? 'is-invalid' : '' }}"
                   placeholder="请输入密码" required>
            @if ($errors->has('password'))
                <p class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </p>
            @endif
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="name"
                   placeholder="请输入收货人(非必填)">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone"
                   placeholder="请输入收货电话(非必填)">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="address"
                   placeholder="请输入收货地址(非必填)">
        </div>
        <div class="form-group">
            <label for="captcha" class="sr-only">验证码</label>
            <input type="text" id="captcha" class="form-control {{ $errors->has("captcha") ? 'is-invalid' : '' }}"
                   name="captcha" placeholder="验证码">
            <img class="thumbnail captcha mt-3 mb-2" src="{{ captcha_src('flat') }}"
                 onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码" alt="">
            @if ($errors->has('captcha'))
                <p class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first("captcha")}}</strong>
                </p>
            @endif
        </div>
        <div class="text-center">
            <input type="submit" class="btn btn-primary w-25" value="注册">
        </div>
        <br/>
    </form>
    <br/>
</div>
<hr/>
@extends("footer")
@section("footer")
    @parent
@endsection
</body>
</html>
