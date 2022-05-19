<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <title>Laravel</title>
    <style>
        .carousel-inner img {
            border-radius: 5px;
            width: 100%;
            height: 444px;
        }

        nav ul {
            justify-content: center;
        }
    </style>
</head>
<body>
<div class="container">
    @extends("admin.nav")
    @section("admin.nav")
        @parent
    @endsection
    <h1 style="margin-top: 77px;" class="text-center">分类列表</h1>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">分类名称</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categorylist->items() as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->category_name}}</td>
                <td>
                    <button class="btn btn-outline-primary"
                            onclick="window.location.href='{{route("category.edit",$category->id)}}'">
                        修改
                    </button>
                    <button class="btn btn-outline-danger"
                            onclick="let x;x=confirm('确认删除吗？');if(x){window.location.href='{{route("category.delete",$category->id)}}'}">
                        删除
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$categorylist->links()}}
</div>
</body>
</html>
