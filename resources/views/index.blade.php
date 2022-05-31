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
    </style>
</head>

<body>
<div class="container">
    @extends("nav")
    @section("nav")
        @parent
    @endsection
    <br/>
    <div class="container" style="margin-top: 77px;">
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($productlist as $product)
                    @if($loop->index==0)
                        <li data-target="#carouselExampleCaptions" data-slide-to="{{$loop->index}}" class="active"></li>
                    @else
                        <li data-target="#carouselExampleCaptions" data-slide-to="{{$loop->index}}" class="active"></li>
                    @endif
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($productlist as $product)
                    @if($loop->index<4)
                        <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                            <img src="/storage/images/{{$product->cover }}" class="d-block w-100" alt="..."
                                 onclick="window.location.href='./product/show/{{$product->id}}'">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{$product->name}}</h5>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions"
                    data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">上一页</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions"
                    data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">下一页</span>
            </button>
        </div>
        <br/>
        <h2 class="text-center">全部商品</h2>
        <br/>
        <div class="row">
            @foreach($productlist as $product)
                @if($loop->index<4)
                    <div class="col-3" style="margin-bottom: 30px;">
                        <div class="card" onclick="window.location.href='./product/show/{{$product->id}}'">
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
                @endif
            @endforeach
        </div>
    </div>
    <div class="text-center" style="width: 100%;">
        <img class="img-fluid" src="/storage/images/footpic.jpg" alt="">
    </div>
</div>
@extends("footer")
@section("footer")
    @parent
@endsection
</body>
</html>
