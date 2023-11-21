
@extends('admin.layouts.app')

@section('title', 'Categoties Management')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.categories.includes.list')
@endsection
