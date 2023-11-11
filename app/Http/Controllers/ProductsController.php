<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\User;
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
        $reviews=Reviews::where('Pid',$Pid)->first();
        $users_name=[];
        if(!empty($reviews)){
            foreach($reviews as $review){
                $users_name[]=User::select('Name')->where('Uid',$review->Uid)->first();
            }
        }

        return ['reviews'=>$reviews,
                'users_name'=>$users_name];
    }
}
