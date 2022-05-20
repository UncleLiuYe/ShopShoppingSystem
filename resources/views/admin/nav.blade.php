@section("nav")
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm p-3 mb-5 bg-white rounded">
        <a class="navbar-brand" href="{{route("admin.index")}}">后台管理系统</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="collapsibleNavbar">
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-expanded="false">
                        分类管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route("category.index")}}">分类列表</a>
                        <a class="dropdown-item" href="{{route("category.create")}}">添加分类</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-expanded="false">
                        商品管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route("product.index")}}">商品列表</a>
                        <a class="dropdown-item" href="{{route("product.create")}}">添加商品</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-expanded="false">
                        订单管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="./updateUserInfo.php">订单列表</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-expanded="false">
                        用户管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="./updateUserInfo.php">用户列表</a>
                        <a class="dropdown-item" href="./updateUserPassword.php">添加用户</a>
                    </div>
                </div>
                @if(request()->session()->has("admin"))
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-toggle="dropdown" aria-expanded="false">
                            我的
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="./updateUserInfo.php">修改个人信息</a>
                            <a class="dropdown-item" href="./updateUserPassword.php">修改登陆密码</a>
                            <a class="dropdown-item" href="#"
                               onclick="let x;x=confirm('确定退出吗？');if(x){ window.location.href='{{route("userLogout")}}'; }">退出登录</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="my-2 my-lg-0 mr-5">
                @if(request()->session()->has("admin"))
                    <span class="mr-3"
                          style="color: red;">管理员:{{request()->session()->get("admin")[0]->username}}</span>
                @endif
            </div>
        </div>
    </nav>
@show
