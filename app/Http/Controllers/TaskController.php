<?php

namespace App\Http\Controllers;

use App\Models\{Task, Project, User};
use App\Http\Requests\{StoreTaskRequest, UpdateTaskRequest};
use App\Notifications\TaskAssignedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }
    public function index()
    {
        $tasks = Task::with(['project', 'user'])->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $users = User::all();
        return view('tasks.create', compact('projects', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        
        $this->authorize('create', Task::class);
        $task= Task::create($request->validated());
            if ($task->user) {
            $task->user->notify(new TaskAssignedNotification($task, $task->project));
            }
        return to_route('tasks.index') ->with('success', "Task '{$task->title}' created!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Ensure the Notifiable trait is used in the User model to access unreadNotifications
        if (request()->has('notification')) {
            $notification = Auth::user()->unreadNotifications->find(request('notification'));
            if ($notification) {
            $notification->markAsRead();
            }
        }
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $projects = Project::all();
        $users = User::all();
        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', Task::class);
        $task->update($request->validated());

        return to_route('tasks.index')
            ->with('success', "Task '{$task->title}' updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', Task::class);
        $task->delete();
        return redirect()->route('tasks.index')
            ->with('success', 'Task ' . $task->title . ' deleted successfully!');
    }
}
