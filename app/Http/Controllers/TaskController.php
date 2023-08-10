<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::with('category')->paginate(5);
        $categories = Category::has('tasks')->get();
        return Inertia::render('Tasks/Index', compact('tasks', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return Inertia::render('Tasks/Create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        //
        // if ($request->validated()) {
        //     Task::create([
        //         'title' => $request->title,
        //         'body' => $request->body,
        //         'category_id' => $request->category_id,
        //     ]);

        //     return redirect()->route('home')->with([
        //         'message' => 'Task created successfully',
        //         'class' => 'alert alert-success'
        //     ]);
        // }

        Task::create($request->validate([
            'title' => ['min:4', 'required', 'max:50'],
            'body' => ['min:4', 'required', 'max:50'],
            'category_id' => ['required'],
        ]));

        return to_route('tasks.index')->with([
            'message' => 'Task created successfully',
            'class' => 'alert alert-success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function getTasksByCategory(Category $category)
    {
        $categories = Category::has('tasks')->get();
        $tasks = $category->tasks()->with('category')->paginate(5);
        return Inertia::render('Tasks/Index', compact('tasks', 'categories'));

    }

    public function getTasksOrderedBy($column, $direction)
    {
        $categories = Category::has('tasks')->get();
        $tasks = Task::with('category')->orderBy($column, $direction)->paginate(5);
        return Inertia::render('Tasks/Index', compact('tasks', 'categories'));

    }
}