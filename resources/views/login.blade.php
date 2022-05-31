<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <title>登录</title>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="username"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: -1px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .form-signin input[type="captcha"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body>
<form class="form-signin text-center" method="post" action="{{route("userLogin")}}">
    @csrf
    <img class="mb-4" src="https://icons.getbootstrap.com/assets/icons/cart.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">请登录</h1>
    <label for="username" class="sr-only">用户名</label>
    <input type="text" name="username" id="username" class="form-control {{$errors->has("username")? 'is-invalid': '' }}" placeholder="用户名" autofocus>
    @if ($errors->has('username'))
        <p class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('username') }}</strong>
        </p>
    @endif
    <label for="password" class="sr-only">密码</label>
    <input type="password" name="password" id="password"
           class="form-control {{$errors->has("password")? 'is-invalid' : '' }}" placeholder="密码">
    @if ($errors->has('password'))
        <p class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </p>
    @endif
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
    <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
    <p class="mt-5 mb-3 text-muted">&copy; 刘晔</p>
</form>
</body>

</html>
