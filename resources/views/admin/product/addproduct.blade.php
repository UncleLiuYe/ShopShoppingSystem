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
</head>

<body>
<div class="container text-center">
    @extends("admin.nav")
    @section("admin.nav")
        @parent
    @endsection
    <h1 style="margin-top: 77px;">添加商品</h1>
    <form id="form" method="post" action="{{route("product.store")}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">商品名称:</label>
            <input id="name" class="form-control" type="text" name="name" placeholder="商品名字" required/>
        </div>
        <div class="form-group">
            <label for="price">商品价格:</label>
            <input id="price" class="form-control" type="text" name="price" placeholder="商品价格" required/>
        </div>
        <div class="form-group">
            <label for="short_depiction">简短描述:</label>
            <input id="short_depiction" class="form-control" type="text" name="short_depiction" placeholder="简短描述"
                   required/>
        </div>
        <div class="form-group">
            <label for="stock">商品数量:</label>
            <input id="stock" class="form-control" type="number" name="stock" placeholder="商品数量" required/>
        </div>
        <div class="form-group">
            <label for="category_id">商品分类:</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categorylist as $category)
                    @if($loop->index==0)
                        <option value="{{$category->category_id}}" selected>{{$category->category_name}}</option>
                    @else
                        <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cover">封面图片</label>
            <input type="file" class="form-control-file" id="cover" name="cover" required>
        </div>
        <div class="form-group">
            <label for="depiction">商品详情</label>
            <textarea class="editor" id="depiction" name="depiction"></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-50">添加</button>
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
