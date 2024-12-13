@extends('layouts.app')

@section('content')
    <div class="form-container">
        <div class="form-heading">Register</div>
        <form method="POST" action="/registration">
            @csrf
            <div class="form-group col-12 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <div class="text-danger text-left">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group col-12 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
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
            <div class="form-group col-12 mb-3">
                Already have an account? <a href="/">Login</a>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>

@endsection
