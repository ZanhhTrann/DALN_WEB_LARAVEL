@php
    $proController=new \App\Http\Controllers\ProductsController();
    $product=$proController->getProductbyId($Pid);
    // dd($childCat);
@endphp
<link rel="stylesheet" href="{{asset('css/pages/products-detail.css')}}">
@extends('auth.layouts.app')
@section('content')
<section id="section" class="section_product-details">
    @include('auth.shop.product_detail.includes.quick_view',['product'=>$product])
    @include('auth.shop.product_detail.includes.tab_content',['product'=>$product])
</section>
<script>
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
<script src="{{ asset('js/home.js') }}"></script>
<script src="{{ asset('js/product-detail.js') }}"></script>
@endsection

