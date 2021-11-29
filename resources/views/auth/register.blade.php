@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input name="name" value="{{ old('name') }}" required class="form-control">
        </div>
        @error('name')
        <div class = 'alert alert-danger'>{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label>Email</label>
            <input name="email" value="{{ old('email') }}" required class="form-control">
        </div>
        @error('email')
        <div class = 'alert alert-danger'>{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label>Password</label>
            <input name="password" required type ="password" required class="form-control">
        </div>
        @error('password')
        <div class = 'alert alert-danger'>{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label>Confirm password</label>
            <input name="password_confirmation" required class="form-control" type="password">
        </div>
        @error('password_confirmation')
        <div class = 'alert alert-danger'>{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
@endsection('content')