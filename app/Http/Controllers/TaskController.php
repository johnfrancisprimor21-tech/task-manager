<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller{

    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
 }

    public function create()
    {
        return view('tasks.create');
              }

    public function store(Request $request)
    {
    
                     $request->validate([
             'task_name' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
                           ]);

        $task = new Task();
        $task->task_name = $request->task_name;
         $task->description = $request->description;
        $task->due_date = $request->due_date;
           $task->status = 'Pending'; // new tasks always start as pending
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task added!');
                           }

    public function edit(Task $task)
    {
    return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
                     'task_name' => 'required|max:255',
            'description' => 'nullable',
                'due_date' => 'nullable|date',
                    'status' => 'required|in:Pending,Completed',
        ]);
    $task->task_name = $request->task_name;
           $task->description = $request->description;
  $task->due_date = $request->due_date;
      $task->status = $request->status;
              $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task updated!');
}

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }

    // this one just flips pending <-> completed when you click the button on the list
    public function updateStatus(Task $task)
    {    if ($task->status == 'Pending') {
            $task->status = 'Completed';
        }
        else 
            {
            $task->status = 'Pending';
        }

        $task->save();

                    return redirect()->route('tasks.index')->with('success', 'Status updated!');
    }
}
