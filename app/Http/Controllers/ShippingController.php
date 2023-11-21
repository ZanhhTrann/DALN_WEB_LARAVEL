<?php

namespace App\Http\Controllers;

use App\Models\Order_status;
use App\Models\Orders_details;
use App\Models\Shipping_methods;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    //
    public function getShippings(){
        return Shipping_methods::all();
    }
    public function getShipbyId(){
        return Shipping_methods::where("SMid",session('payment')['select'])->first();
    }
}
