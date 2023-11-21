<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order_status;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //

    public function postLogin(Request $request)
    {

        $credentials = [
            'id' => $request->input('id'),
            'password' => $request->input('password'),
        ];

        $admin = Admin::where('id', $credentials['id'])->first();
        // dd($admin,$admin && Hash::check($credentials['password'], $admin->password));

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Mật khẩu đúng
            session()->put('login_admin', [
                'admin_id' =>$request->input('id'),
                'admin_name' => $admin->name,
                // Thêm các thông tin khác nếu cần
            ]);
            // dd(session('login_admin'));
            return redirect()->route('dashboard');

        }
        return redirect()->back()->withInput()->withErrors(['error' => 'Invalid login credentials']);
    }

    public function accsetOrder($ODid){
        $order=Order_status::where('ODid',$ODid)->first();
        $order->Status=2;
        $order->save();
        return redirect()->back()->with('success','');
    }
    public function cancelOrder($ODid){
        $order=Order_status::where('ODid',$ODid)->first();
        $order->Status=-2;
        $order->save();
        return redirect()->back()->with('success','');
    }

    public function searchOrder(Request $re){
        $orders=Orders::where('Order_name','like', '%' . $re->input('search') . '%')
        ->orWhere('Oid', $re->input('search'))
        ->orWhere('Uid', $re->input('search'))
        ->orWhere('PMid', $re->input('search'))
        ->orWhere('SPid', $re->input('search'))
        ->orWhere('Phone_number', $re->input('search'))->get();
        return view('admin.order.order',['orders'=>$orders]);
    }
}
