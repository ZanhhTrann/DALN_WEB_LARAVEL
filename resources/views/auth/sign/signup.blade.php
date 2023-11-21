
<link rel="stylesheet" href="{{asset('css/layouts_css/login_register.css')}}">
@extends('auth.layouts.app_title')
@section('content')
<div class="container">
    <h1>Please Login</h1>
    <form action="{{route('signup')}}" method="POST">
        @csrf
        <div class="form-control">
            <input name="email" value="{{ old('email') }}" type="text" required>
            <label>Email</label>
        </div>
        <div class="form-control">
            <input name="password" type="password" required>
            <label>Password</label>
        </div>
        <button class="btn">Login</button>
        <p class="text">Don't have an account?
            <a href="{{route('pages.index',['page'=>'signin'])}}">Register</a>
        </p>
    </form>
</div>
<script src="{{asset('js/form_wave_input.js')}}"></script>
@endsection

