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
    <h1 style="margin-top: 77px;" class="text-center">商品列表</h1>
    <table class="table table-bordered table-hover text-center">
        <thead>
        <tr>
            <th scope="col">商品名称</th>
            <th scope="col">商品价格</th>
            <th scope="col">商品图片</th>
            <th scope="col">商品分类</th>
            <th scope="col">商品简介</th>
            <th scope="col">商品数量</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productlist->items() as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->price}}</td>
                <td><img src="/storage/images/{{$product->cover}}" alt="..." width="50px" height="50px"></td>
                <td>{{$product->category->category_name}}</td>
                <td>{{$product->short_depiction}}</td>
                <td>{{$product->stock}}</td>
                <td>
                    <button class="btn btn-outline-primary"
                            onclick="window.location.href='{{route("product.edit",$product->id)}}'">
                        修改
                    </button>
                    <button class="btn btn-outline-danger"
                            onclick="let x;x=confirm('确认删除吗？');if(x){window.location.href='{{route("product.delete",$product->id)}}'}">
                        删除
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$productlist->links()}}
</div>
</body>
</html>
