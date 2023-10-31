{{-- @extends('layouts.user_layout.app') --}}
@extends('auth.layouts.app')
@section('content')
<section id="section" class="section_home">
    @include('auth.includes.slider')
    @include('auth.includes.banner')
    {{-- @include('auth.home.overview') --}}
    @include('auth.includes.load_more')
</section>
@endsection

