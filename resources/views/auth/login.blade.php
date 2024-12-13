@extends('layouts.app')

@section('content')
    <div class="form-container">
        <div class="form-heading">Login</div>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="/login">
            @csrf
            <div class="form-group col-12 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                @if ($errors->has('email'))
                    <div class="text-danger text-left">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group col-12 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
                @if ($errors->has('password'))
                    <div class="text-danger text-left">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form-group col-6 mb-3">
                <a href="/forgot-password">Forgot Password?</a>
            </div>
            <div class="form-group col-12 mb-3">
                Not registered? <a href="/register">Register</a>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

@endsection
