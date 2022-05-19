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
    <h1 style="margin-top: 77px;" class="text-center">更新商品</h1>
    <form class="text-center" action="{{route("product.update",$product->id)}}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group">
            <label for="name">商品名称:</label>
            <input id="name" class="form-control" type="text" name="name" placeholder="商品名字" value="{{$product->name}}"
                   required/>
        </div>
        <div class="form-group">
            <label for="price">商品价格:</label>
            <input id="price" class="form-control" type="text" name="price" placeholder="商品价格"
                   value="{{$product->price}}" required/>
        </div>
        <div class="form-group">
            <label for="short_depiction">简短描述:</label>
            <input id="short_depiction" class="form-control" type="text" name="short_depiction"
                   value="{{$product->short_depiction}}" placeholder="简短描述"
                   required/>
        </div>
        <div class="form-group">
            <label for="stock">商品数量:</label>
            <input id="stock" class="form-control" type="number" name="stock" placeholder="商品数量"
                   value="{{$product->stock}}" required/>
        </div>
        <div class="form-group">
            <label for="category_id">商品分类:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categorylist as $category)
                    @if($product->category->category_name===$category->category_name)
                        <option value="{{$category->id}}" selected>{{$category->category_name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cover">封面图片</label>
            <br/>
            <img src="/storage/images/{{$product->cover}}" alt="" width="111px" height="111px">
            <input type="file" class="form-control-file" id="cover" name="cover">
        </div>
        <div class="form-group">
            <label for="depiction">商品详情</label>
            <textarea class="editor" id="depiction" name="depiction">{!! $product->depiction !!}</textarea>
        </div>
        <button type="submit" class="btn btn-primary w-50">更新</button>
    </form>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('.editor'), {
        licenseKey: '',
        ckfinder: {
            //后端URL
            uploadUrl: '{{route("uploadfile")}}'
        },
    }).then(editor => {
        window.editor = editor;
    }).catch(error => {
        console.error('Oops, something went wrong!');
        console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
        console.warn('Build id: a85us1kma4lo-jujsj4qk5w31');
        console.error(error);
    });
</script>
</body>
</html>
