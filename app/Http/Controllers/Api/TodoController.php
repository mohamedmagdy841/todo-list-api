<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $todos = Todo::where('user_id', auth()->id())->get();

        if($todos->isEmpty())
        {
            return ApiResponse::sendResponse([], 'No todos available');
        }

        return ApiResponse::sendResponse(TodoResource::collection($todos), 'Data retrieved');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            $todo = Todo::create($data);

            return ApiResponse::sendResponse(new TodoResource($todo), 'Created successfully', 201);

        } catch (\Exception $e) {
            return ApiResponse::sendResponse([], 'An error occurred while creating the todo. ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return ApiResponse::sendResponse([], 'Todo not found.',404);
        }

        if ($todo->user_id != auth()->id()) {
            return ApiResponse::sendResponse([], 'Unauthorized.', 403);
        }

        return ApiResponse::sendResponse(new TodoResource($todo), 'Todo retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, string $id)
    {
        $todo = Todo::find($id);

        if(!$todo)
        {
            return ApiResponse::sendResponse([], 'Todo not found', 404);
        }

        if($todo->user_id != auth()->id() )
        {
            return ApiResponse::sendResponse([], 'Unauthorized.', 403);
        }


        $data = $request->validated();

        $todo->update($data);

        return ApiResponse::sendResponse(new TodoResource($todo), 'Updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);

        if(!$todo)
        {
            return ApiResponse::sendResponse([], 'Todo not found', 404);
        }

        if($todo->user_id != auth()->id())
        {
            return ApiResponse::sendResponse([], 'Unauthorized.', 403);
        }

        $todo->delete();
        return ApiResponse::sendResponse([], [], 204);
    }


}
