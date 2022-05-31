<?php

namespace App\Http\Controllers;

use Alipay\EasySDK\Kernel\Config;
use Alipay\EasySDK\Kernel\Factory;
use App\Models\Order;

function getOptions()
{
    $options = new Config();
    $options->appId = '2021000117677816';
    $options->protocol = 'https';
    $options->gatewayHost = 'openapi.alipaydev.com';
    $options->signType = 'RSA2';
    $options->alipayPublicKey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzKfJPdAxFhHbbvqbaQJ3n+I3IlLA1MEiNqtnEKiAG6ZvhBxche85VfD9JiI//Vaykm6IUMXdzsooLsUp77+PkojTiwHjmWpXWm9wHv10Zc9JSzPnMrQCDHUGUogFV2StjZpWbCXPEyCemIE5HgpoAl4fSMeYbUr78VB1Zk6H0ysPlb6eVemKs64aw0uCLbUCgSs0W4tNJRXp3mvYKRg+SqE4CzpzFTW02QClp2eqK7yb1dTIgHNDYQRQQogud+Ibe2Ht6KHrtE4dbaJsRErfbix1YAN2YtZng340HINH8sSDXu3YsefHoTEGQ4EL4ZmEXht2JgckWIL1Xm8ONcV4YwIDAQAB";
    $options->merchantPrivateKey = "MIIEogIBAAKCAQEA4q8/n4SZ3ddihFaSDNFOJFGgJS2xfhpgnwsF88uwsdug/8y655KTPBMhKFMQ+FR2rAAxcb69EORSsBUie+k96uiaseTqrbu2qkkfBJ95NlowJA+BICi8+6TV/cGQjrYlWzG7ZNpTjp1xZ5tBIidyx1AfqzWEoTWOJPG6q052Wxhcf+cy6TIKsUFCIgU0TgsviXndHQuV1C2tZcdoipo5pDHAjztJz6p0mKWGrc7VBHziLEJH//Lqz6uMToomAFITvyrVSF6Ggj528mo32yuVipNLYFXQ347C1jeropwxbCVonnM3IuGgdNH2jPCd5F0hNLonOPhZ1iuWwrPch8qPbwIDAQABAoIBAB9Gco69qsTyvILptsjR7+gO4vt+LGjrlr0atj2GsuA3HyVrx7W/gVTehsqbe1HnxV/BvxCkck1sUwQ8Rj+2VHaelQlKPh6uMWuZHxByODUJiG7RPM2FEV3exi92j01BUDIe0G3/uVuJ2WWkA/6EVs+s/FGQ1rWvP+dU+p47+xRiK3j5EuSy+MQf4hFiLnqeVMQu1Btrzx8uaA0T96pcL5+QDSOmOpCTgnnYENXqJLesw4ZxqXxlLsR2U7sPMSHHdyGg17nvIGBoMVW1VTZQmUhEZ2sdT4GKHFENV5Fk/FruOMulhQB7XU/rR9r9rk+giEIOzvQ3d6i7Ol1hvLM0MJECgYEA/9oNLANjsQgipdSSiq1wMGRpJxW2c777NyHIbepedQzRgDHNM/H55QLoDQKrug092Pa9WhrbeEvYdaeHmbMjRo6fLVEjuSWpqTbjMc98Pti2PncioQqxnTiqH9wj2Dre835sAjvMXfW5E/+3u9IyUAi4EVg29xKeoCgJmsnueSMCgYEA4tDe9QK+vKqETY70nruXrFhScaz2RYB1IYNbxAfN3Cd+shNiBK+YWjTIjfDQeNrHWqhghYi3xn/UcSfrCxz6dF8I/BaE28HsWkcWmP8enhLtT4PguUrEZ/JUZOjwV9X63xLTYHJtCKV40EETP1nxhCVL1rZjZHT8tZTxboFNg0UCgYB7YjeZ8yR/elHjMQlekVeaLsI7FBCB7ycNJmCXCUB2KDFcJig0lcwScf1gUNpqBfq+h/c23d7bO5Bu5NTS/X3Uh/EhlJCquAwCy7JzEgFz+WSh6SgtC5AuJuZ8KNisbW+Zc205AoeDBH41s8tya2LSD/JcgvM24abXy5ceK6WyiwKBgFZ76BeqNUpBBnOAR9vikaHAh6camUjFA2SE7s+fXipM0O1boKtCvSfgKnyczxDV8t+phixEhjZk9X80BlZVdVY8CnP8rioRFmsR4hbyaB1EAEKqeVyNmrg72VwkycfkKmU2i2yiFNsQJTHbLliglguaIQG8x8c9KEKgiTJmkUS1AoGAEI7tn0ERCaqn8UjXr95D686/yL0jcvJybI6YtXwdW/0pDV6beH8OQWYvj36+4BeagNwlNO/HCY8RiQzjGV537a3rQasZRbul8GzOp5QWR+tWWxsUm21yL79X8hDzHuDLYV2St55ICW6QqTan1YHw9CUtHxlAnaC9RTn0IKbL9Ek=";
    $options->notifyUrl = "http://liuye.site:8000/notifyurl";
    return $options;
}

Factory::setOptions(getOptions());

class PayController extends Controller
{

    public function gotoPage()
    {
        return redirect(route("order.index"));
    }

    public function pay($ono)
    {
        $order = Order::where("ono", "=", $ono)->get();
        $totalPrice = $order[0]->total_amount;
        $productName = "";
        foreach ($order[0]->orderitem as $orderitem) {
            $productName = $productName . $orderitem->product->name . "×" . $orderitem->count . "  ";
        }

        try {
            return Factory::payment()->page()->pay($productName, $ono, $totalPrice, "http://liuye.site:8000/returnurl")->body;
        } catch (\Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }
    }

    public static function checkOnoStatus($ono)
    {
        try {
            $res = Factory::payment()->common()->query($ono);
            if ($res->code == 10000) {
                if ($res->tradeStatus == "TRADE_SUCCESS") {
                    Order::where("ono", "=", $ono)->update([
                        "status" => 1,
                        "alipay_trade_no" => $res->tradeNo,
                        "update_time" => now(),
                    ]);
                }
                if ($res->tradeStatus == "WAIT_BUYER_PAY") {
                    Order::where("ono", "=", $ono)->update([
                        "status" => 0,
                        "alipay_trade_no" => $res->tradeNo,
                        "update_time" => now(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            echo "调用失败，" . $e->getMessage() . PHP_EOL;;
        }
    }
}
