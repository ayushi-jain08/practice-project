@extends('frontend.layout')

@section('content')
    <div>
        <h2 class="mt-2 mb-4">Edit User</h2>
        <form method="POST" action="{{ route('edit.store') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name')
            is-invalid
         @enderror"
                    value="{{ $user->name }}" id="name" aria-describedby="nameHelp" name="name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control @error('email')
            is-invalid
         @enderror"
                    value="{{ $user->email }}" id="email" aria-describedby="emailHelp" name="email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
            <p><b style="color: rgb(8, 0, 255);">Already have an account? </b><a href="{{ route('login.user') }}">Login</a>
            </p>
        </form>
    </div>
@endsection
