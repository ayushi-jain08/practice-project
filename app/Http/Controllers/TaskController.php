<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function getTaskPage(){
        $user = Auth::user();
        $tasks = $user->tasks;
       
        return response()->json(['tasks' => $tasks]);
    }

    public function CreateTaskPage(){
        return view('frontend.createTask');
    }
    public function addTask(Request $request)
{
    $request->validate([
        'task' => 'required|string',
    ]);
$user = auth()->user();
    Task::create([
        'user_id' => $user->id,
        'task' => $request->task,
        'status' => 'pending', // Default status
    ]);
    
    return response()->json(['message' => 'Task created successfully']);
}

public function changeStatus($id,Request $request)
{
    $request->validate([
        'status' => 'required|in:pending,done',
    ]);

    $task = Task::findOrFail($id);
    $task->status = $request->status;
    $task->save();

    $message = $request->status == 'done' ? 'Marked task as done' : 'Marked task as pending';

    return response()->json(['message' => 'Task status updated successfully']);
}

}
