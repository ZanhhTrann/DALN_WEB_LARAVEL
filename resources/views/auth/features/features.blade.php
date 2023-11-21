<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_features.css')}}">@extends('auth.layouts.app')
@php
    if(session('login')){
        $user=new \App\Http\Controllers\UsersController();
        $cart=$user->getCart();
    }

@endphp
@section('content')
    <div id="section" class="section_features">
        <div class="container_reatures">
            @if(session('login')&&count($cart)>0)
                <div class="reatures">
                    @include('auth.features.includes.cart_detail')
                    {{-- @include('auth.features.includes.cart_total') --}}
                </div>
                @else
                    @include('auth.features.includes.cart_empty')
                @endif
        </div>
    </div>
    <script src="{{asset('js/features.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
