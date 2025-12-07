<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();  //request()->user()

        $tasks = Task::where('user_id', $user->id)->paginate(2);

        return TaskResource::collection($tasks);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {

        Task::create([
            'name' => $request->name,
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'message' => 'Task created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
       // $this->authorize('view', $task);
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //$this->authorize('update', $task);
        $validated = $request->validate([
            'name' => 'required',

        ]);

        $task->update($validated);

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //$this->authorize('delete', $task);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }
}
