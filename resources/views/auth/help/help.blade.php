@extends('auth.layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/responsive/responsive.css')}}">
<style>
    #section.section_help{padding: calc(80px + 40px) 0 85px;}
    .content-page {margin-top: 12px}
    .content-page > p > strong {display: block; margin-bottom: 12px}
    span {display: block;}
    .bao-hanh-title {display: flex;
        padding-bottom: 30px;
        font-size: 25px;
        font-weight: 600;}
    ol {margin-left: 35px;}
    .rte p {
        padding: 12px 0;
    }
</style>
    @include('auth.help.includes.'.$page)
@endsection
