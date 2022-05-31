<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne("App\Models\User", "id", "user_id");
    }

    public function orderitem()
    {
        return $this->hasMany("App\Models\OrderItem", "order_id", "ono");
    }
}
