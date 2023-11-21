
@extends('admin.layouts.app')

@section('title', 'Add Categories Form Api')
<link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
<link rel="stylesheet" href="{{asset('css/pages/features.css')}}">
@section('content')
    @include('admin.categories.addFormApi.includes.formApiView')
@endsection
