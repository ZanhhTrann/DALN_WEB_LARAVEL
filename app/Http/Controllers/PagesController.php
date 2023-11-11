<?php

namespace App\Http\Controllers;

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
        return view('auth.sign.signup');
    }
    public function __pageSigninView(){
        return view('auth.sign.signin');
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
        return view('auth.shop.product_detail.product_detail',['Pid'=>$Pid]);
    }

    // search
    public function searchResults(Request $request)
    {
        dd($request->input('key'));
        session(['head_pages'=>'shop']);
        $keySearch = $request->input('search');
        return view('auth.shop.search.search', ['keySearch' => $keySearch]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        return redirect()->route('searchResults', ['key' => $searchTerm]);
    }

}
