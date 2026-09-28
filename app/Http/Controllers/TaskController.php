<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::latest()->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        $task = Task::create([
            'title' => $request->title,
            'is_completed' => false
        ]);
        return response()->json($task, 201);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
