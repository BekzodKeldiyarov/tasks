<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $date = $request->input('date');


        $tasks = Task::filterByStatus($status)->filterByDate($date)->paginate(10);


        return response()->json($tasks);
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

        return response()->json(["success" => true, "message" => null, "data" => $task], 201);
    }

    public function update(StoreTaskRequest $request, $id)
    {

        $task = Task::find($id);
        if (!empty($task)) {
            $task->update($request->all());
            return response()->json(["success" => true, "message" => null, "data" => $task], 200);
        }


        return response()->json($task, 200);
    }

    public function delete($id)
    {
        $task = Task::find($id);
        if (!empty($task)) {
            $task->delete();
            return response()->json(["message" => "DELETED", "data" => null], 200);
        }
        return response()->json(["message" => 'NOT FOUND', 'data' => null], 404);
    }
}
