<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\User;
use App\Models\User_favorite;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function getListByCid($Cid,$limit){
        if($limit!=""){
            Products::where('Cid', $Cid)->inRandomOrder()->limit($limit)->get();
        }
        return Products::where('Cid', $Cid)->inRandomOrder()->get();
    }

    public function getListCategoryLimit(Request $request) {
        // Lấy giá trị value từ yêu cầu Ajax
        $selectedValue = $request->input('value');
        if($selectedValue=="All Products"){
            $products=Products::inRandomOrder()->limit(12)->get();
        }else{
            $category = Categories::where('Api_value', $selectedValue)->first();
            $products = $this->getListByCid($category->Cid,12);
        }
        $newReq=['products'=>$products,
                 'page'=>$request->input('page')
                ];
        return view('auth.home.item_products', compact('newReq'));
    }

    public function getListCategoryAll($value) {
        if($value=="All Products"){
            $value="all";
        }
        $page = session('page');

        // session(['selected'=>$value]);
        $products=$this->getCatAll($value);
        if(session('changePage')==true){
            // dd(session('changePage'));
            $products=session('products_'.$value);
            session(['changePage'=>false]);
        }else{
            if(session()->has('selected')){
                if($value!=session('selected')){
                    if(session()->has('visibleProducts_' . $value)){
                        $products=session('products_'.$value);
                        // session(['changePage'=>false]);
                    }
                }
                $page=1;
            }
        }

        // $products=$this->getCatAll($value);

        $perPage = 12;
        $totalProducts = count($products);
        $pages = ceil($totalProducts / $perPage);
        $start = ($page - 1) * $perPage;
        $visibleProducts = collect($products)->slice($start, $perPage)->all();
        session(['visibleProducts_' . $value=>$visibleProducts,
                 'products_'.$value=>$products,
                 'pages'=>$pages,
                 'page'=>$page,
                 'childSelected'=>$value]);
    }
    private function getCatAll($value){
        if($value=="all"){
            $products=Products::inRandomOrder()->get();
        }else{
            $category = Categories::where('Api_value', $value)->first();
            $products = $this->getListByCid($category->Cid,"");
        }
        return $products;
    }
    public function getQuickView(Request $request) {
        // Lấy giá trị value từ yêu cầu Ajax
        $product=Products::where('Pid',$request->input('value'))->first();
        return view('auth.home.quick_view.qv_detail', compact('product'));
    }

    public function getProductbyId($Pid){
        return Products::where('Pid',$Pid)->first();
    }
    public function getReviewsbyId($Pid){
        $reviews=Reviews::where('Pid',$Pid)->get();
        $revUids=Reviews::select('Uid')->where('Pid',$Pid)->get();
        $users_name=User::select('Name')->whereIn('Uid',$revUids)->get();
        // dd($users_name);
        return ['reviews'=>$reviews,
                'users_name'=>$users_name];
    }
    public function getProductByName($keySearch){
        $products=Products::where('Product_name','like','%'.$keySearch.'%')->get();
        $page = session('page_search');
        if(session()->has('page_search')){
            $page = session('page_search');
        }else{
            $page = 1;
            session(['page_search'=>$page]);
        }
        if(session('changePage')==true){
            // dd(session('changePage'));
            $products=session('products_search');
            session(['changePage'=>false]);
        }

        // $products=$this->getCatAll($value);

        $perPage = 12;
        $totalProducts = count($products);
        $pages = ceil($totalProducts / $perPage);
        $start = ($page - 1) * $perPage;
        $visibleProducts = collect($products)->slice($start, $perPage)->all();
        session(['visibleSearch'=>$visibleProducts,
                'keySearch'=>$keySearch,
                 'products_search'=>$products,
                 'pages'=>$pages,
                 'page'=>$page]);
        return redirect()->route('searchResults');
    }

    public function getAvata($Uid)
    {
        // Lấy dữ liệu avata từ cơ sở dữ liệu
        $avataData = User::where('Uid', $Uid)->value('Avata');

        // Chuyển đổi dữ liệu từ dạng blob sang base64
        $avataBase64 = base64_encode($avataData);

        return $avataBase64;
    }

    public function adminGetListProducts($value) {
        $page = 1;
        $products = $this->getCatAll($value);

        if (session('changePage') == true) {
            $products = session('adminProducts')['products_'.$value];
            $page = session('admin_page_products');
            session(['changePage'=>false]);
        } else {
            if (session()->has('admin_selected')) {
                if ($value != session('admin_selected')) {
                    if (session()->has('adminProducts.visibleProducts_'.$value)) {
                        // dd($page);
                        $products = session('adminProducts')['products_'.$value];
                    }
                }
            }
        }
        // dd(session('adminProducts')['products_'.$value]);
        $perPage = 12;
        $totalProducts = count($products);
        $pages = ceil($totalProducts / $perPage);
        $start = ($page - 1) * $perPage;
        $visibleProducts = collect($products)->slice($start, $perPage)->all();
        session(['admin_selected' => $value]);
        if(session()->has('adminProducts')){
            $adminProducts = session('adminProducts');
            $adminProducts[ 'visibleProducts_' . $value]=$visibleProducts;
            $adminProducts[ 'pages']= $pages;
            $adminProducts[ 'page']= $page;
            $adminProducts[ 'products_' . $value]= $products;
            session([ 'adminProducts' => $adminProducts ]);
        }else{
            session()->put('adminProducts', [
            'visibleProducts_' . $value => $visibleProducts,
            'products_' . $value => $products,
            'pages' => $pages,
            'page' => $page,
            'childSelected' => $value,
        ]);
        }

    }

    public function changeProd(Request $re){
        $product=Products::where('Pid',$re->input('pid'))->first();
        if($re->input('imgChanges')!=null){
            $product->Main_image=$re->input('imgChanges');
        }
        $product->Cid=$re->input('cid');
        $product->Product_name=$re->input('name');
        $product->Price=$re->input('price');
        $product->Images=$re->input('imgs');
        $product->Colors=$re->input('colors');
        $product->Sizes=$re->input('sizes');
        $product->Description=$re->input('des');
        $product->Quantit_in_stock=$re->input('quantit');
        $product->Api_code=$re->input('Api_code');
        $product->save();
        return redirect()->back();
    }

    public function addProd(Request $re){
        $product=Products::create([
            'Main_image'=>$re->input('imgChanges'),
            'Cid'=>$re->input('cid'),
        'Product_name'=>$re->input('name'),
        'Price'=>$re->input('price'),
        'Images'=>$re->input('imgs'),
        'Colors'=>$re->input('colors'),
        'Sizes'=>$re->input('sizes'),
        'Description'=>$re->input('des'),
        'Quantit_in_stock'=>$re->input('quantit'),
        'Api_code'=>$re->input('Api_code'),
        ]);
        return redirect()->route('ProDetail',['Pid'=>$product->Pid]);
    }
    public function searchProd(Request $re){
        $products = Products::where('Product_name', 'like', '%' . $re->input('search') . '%')
    ->orWhere('Api_code', $re->input('search'))
    ->orWhere('Cid', $re->input('search'))
    ->orWhere('Pid', $re->input('search'))
    ->get();

        $page=1;
        if (session('changePage') == true) {
            $products = session('adminProducts')['products_search'];
            $page = session('admin_page_products');
        }
        $perPage = 12;
        $totalProducts = count($products);
        $pages = ceil($totalProducts / $perPage);
        $start = ($page - 1) * $perPage;
        $visibleProducts = collect($products)->slice($start, $perPage)->all();
        if(session()->has('adminProducts')){
            $adminProducts = session('adminProducts');
            $adminProducts[ 'visibleProducts_search']=$visibleProducts;
            $adminProducts[ 'pages']= $pages;
            $adminProducts[ 'page']= $page;
            $adminProducts[ 'products_search']= $products;
            session([ 'adminProducts' => $adminProducts ]);
        }else{
            session()->put('adminProducts', [
            'visibleProducts_search' => $visibleProducts,
            'products_search' => $products,
            'pages' => $pages,
            'page' => $page,
        ]);}
        return redirect()->route('ProdSearchView',['page'=>$page]);
        // return redirect()->route('ProDetail',['Pid'=>$product->Pid]);
    }

    public function deletePro($Pid){
        Products::destroy($Pid);
        return redirect()->route('Admin_MProducts_Pages',['page'=>'all']);
    }

    public function addProductFormApi($Cid){
        if($Cid=='Home'){
            return view('admin.products.addFormApi.add',['products'=>[]]);
        }
        $importPro=new \App\Console\Commands\importProducts();
        $page=1;
        if (session('changePage') == true) {
            $products = session('adminProducts')['products_Api'];
            $page = session('admin_page_products');
        }else{
            if (session()->has('admin_selected_Api')) {
                if ($Cid != session('admin_selected_Api')) {
                    if (session()->has('adminProducts.visibleProducts_Api')) {
                        // dd($page);
                        $products = session('adminProducts')['products_Api'];
                    }else{
                        $products=$importPro->getNewProduct($Cid);
                    }
                }else{
                    $products=$importPro->getNewProduct($Cid);
                }
            }else{
                $products=$importPro->getNewProduct($Cid);
            }
        }
        session(['admin_selected_Api'=>$Cid]);
        $perPage = 12;
        $totalProducts = count($products);
        $pages = ceil($totalProducts / $perPage);
        $start = ($page - 1) * $perPage;
        $visibleProducts = collect($products)->slice($start, $perPage)->all();
        if(session()->has('adminProducts')){
            $adminProducts = session('adminProducts');
            $adminProducts[ 'visibleProducts_Api']=$visibleProducts;
            $adminProducts[ 'pages']= $pages;
            $adminProducts[ 'page']= $page;
            $adminProducts[ 'products_Api']= $products;
            session([ 'adminProducts' => $adminProducts ]);
        }else{

            session()->put('adminProducts', [
            'visibleProducts_Api' => $visibleProducts,
            'products_Api' => $products,
            'pages' => $pages,
            'page' => $page,
        ]);}
        return view('admin.products.addFormApi.add',['products'=>session('adminProducts')['visibleProducts_Api']]);

    }
}
