@extends('frontend.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <div class="card mt-4" style="width: 35rem;">
            <div class="card-body">
                <h1 class="mt-3">Welcome, {{ $user->name }}!</h1>
                <p class="mt-3"><b>Email:</b> {{ $user->email }}</p>
                <a href="{{ route('edit.user', $user->id) }}" class="btn btn-primary">Edit Profile</a>

            </div>

        </div>
        <div>
            <a href="{{ route('page.task') }}" class="btn btn-success"> view your tasks</a>
            <a href="{{ route('task.create') }}" class="btn btn-primary">Create task</a>
        </div>
    </div>


    <!-- Display other user information as needed -->
@endsection
