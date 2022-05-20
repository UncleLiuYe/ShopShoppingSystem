@section("nav")
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm p-3 mb-5 bg-white rounded">
        <a class="navbar-brand" href="{{route("index")}}"> 孤梦商城</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="collapsibleNavbar">
            <div class="navbar-nav mr-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-expanded="false">
                        商品分类
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach($categorylist as $category)
                            <a class="dropdown-item" href="#">{{$category->category_name}}</a>
                        @endforeach
                    </div>
                </div>
                <a class="nav-item nav-link" href="{{route("cart.index")}}">购物车</a>
                <a class="nav-item nav-link" href="{{route("order.index")}}">订单</a>
                @if(request()->session()->has("user"))
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-toggle="dropdown" aria-expanded="false">
                            我的
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="./updateUserInfo.php">修改个人信息</a>
                            <a class="dropdown-item" href="./updateUserPassword.php">修改登陆密码</a>
                            <a class="dropdown-item" href="#"
                               onclick="let x;x=confirm('确定退出吗？');if(x){ window.location.href='{{route("userLogout")}}';
                                   }">退出登录</a>
                        </div>
                    </div>
                @endif
            </div>
            <form class="form-inline my-2 my-lg-0 mr-3"
                  action="/Shop/GoodsSearchServlet">
                <input class="form-control mr-sm-2" type="search" placeholder="搜索"
                       name="keyword">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
            </form>
            <div class="my-2 my-lg-0 mr-5">
                @if(request()->session()->has("user"))
                    <span class="mr-3" style="color: red;">用户名:{{request()->session()->get("user")[0]->username}}</span>
                @else
                    <a style="text-decoration: none;" href="{{route("login")}}">未登录</a>
                @endif
            </div>
        </div>
    </nav>
@show
