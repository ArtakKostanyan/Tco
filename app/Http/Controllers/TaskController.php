<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDeveloper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\EditTask;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('manager')->with([
            'tasks'         => auth()->user()->tasks,
            'assignedTasks' => TaskDeveloper::where('manager_id', auth()->id())->get(),
            'developers'    => User::whereHas('roles', function ($query) {
                $query->where('name', 'developer');
            })->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTask $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        $taskData = $request->only([
            'title',
            'deadline',
            'description',
        ]);

        auth()->user()->tasks()->create($taskData);

        return redirect()->action('TaskController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditTask $request
     * @param Task     $task
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(EditTask $request, Task $task)
    {
        return view('task.edit')->with([
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTask $request
     * @param  Task       $task
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTask $request, Task $task)
    {
        $taskData = $request->only([
            'title',
            'deadline',
            'description',
        ]);
        $task->update($taskData);

        return redirect()->action('TaskController@index');
    }

    public function assignTo(Request $request)
    {
        TaskDeveloper::create([
            'developer_id' => $request->get('developer_id'),
            'task_id'      => $request->get('task_id'),
            'manager_id'    => auth()->id(),
            'task_status'  => Task::ASSIGNED,
        ]);

        return response()->json([
            'message' => 'Success',
        ]);
    }
}
