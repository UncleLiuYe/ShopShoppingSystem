<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function insertProduct($name, $cover, $price, $short_depiction, $depiction, $stock, $category_id)
    {
        $product = new Product();
        $product->name = $name;
        $product->price = $price;
        $product->cover = $cover;
        $product->short_depiction = $short_depiction;
        $product->depiction = $depiction;
        $product->stock = $stock;
        $product->category_id = $category_id;
        return $product->save();
    }
}
