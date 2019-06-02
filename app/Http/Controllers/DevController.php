<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\TaskDeveloper;
use App\Http\Requests\EditTask;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;

class DevController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $assignments = TaskDeveloper::where('developer_id', auth()->id())->get();
        return view('developer')->with([
            'assignments' => $assignments,
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

    public function changeStatus(Request $request)
    {
        $data = $request->only([
            'assignment_id',
            'task_status',
        ]);

        TaskDeveloper::where('id', $data['assignment_id'])->update([
            'task_status' => $data['task_status']
        ]);

        return response()->json([
            'message' => 'Success',
        ]);
    }
}
