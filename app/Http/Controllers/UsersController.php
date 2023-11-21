<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\User;
use App\Models\User_cart;
use App\Models\User_favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    //
    private function checkSignin($email,$password,$comp){
        $existxEmail=User::where("Email",$email)->first();
        if($existxEmail){
            return 0;
        }
        if(strlen($password)<8){
            return -1;
        }
        if(!(preg_match('/[A-Z]/', $password)&&preg_match('/[a-z]/', $password) &&preg_match('/[0-9]/', $password) && preg_match('/[!@#$%^&*(),.?":{}|<>]/',$password))){
            return -2;
        }
        if(strcmp($password, $comp) != 0){
            return -3;
        }
        return 1;
    }
    public function signin(Request $request)
    {
        // dd($request->all());
        // Validate user input
        switch ($this->checkSignin($request->input('email'),$request->input('password'), $request->input('password_confirm'))) {
            case 0:
                return back()->withInput($request->except('password', 'password_confirm'))->with('error', 'Email đã được đăng ký trước đó !');
            case 1:
                $user = User::create([
                    'Name' => $request->input('name'),
                    'Email' => $request->input('email'),
                    'Password' => Hash::make($request->input('password')),
                ]);
                if ($user) {
                    session()->put('login', [
                        'user_id' => $user->Uid,
                        'user_email'=>$user->Email,
                        'user_name' => $user->Name,
                        // Thêm các thông tin khác nếu cần
                    ]);
                    Auth::login($user);
                    if(session('f_check')==true){
                        session(['f_check'=>false]);
                        Session::forget('f_id');
                        return redirect()->route('updateFavorite',['Pid'=>session('f_id')]);
                    }
                    if(session('c_check')==true){
                        session(['c_check'=>false]);
                        Session::forget('c_id');
                        return redirect()->route('productDetail',['Pid'=>session('c_id')]);
                    }
                    return redirect()->intended('/');
                } else {
                    return back()->withInput($request->except('password', 'password_confirm'))->with('error', 'Error creating user !');
                }

            case -1:
                return back()->withInput($request->except('password', 'password_confirm'))->with('error', 'Mật khẩu phải có ít nhất 8 ký tự !');

            case -2:
                return back()->withInput($request->except('password', 'password_confirm'))->with('error', 'Mật khẩu phải có ít một ký tự in hoa, một ký tự in thường,một ký tự số (0-9) và 1 ký tự đặc biệt (@_/....) !')
                    ->with('type', 'warning'); // Thêm loại để xác định kiểu thông báo

            case -3:
                return back()->withInput($request->except('password', 'password_confirm'))->with('error', 'Nhập lại mật khẩu không chính xác !')
                    ->with('type', 'error'); // Thêm loại để xác định kiểu thông báo
        }
    }

    public function signup(Request $request)
{
    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ];

    $user = User::where('Email', $credentials['email'])->first();

    if ($user && Hash::check($credentials['password'], $user->Password)) {
        // Mật khẩu đúng
        session()->put('login', [
            'user_id' => $user->Uid,
            'user_email'=>$user->Email,
            'user_name' => $user->Name,
            // Thêm các thông tin khác nếu cần
        ]);
        Auth::login($user);
        if(session('f_check')==true){
            session(['f_check'=>false]);
            Session::forget('f_id');
            return redirect()->route('updateFavorite',['Pid'=>session('f_id')]);
        }
        if(session('c_check')==true){
            session(['c_check'=>false]);
            Session::forget('c_id');
            return redirect()->route('productDetail',['Pid'=>session('c_id')]);
        }
        return redirect()->intended('/');
    }

    // Mật khẩu không đúng hoặc người dùng không tồn tại
    return back()->withInput($request->except('password'))->with('error', 'Email hoặc mật khẩu không đúng !')->with('type', 'error');
}

    public function getCart(){
        return User_cart::where('Uid',session('login')['user_id'])->get();
    }
    public function getCartOrder(){
        $UCids=session('payment')['UCids'];
        return User_cart::whereIn('UCid', $UCids)
        ->get();
    }
    public function getFavorite(){
        return User_favorite::where('Uid',session('login')['user_id'])->get();
    }
    public function Signout(){
        Auth::logout();
        Session::forget('login');
        return redirect()->intended('/');
    }
    public function getAvata()
    {
        // Lấy dữ liệu avata từ cơ sở dữ liệu
        $avataData = User::where('Uid', session('login')['user_id'])->value('Avata');

        // Chuyển đổi dữ liệu từ dạng blob sang base64
        $avataBase64 = base64_encode($avataData);

        return $avataBase64;
    }

    public function updateFavorite($Pid){
        if(session('head_pages')!='shop'){
            session(['head_pages'=>'shop']);
        }
        if(session('login')){
            $favorite = User_favorite::where('Pid', $Pid)->first();
            if ($favorite) {
                $favorite->delete();
            } else {
                User_favorite::create([
                    'Uid'=>session('login')['user_id'],
                    'Pid' => $Pid,
                ]);
            }
        }else{
            session(['f_check'=>true,'f_id'=>$Pid]);
            return redirect()->route('pages.index',['page'=>'signup']);
        }
        return redirect()->route('productDetail',['Pid'=>$Pid]);
    }
    public function updateCart(Request $request,$Pid)
    {
        // dd($request);
        if(session('head_pages')!='shop'){
            session(['head_pages'=>'shop']);
        }
        if(session('login')){
            $validatedData = $request->validate([
                'size_id' => 'required',
                'color_id' => 'required',
            ]);
            // Lấy thông tin size và color từ request
            $size = $validatedData['size_id'];
            $color = $validatedData['color_id'];
            $cart = User_cart::where('Pid', $Pid)->first();
            if ($cart) {
                if(($cart->size==$size)&&($cart->color==$color)){
                    $cart->update(['quantity'=>$cart->quantity+1]);
                    $cart->save();
                    return redirect()->route('productDetail',['Pid'=>$Pid]);
                }
            }
            User_cart::create([
                'Uid'=>session('login')['user_id'],
                'Pid' => $Pid,
                'quantity'=>1,
                'color'=> $color,
                'size'=>$size
            ]);
        }else{
            session(['c_check'=>true,'c_id'=>$Pid]);
            return redirect()->route('pages.index',['page'=>'signup']);
        }
        return redirect()->route('productDetail',['Pid'=>$Pid]);
    }

    public function updateUserCart(Request $request){
        // dd($request);
        $ucids=$request->input('ucids');
        $colors=$request->input('colors');
        $sizes=$request->input('sizes');
        $quantities=$request->input('quantities');
        foreach($ucids as $key=>$ucid){
            $cart = User_cart::where('UCid',$ucid)->first();
            // dd($cart);
            if ($cart) {
                if ($cart->size !==$sizes[$key]) {
                    $cart->size = $sizes[$key];
                }
                if ($cart->color !== $colors[$key]) {
                    $cart->color = $colors[$key];
                }
                if ($cart->quantity !== $quantities[$key]) {
                    $cart->quantity = $quantities[$key];
                }
                $cart->save();
            }
        }
        return back();
    }
    public function DelelteProductCart($UCid){
        User_cart::where('UCid', $UCid)->delete();
        return back();
    }

    public function getUser(){
        return User::where('Uid',session('login')['user_id'])->first();
    }

    public function updataProfile(Request $request){
        $user=$this->getUser();
        // Cập nhật thông tin từ request
        $user->Name = $request->input('Name');
        $user->Phone_number = $request->input('phone');
        $user->Addrest = $request->input('addrest');
        // Kiểm tra xem có ảnh mới được chọn hay không
        if ($request->hasFile('imgChanges')) {
            $avatarData = file_get_contents($request->file('imgChanges')->getRealPath());
            $user->avata = $avatarData;
        }
        // Lưu thông tin người dùng
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
        // dd($request,$user);

        // return User::where('Uid',session('login')['user_id'])->first();
    }

    public function putReview(Request $request){
        // dd($request->input('contents'));
        Reviews::create(['Pid'=>$request->input('product_id'),
        'Uid'=>session('login')['user_id'],
        'reviews'=>$request->input('contents')
        ]);
        return redirect()->back()->with('success', 'Profile updated successfully');
    }


}
