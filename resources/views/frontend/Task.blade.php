@extends('frontend.layout')

@section('content')
    <div class="container mt-4">
        <a href="{{ route('task.create') }}" class="btn btn-primary">Create task</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Tasks</div>

                    <div class="card-body">

                        @foreach ($tasks as $task)
                            <div class="task d-flex justify-content-between align-items-center">
                                <div>
                                    <h4><b>{{ $task->task }}</b></h4>
                                    <p><b>Status:</b> {{ ucfirst($task->status) }}</p>
                                </div>
                                <form method="POST" action="{{ route('task.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                                    <input type="hidden" name="status"
                                        value="{{ $task->status === 'pending' ? 'done' : 'pending' }}">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        {{ $task->status === 'pending' ? 'Mark as Done' : 'Mark as Pending' }}
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
