<link rel="stylesheet" href="{{asset('css/pages/order.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_features.css')}}">
@extends('auth.layouts.app')
@section('content')
    <div id="section" class="section_features">
        <div class="container_reatures">
            @if(session('login'))
                     @include('auth.checkOrder.includes.orderDetail')
                @else
                    @include('auth.features.includes.cart_empty')
                @endif
        </div>
    </div>
    <script src="{{asset('js/features.js')}}"></script>
    <script src="{{asset('js/home.js')}}"></script>
@endsection
