<?php

namespace App\Http\Controllers;

use Alipay\EasySDK\Kernel\Factory;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = 5;
        $orderlist = Order::paginate($pageSize)->items();
        foreach ($orderlist as $order) {
            if ($order->status != 1) {
                PayController::checkOnoStatus($order->ono);
            }
        }
        return response()->view("orderlist", ["categorylist" => Category::all(), "orderlist" => Order::paginate($pageSize)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $totalprice = 0;
        $cartlist = Cart::where("user_id", request()->session()->get("user")[0]->id)->get();
        foreach ($cartlist as $cart) {
            $totalprice += $cart->product->price * $cart->num;
        }
        return response()->view("ordersubmit", ["categorylist" => Category::all(), "totalprice" => $totalprice]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Shanghai");
        $oname = $request->input("oname");
        $ophone = $request->input("ophone");
        $oaddress = $request->input("oaddress");
        $paytype = $request->input("paytype");
        $obeizhu = $request->input("obeizhu");
        $ono = random_int(10000000, 99999999);
        $userid = $request->session()->get("user")[0]->id;
        $status = 0;
        $create_time = now();
        $total_amount = 0;
        $cartlist = Cart::where("user_id", request()->session()->get("user")[0]->id)->get();
        foreach ($cartlist as $cart) {
            $total_amount += $cart->product->price * $cart->num;
        }
        $order = new Order();
        $order->oname = $oname;
        $order->ophone = $ophone;
        $order->oaddress = $oaddress;
        $order->obeizhu = $obeizhu;
        $order->paytype = $paytype;
        $order->ono = $ono;
        $order->user_id = $userid;
        $order->status = $status;
        $order->create_time = $create_time;
        $order->total_amount = $total_amount;
        if ($order->save()) {
            foreach ($cartlist as $cart) {
                $orderitem = new OrderItem();
                $orderitem->product_id = $cart->product->id;
                $orderitem->order_id = $ono;
                $orderitem->count = $cart->num;
                $orderitem->price = $cart->product->price;
                if ($orderitem->save()) {
                    Cart::destroy($cart->id);
                }
            }
            return $this->writeJSAlert("创建订单成功！", route("pay.pay", $order->ono));
        } else {
            return $this->writeJSAlert("创建订单失败！", route("cart.index"));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
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
        //
    }

    private function writeJSAlert($msg, $address)
    {
        return response("<script>alert('" . $msg . "');window.location.href='" . $address . "'</script>");
    }
}
