<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function getTaskPage(){
        $tasks = Task::all();
        return view('frontend.Task', compact('tasks'));
    }

    public function CreateTaskPage(){
        return view('frontend.createTask');
    }
    public function addTask(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'task' => 'required|string',
    ]);

    Task::create([
        'user_id' => $request->user_id,
        'task' => $request->task,
        'status' => 'pending', // Default status
    ]);
    $notification = [
        'alert-type' => 'success',
        'message' => 'Task created successfully.',
    ];
    return redirect()->route('page.task')->with($notification);
}

public function changeStatus(Request $request)
{
    $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'status' => 'required|in:pending,done',
    ]);

    $task = Task::findOrFail($request->task_id);
    $task->status = $request->status;
    $task->save();

    $message = $request->status == 'done' ? 'Marked task as done' : 'Marked task as pending';

    $notification = [
        'alert-type' => 'success',
        'message' => 'Task status updated successfully.',
    ];
    return redirect()->route('page.task')->with($notification);
}

}
