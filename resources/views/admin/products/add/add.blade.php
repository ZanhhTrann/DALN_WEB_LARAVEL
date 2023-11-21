
@extends('admin.layouts.app')
@section('title', 'Product Change')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.products.add.includes.addDetail')
@endsection
