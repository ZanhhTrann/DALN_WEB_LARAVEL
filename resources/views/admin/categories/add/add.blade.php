
@extends('admin.layouts.app')
@section('title', 'Add Categoties')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.categories.add.includes.addCat')
@endsection
