<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\City;
use App\Models\District;
use App\Models\Order_status;
use App\Models\Orders;
use App\Models\Orders_details;
use App\Models\Payment_methods;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\Shipping_methods;
use App\Models\Town;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index($page){
        session(['head_pages'=>$page]);
        return redirect()->route('pages.'.$page);
    }

    public function __pageHomeView(){
        return view('auth.home.home');
    }

    public function __pageThanksView(){
        return view('auth.thanks.thanks');
    }

    public function __pageHelpsView($page){
        session(['head_pages'=>$page]);
        return view('auth.help.help',['page'=>$page]);
    }

    public function __pageShopView($childCat){
        return view('auth.shop.shop',['childCat'=>$childCat]);
    }
    public function __pageFeaturesView(){
        return view('auth.features.features');
    }
    public function __pageAboutView(){
        return view('auth.about.about');
    }
    public function __pageContactView(){
        return view('auth.contact.contact');
    }
    public function __pageSignupView(){
        if(session('login')){
            return back();
        }
        return view('auth.sign.signup');
    }
    public function __pageSigninView(){
        if(session('login')){
            return back();
        }
        return view('auth.sign.signin');
    }

    public function __pagePaymentView(){
        if(!session('login')){
            return redirect()->route('pages.index',['page'=>'signup']);
        }
        return view('auth.pay.pay');
    }
    public function __pageOrdersView(){
        if(!session('login')){
            return redirect()->route('pages.index',['page'=>'signup']);
        }
        return view('auth.checkOrder.checkOrder');
    }
    public function __pageProfileView(){
        if(!session('login')){
            return back();
        }
        return view('auth.profile.profile');
    }
    public function __pageSearchView(){
        return view('auth.shop.search.search');
    }
    public function __changeCatList(Request $request){
        // dd($request);
        $value=$request->input('selectedValue');
        return redirect()->route('shopList',['value'=>$value]);
    }
    public function __listProducts($value){
        $proController=new \App\Http\Controllers\ProductsController();
        $proController->getListCategoryAll($value);
        if(strpos($value, "_") !== false){
            $value=substr($value, 0, strpos($value, "_"));
        }
        // dd($value);
        // dd(session('head_pages'));
        if(session('head_pages')!='shop'){
            session(['head_pages'=>'shop']);
        }
        session(['selected'=>$value]);
        if(session()->has('page')){
            $page=session('page');
            // dd(session());
        }else{
            $page=1;
            session(['page'=>$page]);
        }
        return redirect()->route('showListProducts',['value'=>$value,'page'=>$page]);
    }
    // public function __showListProducts($value){
    //     return redirect()->route('shop.'.$value);
    // }
    public function updatePage(Request $request) {
        $newPage = $request->input('newPage');
        session(['page' => $newPage,
                 'changePage'=>true]);
        return response()->json(['redirectUrl' => route('shopList', ['value' => session('selected')])]);
    }

    public function productDetail($Pid){
        if(session('head_pages')!='shop'){
            session(['head_pages'=>'shop']);
        }
        return view('auth.shop.product_detail.product_detail',['Pid'=>$Pid]);
    }

    // search
    public function searchResults()
    {
        // dd($request->input('key'));
        session(['head_pages'=>'shop']);
        return view('auth.shop.search.search');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        return redirect()->route('getProductByName', ['searchTerm' => $searchTerm]);
    }
    public function updatePageSearch(Request $request) {
        $newPage = $request->input('newPage');
        session(['page_search' => $newPage,
                 'changePage'=>true]);
        return response()->json(['redirectUrl' => route('getProductByName', ['searchTerm' => session('keySearch')])]);
    }


    // Admin
    public function __pageAdminLoginView(){
        return view('admin.signup.signup');
    }

    public function __pageDashboardView()
    {
        // Lấy số lượng sản phẩm, danh mục, và đơn hàng
        $productCount = Products::count();
        $categoryCount = Categories::count();
        $orderCount = Orders::count();
        $userCount=User::count();
        $shipCount=Shipping_methods::count();
        $paymentCount=Payment_methods::count();
        $reviewCount=Reviews::count();

        // Chia dữ liệu thành các hàng mỗi hàng chứa 3 bảng
        $data = [
            ['name' => 'Products', 'count' => $productCount],
            ['name' => 'Categories', 'count' => $categoryCount],
            ['name' => 'Orders', 'count' => $orderCount],
            ['name' => 'User', 'count' => $userCount],
            ['name' => 'Shipping_methods', 'count' => $shipCount],
            ['name' => 'Payment_methods', 'count' => $paymentCount],
            ['name' => 'Reviews', 'count' => $reviewCount],
            // Thêm các bảng khác nếu cần
        ];

        return view('admin.dashboard.dashboard', compact('data'));
    }
    public function __pageCasManagementView()
    {
        return view('admin.categories.categories');
    }
    public function CasAddView()
    {
        return view('admin.categories.add.add');
    }
    public function AddformApiView()
    {
        return view('admin.categories.addFormApi.addFormApi');
    }
    public function CasMPage()
    {
        $categories = Categories::all();
        $page = 1;
        if(session()->has('admin_page_casts')){
            $page = session('admin_page_casts');
        }
        if(session('changePage')==true){
            // dd(session('changePage'));
                $categories=session('Admin_Cat')['cas'];
                session(['changePage'=>false]);
        }
        $perPage = 12;
        $totalCats = count($categories);
        $pages = ceil($totalCats / $perPage);
        $start = ($page - 1) * $perPage;
        $admin_visible_cas = collect($categories)->slice($start, $perPage)->all();
        session()->put('Admin_Cat', ['visible_cas'=>$admin_visible_cas,
        'cas'=>$categories,
        'pages'=>$pages,
        'page'=>$page]);
        return redirect()->route('CasManagement', ['page' => $page] );
    }
    public function updatePageCatAdmin(Request $request) {
        $newPage = $request->input('newPage');
        session(['admin_page_casts' => $newPage,
                 'changePage'=>true]);
        return response()->json(['redirectUrl' => route('CasMPageView')]);
    }

    public function __pageCatDetailView($Cid)
    {
        return view('admin.categories.changeCat.changeCat',['Cid'=>$Cid]);
    }

    // Products
    public function prodAdminView($page){
        $proController=new \App\Http\Controllers\ProductsController();
        $proController->adminGetListProducts($page);
        return view('admin.products.products');
    }
    public function prodAdminPagesView($page){
        // dd($page);
        $p=1;
        if (session('changePage') == true) {
            if(session()->has('admin_page_products')){
                $p=session('admin_page_products');
            }
        }
        return redirect()->route('Admin_MProducts', ['page' => $page,'p'=>$p]);
    }
    public function updatePageProdAdmin(Request $request) {
        $newPage = $request->input('newPage');
        session(['admin_page_products' => $newPage,
                 'changePage'=>true]);
        return response()->json(['redirectUrl' => route('adminChagePageProducts')]);
    }
    public function adminCP(){
        // dd(session());
        return redirect()->route('Admin_MProducts_Pages',['page'=>session('admin_selected')] );
    }
    //
    public function __pageProdDetailView($Pid)
    {
        return view('admin.products.change.change',['Pid'=>$Pid]);
    }
    public function addProdView()
    {
        return view('admin.products.add.add');
    }

    public function ProdSearchView()
    {
        return view('admin.products.search.search');
    }

    public function __pageNewProDetailView($tempPid)
    {
        // dd($tempPid);
        return view('admin.products.addFormApi.NewDetail.detail',['tempPid'=>$tempPid]);
    }

    public function getOrder(){
        $orders = Orders::orderBy('Oid', 'desc')->get();
        return view('admin.order.order',['orders'=>$orders]);
    }
    public function orderDetails($oid){
        $orderdetails=[];
        $details = Orders_details::where('Oid',$oid)->get();
        foreach($details as $key=>$detail){
            $status= Order_status::where('ODid',$detail->ODid)->first();
            $quantity=Products::select('Quantit_in_stock')->where('Pid',$detail->Pid)->first();
            // dd($status);
            $orderdetail=[
                'ODid'=>$detail->ODid,
                'Oid'=>$detail->Oid,
                'Pid'=>$detail->Pid,
                'color'=>$detail->color,
                'size'=>$detail->size,
                'Quantily'=>$detail->Quantily,
                'Quantit_in_stock'=>$quantity->Quantit_in_stock,
                'PPatToO'=>$detail->PPatToO,
                'created_at'=>$detail->created_at,
                'updated_at'=>$detail->updated_at,
                'Status'=>$status->Status,
            ];
            array_push($orderdetails,$orderdetail);
        }
        return view('admin.order.orderDetail.orderDetail',['orderDetails'=>$orderdetails]);

    }
}
