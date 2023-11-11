@extends('auth.layouts.app')
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_features.css')}}">
@section('content')
    <div id="section" class="section_features">
        <div class="container">
            @if(session()->has('Login'))
                @include('auth.features.includes.cart_detail')
                @include('auth.features.includes.cart_total')
            @else
                @include('auth.features.includes.cart_empty')
            @endif
        </div>
    </div>
    <script src="{{asset('js/features.js')}}"></script>
@endsection
