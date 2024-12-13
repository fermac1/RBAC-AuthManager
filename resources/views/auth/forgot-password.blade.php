@extends('layouts.app')

@section('content')
    <div class="form-container">
        <div class="form-heading">Forgot Password</div>
        @if(session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="/password/forgot">
            @csrf
            <div class="form-group col-12 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>

            <button type="submit" class="btn">Send Reset Link</button>
        </form>
    </div>

@endsection
