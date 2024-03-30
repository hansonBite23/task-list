<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $tasks = Task::all();
        return view('task.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required'

        ]);

        $taskInsert = Task::firstOrCreate([
            'task' => $request->task,
            'taskDone' => '0'
        ]);
        if ($taskInsert->wasRecentlyCreated) {
            return redirect()->route('task.index')->with('store', "Task Successfully Added");
        } else {
            return redirect()->route('task.index')->with('exist', "Task Already Exists");
        }
    }

    public function doneTask(string $id)
    {
        Task::where('id', $id)->update([
            'taskDone' => 1
        ]);

        return  redirect()->route('task.index');
    }

    public function undoTask(string $id)
    {
        Task::where('id', $id)->update([
            'taskDone' => 0
        ]);

        return  redirect()->route('task.index');
        // dd($id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::where('id', $id)->delete();

        return to_route('task.index')->with('deleted', "Task Successfully Deleted");
    }
}
