@extends('frontend.layout')

@section('content')
    <div class="container mt-3">
        <div class="container">
            @if (session('notification'))
                {{ session('notification.alert-type') }}('{{ session('notification.message') }}');
            @endif
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create Task</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('task.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="task" class="mt-3">Task</label>
                                    <input type="text" name="task" id="task"
                                        class="form-control @error('task')
                                is-invalid
                             @enderror">
                                    @error('task')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="number" value={{ Auth::user()->id }} name="user_id" id="user_id" hidden
                                        class="form-control">

                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Create Task</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
        };
    </script>
