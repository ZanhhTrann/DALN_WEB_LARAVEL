
@extends('admin.layouts.app')

@section('title', 'Order Management')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.order.includes.orderList')
@endsection
