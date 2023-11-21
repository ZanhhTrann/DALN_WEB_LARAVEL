@php
    $catC=new \App\Http\Controllers\CategoriesController();
    $cat=$catC->getCatById($Cid);
@endphp
@extends('admin.layouts.app')
@section('title', 'Change Category')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.categories.changeCat.includes.catdetail',['cat'=>$cat])
@endsection
