<?php

namespace App\Http\Controllers;

use App\Models\Category;

class AdminController extends Controller
{
    public function adminIndex()
    {
        return view("admin.index", ["categorylist" => Category::all()]);
    }
}
