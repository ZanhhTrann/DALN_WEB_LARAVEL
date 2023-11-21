
@extends('admin.layouts.app')
@section('title', 'Order detail')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.order.orderDetail.includes.detail',['orderDetails'=>$orderDetails])
@endsection
