<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function indexpage()
    {
        return view("index", ["productlist" => Product::all(), "categorylist" => Category::all()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view("admin.product.productlist", ["productlist" => Product::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view("admin.product.addproduct", ["categorylist" => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $productService = new ProductService();
            $coverpath = "";
            if ($request->hasFile("cover") && $request->file("cover")->isValid()) {
                $coverfilename = Uuid::uuid4() . "." . $request->file("cover")->getClientOriginalExtension();
                $request->file("cover")->storeAs("/public/images", $coverfilename);
                $coverpath = $coverfilename;
            }
            if ($productService->insertProduct(
                $request->input("name"),
                $coverpath,
                $request->input("price"),
                $request->input("short_depiction"),
                $request->input("depiction"),
                $request->input("stock"),
                $request->input("category_id")
            )) {
                return $this->writeJSAlert("添加成功！", route("product.index"));
            } else {
                return $this->writeJSAlert("添加失败！", route("product.index"));
            }
        } catch (\Exception $e) {
            return $this->writeJSAlert("添加失败！", route("product.index"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->view("info", ["product" => Product::find($id), "categorylist" => Category::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->view("admin.product.updateproduct", ["product" => Product::find($id), "categorylist" => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            $product->name = $request->input("name");
            $product->price = $request->input("price");
            $product->short_depiction = $request->input("short_depiction");
            $product->stock = $request->input("stock");
            $product->category_id = $request->input("category_id");
            if ($request->hasFile("cover") && $request->file("cover")->isValid()) {
                $coverfilename = Uuid::uuid4() . "." . $request->file("cover")->getClientOriginalExtension();
                $request->file("cover")->storeAs("/public/images", $coverfilename);
                $product->cover = $coverfilename;
            }
            $product->depiction = $request->input("depiction");
            if ($product->save()) {
                return $this->writeJSAlert("更新成功！", route("product.index"));
            } else {
                return $this->writeJSAlert("更新失败！", route("product.index"));
            }
        } catch (\Exception $e) {
            return $this->writeJSAlert("更新失败！", route("product.index"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (Product::destroy($id) > 0) {
                return $this->writeJSAlert("删除成功！", route("product.index"));
            } else {
                return $this->writeJSAlert("删除失败！", route("product.index"));
            }
        } catch (\Exception $e) {
            return $this->writeJSAlert("删除失败！", route("product.index"));
        }
    }

    public function uploadFile()
    {
        $postFile = 'upload';
        $allowedPrefix = ['jpg', 'png'];
        //检查文件是否上传成功
        if (!request()->hasFile($postFile) || !request()->file($postFile)->isValid()) {
            return $this->CKEditorUploadResponse(0, '文件上传失败');
        }
        $extension = request()->file($postFile)->extension();
        $filename = Uuid::uuid4() . "." . request()->file($postFile)->getClientOriginalName();
        if (!in_array($extension, $allowedPrefix)) {
            return $this->CKEditorUploadResponse(0, '文件类型不合法');
        }
        //保存文件
        request()->file($postFile)->storeAs('/public/images', $filename);
        return $this->CKEditorUploadResponse(1, '', $filename, "/storage/images/" . $filename);
    }

    /**
     * CKEditor 上传文件的标准返回格式
     * @param [type] $uploaded [description]
     * @param string $error [description]
     * @param string $filename [description]
     * @param string $url [description]
     */
    private function CKEditorUploadResponse($uploaded, $error = '', $filename = '', $url = '')
    {
        return [
            "uploaded" => $uploaded,
            "fileName" => $filename,
            "url" => $url,
            "error" => [
                "message" => $error
            ]
        ];
    }

    private function writeJSAlert($msg, $address)
    {
        return response("<script>alert('" . $msg . "');window.location.href='" . $address . "'</script>");
    }
}
