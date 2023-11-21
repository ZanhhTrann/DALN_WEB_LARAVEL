<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_features.css')}}">
@extends('auth.layouts.app')
@php
    if(session('login')){
        $user=new \App\Http\Controllers\UsersController();
        $cart=$user->getCart();
    }

@endphp
@section('content')
    @include('auth.thanks.includes.thanks')
    <script src="{{asset('js/features.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
