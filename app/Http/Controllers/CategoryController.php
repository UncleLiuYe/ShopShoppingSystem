<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view("admin.category.categorylist", ["categorylist" => Category::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view("admin.category.addcategory");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->input("category_name");
        try {
            if ($category->save()) {
                return $this->writeJSAlert("添加成功！", route("category.index"));
            } else {
                return $this->writeJSAlert("增加失败！", route("category.index"));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->writeJSAlert("增加失败！", route("category.index"));
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->view("admin.category.updatecategory", ["category" => Category::find($id)]);
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
            if (Category::find($id)->update(["category_name" => $request->input("category_name")])) {
                return $this->writeJSAlert("更新成功！", route("category.index"));
            } else {
                return $this->writeJSAlert("更新失败！", route("category.index"));
            }
        } catch (\Exception $e) {
            return $this->writeJSAlert("更新失败！", route("category.index"));
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
            if (Category::destroy($id) > 0) {
                return $this->writeJSAlert("删除成功！", route("category.index"));
            } else {
                return $this->writeJSAlert("删除失败！", route("category.index"));
            }
        } catch (\Exception $e) {
            return $this->writeJSAlert("删除失败！", route("category.index"));
        }
    }

    private function writeJSAlert($msg, $address)
    {
        return response("<script>alert('" . $msg . "');window.location.href='" . $address . "'</script>");
    }
}
