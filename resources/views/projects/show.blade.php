@extends('layouts.app')
@section('title', 'Project Details')
@section('nav-title', 'Projects')

@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
    </li>
@endsection

@section('content')
<div class="container">
    <h1>{{ $project->name }}</h1>
    <div class="row">
        <!-- Sidebar: Project Details & Team Members -->
        <div class="col-md-4 mb-4">
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Project Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> {{ $project->description ?? 'N/A' }}</p>
                    <p><strong>Department:</strong> {{ $project->department->name }}</p>
                    <p><strong>Duration:</strong><br>
                        <span class="badge bg-light text-dark">
                            {{ Carbon\Carbon::parse($project->start_date)?->format('M d, Y') }}
                            &mdash;
                            {{ Carbon\Carbon::parse($project->end_date)?->format('M d, Y') }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Team Members</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($project->users as $user)
                            <li class="list-group-item">
                                <i class="bi bi-person-circle me-2"></i>{{ $user->name }}
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No team members assigned.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <!-- Main Content: Tasks -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-secondary text-white">
                    <h5 class="mb-0">Tasks</h5>
                    <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" 
                       class="btn btn-sm btn-light">
                        <i class="bi bi-plus-circle"></i> Add Task
                    </a>
                </div>
                <div class="card-body">
                    @if($project->tasks->count())
                        <ul class="list-group">
                            @foreach($project->tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <a href="{{ route('tasks.show', $task) }}" class="fw-bold text-decoration-none">
                                            {{ $task->title }}
                                        </a>
                                        <span class="badge bg-{{ $task->status === 'completed' ? 'success' : ($task->status === 'in progress' ? 'warning' : 'secondary') }} ms-2">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </div>
                                    <small class="text-muted">
                                        Due: {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'N/A' }}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No tasks yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection