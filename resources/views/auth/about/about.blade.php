
<link rel="stylesheet" href="{{asset('css/pages/about.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_about.css')}}">
@extends('auth.layouts.app')
@section('content')
<section id="section" class="section_about">
    <div class="img_content">About</div>
    <div class="container">
        @include('auth.about.includes.story')
        @include('auth.about.includes.mission')
    </div>
</section>
@endsection
