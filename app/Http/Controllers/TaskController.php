<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    //
    public function index()
    {

        return Task::paginate(10);
    }

    public function show($id)
    {
        $task = Task::find($id);
        if (!empty($task)) {
            return response()->json(["message" => null, "data" => $task,], 200);
        }
        return response()->json(["message" => 'NOT FOUND', 'data' => null], 404);
    }

    public function store(StoreTaskRequest $request)
    {


        $task = Task::create($request->all());

        return response()->json(["message" => null, "data" => $task], 201);
    }

    public function update(StoreTaskRequest $request, $id)
    {

        $task = Task::find($id);
        if (!empty($task)) {
            $task->update($request->all());
            return response()->json(["message" => null, "data" => $task], 200);
        }


        return response()->json($task, 200);
    }

    public function delete($id)
    {
        $task = Task::find($id);
        if (!empty($task)) {
            $task->delete();
            return response()->json(["message" => "DELETED", "data" => null], 202);
        }
        return response()->json(["message" => 'NOT FOUND', 'data' => null], 404);
    }
}
