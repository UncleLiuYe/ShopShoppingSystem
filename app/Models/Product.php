<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    public function category()
    {
        return $this->hasOne("App\Models\Category", "id", "category_id");
    }
}
