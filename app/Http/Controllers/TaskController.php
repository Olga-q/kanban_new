<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Task;
use \App\User;

class TaskController extends Controller
{
    public function show()
    {
        $tasksDB = Task::all();
        $tasks = [];
        $i = 0;
        foreach ($tasksDB as $taskDB) {
            $tasks[$i] = ['id' => $taskDB->id,
                        'task' => $taskDB->task,
                        'notes' => $taskDB->notes,
                        'userAdd' => User::where('id', $taskDB->user_add_id)->get()[0]->name,
                        'userDo' => User::where('id', $taskDB->user_do_id)->get()[0]->name,
                        'status' => $taskDB->status,
                        'priority' => $taskDB->priority];
            $i++;
        }
        return json_encode($tasks);
    }

    public function add(Request $request)
    {
        $lastPriority = Task::where('status', 1)->max('priority') ?? 0;
        $task = new Task;
        $task->task = $request->task;
        $task->notes = $request->note ?? '';
        $task->user_add_id = Auth::id();
        $task->user_do_id = $request->user ?? Auth::id();
        $task->priority = $lastPriority + 1;
        
        $task->save();
        
        $userDo = User::find($task->user_do_id)->name;
        $userAdd = User::find($task->user_add_id)->name;
        return json_encode(['id' => $task->id,
                'note' => $task->notes,
                'userDo' => $userDo,
                'userAdd' =>$userAdd]);
    }

    public function del(Request $request) 
    {
        Task::destroy($request->id);
        return json_encode([]);
    }

    public function changeStatus(Request $request)
    {
        $task = Task::find($request->id);
        $task->status = $request->status;
        $task->save();
        return json_encode([]);
    }

    private function updatePriority($priority)
    {
        $elements = [];
        foreach ($priority as $i => $value) {
            $elements[] = [
                'priority' => $i + 1,
                'id' => $value
            ];
        }
        $sql = "UPDATE " . $this->table . " SET priority=:priority WHERE id=:id";
        return $this->dbArr($sql, $elements);
    }

    public function changePriority(Request $request)
    {

        $request->colomn1;
        
    }

    
}