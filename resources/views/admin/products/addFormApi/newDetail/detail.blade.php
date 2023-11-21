@php
    $pro=session('adminProducts')['visibleProducts_Api'][$tempPid];
@endphp
@extends('admin.layouts.app')
@section('title', 'Product Change')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.products.addFormApi.NewDetail.includes.detail',['product'=>$pro])
@endsection
