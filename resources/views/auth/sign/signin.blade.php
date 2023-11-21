
<link rel="stylesheet" href="{{asset('css/layouts_css/login_register.css')}}">
@extends('auth.layouts.app_title')
@section('content')
<div class="container">
    <h1>Register</h1>
    <form action="{{route('signin')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-control">
            <input type="text" value="{{ old('name') }}" name="name" required>
            <label>Họ và tên</label>
        </div>
        <div class="form-control">
            <input type="text" value="{{ old('email') }}" name="email" required>
            <label>Email</label>
        </div>
        <div class="form-control">
            <input id="password" type="password"
            name="password" required>
            <label>Password</label>
        </div>
        <div class="form-control">
            <input id="confirm_password" type="password"
            name="password_confirm" required>
            <label>Password Confirm</label>
        </div>
        <button class="btn">Register</button>
        <p class="text">Already have an account?
            <a href="{{route('pages.index',['page'=>'signup'])}}">Login</a>
        </p>
    </form>
</div>
<script src="{{asset('js/form_wave_input.js')}}"></script>
@endsection

