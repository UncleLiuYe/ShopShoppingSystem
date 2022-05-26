<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品列表</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <style>
        nav ul {
            justify-content: center;
        }
    </style>

    <script>
        function gotopage(url) {
            window.location.href = url.replace("/category", "");
        }
    </script>
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
<div class="container">
    <div class="row row-cols-1 row-cols-4">
        @if(count($productlist->items())>0)
            @foreach($productlist as $product)
                <div class="col-3" style="margin-bottom: 30px;">
                    <div class="card" onclick="gotopage('{{route("productshowwithid",$product->id)}}')">
                        <img src="/storage/images/{{$product->cover}}" class="card-img-top" alt="" width="200px"
                             height="200px">
                        <div class="card-body" style="padding: 0.5rem;">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <span class="card-text"
                                  style="font-size: 12px">{{$product->short_depiction}}</span>
                            <br/>
                            <span style="color: red; font-size: 24px;">￥{{$product->price}}</span>
                            <br/>
                            <div class="text-center">
                                <span class="badge badge-danger">自营</span>
                                <span class="badge badge-danger">厂商配送</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p style="margin: 0 auto;text-align: center;">啥也没有...</p>
        @endif
    </div>
    {{$productlist->links()}}
</div>
<hr/>
@extends("footer")
@section("footer")
    @parent
@endsection
</body>
</html>
