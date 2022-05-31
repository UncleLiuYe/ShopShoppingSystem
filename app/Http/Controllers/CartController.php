<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalprice = 0;
        $cartlist = Cart::where("user_id", request()->session()->get("user")[0]->id)->get();
        foreach ($cartlist as $cart) {
            $totalprice += $cart->product->price * $cart->num;
        }
        return response()->view("cartlist", ["cartlist" => $cartlist, "totalprice" => $totalprice,
            "categorylist" => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pid = $request->input("pid");
        $num = $request->input("num");
        $type = $request->input("type");
        if (Product::find($pid)->stock - $num < 0) {
            return response("numlesszero");
        }
        if (!$request->session()->has("user")) {
            return response("fail");
        }
        $cart = Cart::where("product_id", $pid)->where("user_id", $request->session()->get("user")[0]->id)->first();
        if (!empty($cart)) {
            if ($type == "incr") {
                $cart->num = $cart->num + $num;
            } else if ($type == "decr") {
                $cart->num = $cart->num - $num;
                if ($cart->num <= 0) {
                    Cart::destroy($cart->id);
                }
            } else {
                $cart->num = $cart->num + $num;
            }
            if ($cart->save()) {
                return response("ok");
            } else {
                return response("fail");
            }
        } else {
            $cart = new Cart();
            $cart->user_id = $request->session()->get("user")[0]->id;
            $cart->product_id = $pid;
            $cart->num = $num;
            if ($cart->save()) {
                return response("ok");
            } else {
                return response("fail");
            }
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Cart::destroy($id) > 0) {
            return response("ok");
        } else {
            return response("fail");
        }
    }
}
