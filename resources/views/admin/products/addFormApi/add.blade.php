
@extends('admin.layouts.app')
@section('title', 'Product add form Api')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.products.addFormApi.includes.add',['products'=>$products])
@endsection
