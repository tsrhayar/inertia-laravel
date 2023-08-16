<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::with('category', 'user')->paginate(5);
        $authUser = auth()->user();
        $isAdmin = auth()->user()->isAdmin;
        $categories = Category::has('tasks')->get();
        return Inertia::render('Tasks/Index', compact('tasks', 'categories', 'authUser'));
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

        $validatedData = $request->validate([
            'title' => ['required', 'min:4', 'max:50'],
            'body' => ['required', 'min:4', 'max:50'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        Task::create($validatedData);

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
        $categories = Category::all();
        return Inertia::render('Tasks/Edit', compact('categories', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:4', 'max:50'],
            'body' => ['required', 'min:4', 'max:50'],
            'category_id' => ['required'],
            'done' => []
        ]);

        if ($validator->fails()) {
            return back(303)
                ->withErrors($validator)
                ->withInput();
        } else {

            $task->update([
                'title' => $request->title,
                'body' => $request->body,
                'category_id' => $request->category_id,
                'done' => $request->done,
            ]);
            return back(303);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();

        return back(303);
    }

    public function getTasksByCategory(Category $category)
    {
        $categories = Category::has('tasks')->get();
        $tasks = $category->tasks()->with('category', 'user')->paginate(5);
        return Inertia::render('Tasks/Index', compact('tasks', 'categories'));
    }

    public function getTasksOrderedBy($column, $direction)
    {
        $categories = Category::has('tasks')->get();
        $tasks = Task::with('category', 'user')->orderBy($column, $direction)->paginate(5);
        return Inertia::render('Tasks/Index', compact('tasks', 'categories'));
    }

    public function getTasksByTerm(Request $request)
    {
        $categories = Category::has('tasks')->get();
        $tasks = Task::with('category', 'user')
            ->where('title', 'like', "%{$request->term}%")
            ->paginate(5);
        return Inertia::render('Tasks/Index', compact('tasks', 'categories'));
    }
}