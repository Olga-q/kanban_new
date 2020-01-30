<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Task;

class TaskController extends Controller
{
    public function show()
    {
        $tasks = Task::all();
        return $tasks->toJson();
    }

    public function add(Request $request)
    {
        $task = new Task;
        $task->task = $request->task;
        $task->notes = $request->notes ?? '';
        $task->user_add_id = Auth::id();
        $task->user_do_id = $request->user ?? Auth::id();
        // $task->status = 2;
        
        $task->save();
        
        return json_encode(['id' => $task->id,]);
    }
}