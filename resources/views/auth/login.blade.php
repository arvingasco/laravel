@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

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
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="{{ old('remember') ? 'checked': '' }}">
                <label class="form-check-label" for="remember">
                    Remember Me
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
@endsection('content')