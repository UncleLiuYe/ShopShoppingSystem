<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_items";
    public $timestamps = false;

    public function product()
    {
        return $this->hasOne("App\Models\Product", "id", "product_id");
    }
}
