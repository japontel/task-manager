<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('category')
            ->where('user_id', Auth::user()->id)
            ->latest()
            ->get();

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::select('id', 'name')->get();
        $statuses = ['pending', 'in_progress', 'completed'];

        return Inertia::render('Tasks/Create', [
            'categories' => $categories,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        \App\Models\Task::create([
            'user_id' =>  Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with('category')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return Inertia::render('Tasks/Show', [
            'task' => $task,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        $categories = \App\Models\Category::select('id', 'name')->get();
        $statuses = ['pending', 'in_progress', 'completed'];

        return Inertia::render('Tasks/Edit', [
            'task' => $task,
            'categories' => $categories,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::where('user_id', Auth::id())->findOrFail($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('user_id', Auth::id())->findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
