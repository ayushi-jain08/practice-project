@extends('frontend.layout')
<style>
    .task-item {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #f9f9f9;
}
.task-item:hover {
    background-color: #e9e9e9;
}
</style>

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center">
      <h1 class="m-3">Tasks</h1>
        <a href="{{ route('task.create') }}" class="btn btn-primary">Create task</a>
     </div>
   <ul id="tasks-list"></ul>
    </div>

@endsection

@section('customJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            fetchTasks();

            function fetchTasks() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route("page.task") }}',
                    success: function(response) {
                        displayTasks(response.tasks);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

            function displayTasks(tasks) {
                var tasksList = $('#tasks-list');
                tasksList.empty(); // Clear existing tasks before appending new ones
                tasks.forEach(function(task) {
                    var taskStatus = task.status == 'done' ? 'Done' : 'Pending';
                    var statusClass = task.status == 'done' ? 'btn-success' : 'btn-danger';
                    var taskItem = $('<li class="task-item d-flex justify-content-between align-items-center"></li>');
                    var taskContent = $('<h3>' + task.task + '</h3>');
                    var statusButton = $('<button type="button" class="btn ' + statusClass + '">' + taskStatus + '</button>');
                    statusButton.on('click', function() {
                        updateTaskStatus(task.id, task.status == 'done' ? 'pending' : 'done');
                    });

                    taskItem.append(taskContent).append(statusButton);
                    tasksList.append(taskItem);
                });
            }

            // Function to update task status via AJAX
            function updateTaskStatus(id, newStatus) {
                var url = "{{ route('task.update', 'ID') }}";
                var newUrl = url.replace("ID", id);
                $.ajax({
                    type: 'PUT',
                    url: newUrl,
                    data: { status: newStatus },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        fetchTasks();
                    },
                    error: function(xhr, status, error) {
                        toastr.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endsection
