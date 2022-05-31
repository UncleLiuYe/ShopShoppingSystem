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
    <h1 style="margin-top: 77px;" class="text-center">添加分类</h1>
    <form class="text-center" action="{{route("category.store")}}" method="post">
        @csrf
        <div class="form-group">
            <label for="categoryname">分类名称</label>
            <input type="text" class="form-control" id="categoryname" name="category_name" required>
        </div>
        <input type="submit" style="width: 60px;" class="btn btn-outline-primary"/>
    </form>
</div>
</body>
</html>
