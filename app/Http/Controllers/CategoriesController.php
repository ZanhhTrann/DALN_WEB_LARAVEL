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

}
