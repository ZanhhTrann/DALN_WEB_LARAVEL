
<link rel="stylesheet" href="{{asset('css/layouts_css/login_register.css')}}">
@extends('admin.layouts.layout')
@section('content')
<div class="container">
    <h1>Admin Login</h1>
    <form action="{{route('checkSignin')}}" method="POST">
        @csrf
        <div class="form-control">
            <input name="id" value="{{ old('id') }}" type="text" required>
            <label>Admin ID</label>
        </div>
        <div class="form-control">
            <input name="password" type="password" required>
            <label>Password</label>
        </div>
        <button class="btn">Login</button>
    </form>
</div>
<script src="{{asset('js/form_wave_input.js')}}"></script>
@endsection

