<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Department;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Project::class);
    }
    public function index()
    {
        $projects = Project::with(['department', 'users'])->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $departments = Department::all();
        $users = User::all();
        return view('projects.create', compact('departments', 'users'));
    }

    public function store(StoreProjectRequest $request)
    {
        $this->authorize('create', Project::class);
        $project = Project::create($request->validated());
        
        // Attach users if provided
        if ($request->has('users')) {
            $project->users()->attach($request->users);
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        $project->load(['department', 'users', 'tasks']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $departments = Department::all();
        $users = User::all();
        $currentUsers = $project->users->pluck('id')->toArray();
        
        return view('projects.edit', compact('project', 'departments', 'users', 'currentUsers'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $project->update($request->validated());
        
        // Sync users
        $project->users()->sync($request->users ?? []);

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    public function tasks(Project $project)
    {
        $tasks = $project->tasks()->with('user')->get();
        return view('projects.tasks', compact('project', 'tasks'));
    }
}
