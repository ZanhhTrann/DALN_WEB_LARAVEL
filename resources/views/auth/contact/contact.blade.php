
<link rel="stylesheet" href="{{asset('css/pages/contract.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive/res_contract.css')}}">
@extends('auth.layouts.app')
@section('content')
<div class="section_contract">
    <div class="img_content">Contract</div>
    <div class="container">
        @include('auth.contact.includes.sending')
        @include('auth.contact.includes.contact_infor')
    </div>
    @include('auth.contact.includes.map')
</div>
@endsection
