@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Task Details</h2>
            <div>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit Task</a>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Title</h5>
                    <p>{{ $task->title }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Status</h5>
                    <span class="badge bg-{{
                        $task->status == 'completed' ? 'success' :
                        ($task->status == 'in_progress' ? 'warning' : 'secondary')
                    }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Project</h5>
                    <a href="{{ route('projects.show', $task->project) }}">
                        {{ $task->project->name }}
                    </a>
                </div>
                <div class="col-md-6">
                    <h5>Assigned To</h5>
                    <p>{{ $task->user->name }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Due Date</h5>
                    <p>{{ $task->due_date->format('F j, Y') }}</p>
                    <p class="text-sm text-{{
                        $task->due_date->isPast() ? 'danger' : 'muted'
                    }}">
                        {{ $task->due_date->isPast() ? 'Overdue' : 'Due in '.$task->due_date->diffForHumans() }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Last Updated</h5>
                    <p>{{ $task->updated_at->format('F j, Y \a\t g:i a') }}</p>
                </div>
            </div>

            <div class="mb-3">
                <h5>Description</h5>
                <div class="border p-3 rounded bg-light">
                    {!! nl2br(e($task->description)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection