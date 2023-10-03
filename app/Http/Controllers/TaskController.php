<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function list(){
        $tasks = Task::with('user')->get();//get the user too!!
        return TaskResource::collection($tasks);
    }

    public function detail($id){
      $task = Task::with('user')->find($id);

      if (!$task)
          return response()->json(['message' => 'Task is not exist.'], 404);
  
      return new TaskResource($task);
    }

    public function store(Request $request){
        $task = Task::create($request->all());
        return response()->json(['message' => 'Success store task'], 201);
    }

    public function update(UpdateTaskRequest $request, $id){
        $task = Task::findOrFail($id);
        $task->update($request->all());
        return response()->json(['message' => 'Success update task'], 200);
    }

    public function destroy(Request $request, $id){
        $task = Task::find($id);

        if (!$task)
            return response()->json(['message' => 'Task is not exist.'], 404);

        $task->delete();
        return response()->json(['message' => 'Success delete task'], 200);
    }
}
