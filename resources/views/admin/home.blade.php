@extends('../layouts.app')

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
        <p class="heading">Hello, {{auth()->user()->name}}</p>

        <div class="table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>s/n</th>
                        <th>users</th>
                        <th>roles</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td> {{ $user->name }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            @if ($user->role->name !== 'super-admin')
                                <div class="btns">
                                    <form method="POST" action="/create-admin/{{$user->id}}">
                                        @csrf

                                            <button type="submit"
                                                class="btn-sm btn-primary me-2">
                                                Make Admin
                                            </button>
                                        </form>
                                        <form method="POST" action="/remove-admin/{{$user->id}}">
                                            @csrf
                                            <button type="submit"
                                            class="btn-sm btn-warning me-2">
                                            Remove Admin
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
