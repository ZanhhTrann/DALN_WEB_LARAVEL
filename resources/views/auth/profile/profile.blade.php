<link rel="stylesheet" href="{{asset('css/pages/profile.css')}}">
@extends('auth.layouts.app')
@section('content')
    <script src="{{asset('js/home.js')}}"></script>
    @include('auth.profile.includes.infor');

@endsection
