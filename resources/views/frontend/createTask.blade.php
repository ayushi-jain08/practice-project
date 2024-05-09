@extends('frontend.layout')

@section('content')
    <div class="container mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create Task</div>

                        <div class="card-body">
                            <form id="createTaskForm" method="POST" action="{{ route('task.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="task" class="mt-3">Task</label>
                                    <input type="text" name="task" id="task" class="form-control ">
                                   <p></p>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Create Task</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script>
        $(document).ready(function() {
            $('#createTaskForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize(); 
                $.ajax({
                    type: 'POST',
                    url: "{{ route('task.store') }}",
                    data: formData,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success(response.message);  
                        $('#createTaskForm')[0].reset();
                        window.location.href = "{{ route('dashboard') }}"

                    },
                    error: function(jqXHR, exception) {
                        if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                            var errors = jqXHR.responseJSON.errors;
                            $('.error').removeClass('is-invalid').html("")
                            $("input[type=text], select").removeClass('is-invalid')
                            $.each(errors, function(key, value) {
                                $(`#${key}`).addClass('is-invalid').closest('.form-group')
                                    .find('p')
                                    .addClass('invalid-feedback').html(value);
                            })
                        }
                    }
                });
            });
        });
    </script>
@endsection
