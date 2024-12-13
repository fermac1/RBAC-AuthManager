@extends('layouts.app')

@section('content')
    <div class="form-container">
        @if(session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif
        <div class="form-heading">Reset Password</div>
        <form method="POST" action="/password/reset">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group col-12 mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group col-12 mb-3">
                <label for="password">New Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="form-group col-12 mb-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
