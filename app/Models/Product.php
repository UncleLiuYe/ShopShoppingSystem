<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    public $timestamps = false;

    public function category_id()
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }
}
