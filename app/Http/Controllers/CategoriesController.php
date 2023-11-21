<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __getCats($perCat){
        return Categories::where('Api_value', 'LIKE', $perCat.'_%')->where('Api_value', 'NOT LIKE', $perCat.'_%\_%')->get();
    }
    public function getProductsByCategory(Request $request){
        // dd($request);
        return response()->json($request);
    }

    public function getChilCategory(Request $request) {
        // Lấy giá trị value từ yêu cầu Ajax
        $selectedValue = $request->input('value');
        $chilCats = $this->__getCats($selectedValue);
        return view('auth.home.categoriesChil', compact('chilCats'));
    }

    public function getCatById($Cid){
        return Categories::Where('Cid',$Cid)->first();
    }
    public function updateCat(Request $request){
        $cat=$this->getCatById($request->input('Cid'));
        $cat->update(['Categories_name'=>$request->input('name'),
        'Api_value'=>$request->input('Api_value'),
        'Api_code'=>$request->input('Api_code')]);
        $cat->save();
        $page = 1;
        if(session()->has('admin_page_casts')){
            $page = session('admin_page_casts');
        }
        return redirect()->route('CasManagement', ['page' => $page]);
    }
    public function addCat(Request $request){
        $cat=Categories::create(['Categories_name'=>$request->input('name'),
        'Api_value'=>$request->input('Api_value'),
        'Api_code'=>$request->input('Api_code')]);
        return redirect()->route('CatDetail',['Cid'=>$cat->Cid]);
    }
    public function deleteCat($Cid){
        // dd($Cid,Categories::Where('Cid',$Cid)->first());
        Categories::where('Cid',$Cid)->delete();
        session(['admin_deCat'=>true]);
        return redirect()->route('CasMPageView');
    }

    public function adminCatSearch(Request $re){
        $categories=Categories::where('Categories_name','like','%'. $re->input('search').'%')
        ->orWhere('Cid', $re->input('search'))
        ->orWhere('Api_value', $re->input('search'))->get();
        $page = 1;
        // dd($categories);
        session()->put('Admin_Cat', ['visible_cas'=>$categories,
        'cas'=>$categories,
        'pages'=>1,
        'page'=>$page]);
        return redirect()->route('CasManagement', ['page' => $page] );
    }

}
