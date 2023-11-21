
@extends('admin.layouts.app')

@section('title', 'Products management')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.products.includes.product')
@endsection
