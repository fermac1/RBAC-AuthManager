@extends('layouts.app')

@section('content')

    @if(session('success'))
    <div class="alert alert-success fade-out-message">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="main-container">
        {{-- <div class="heading">Home</div> --}}
        <p class="heading">Hello, {{auth()->user()->name}}</p>

        <div class="table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>s/n</th>
                        <th>users</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td> {{ $user->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
