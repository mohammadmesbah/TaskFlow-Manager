@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $project->name }}</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Description:</strong> {{ $project->description ?? 'N/A' }}</p>
            <p><strong>Department:</strong> {{ $project->department->name }}</p>
            <p><strong>Duration:</strong> 
                {{ Carbon\Carbon::parse($project->start_date)?->format('M d, Y') }} to 
                {{ Carbon\Carbon::parse($project->end_date)?->format('M d, Y') }}
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5>Team Members</h5>
        </div>
        <div class="card-body">
            <ul>
                @foreach($project->users as $user)
                    <li>{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Tasks</h5>
            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" 
               class="btn btn-sm btn-primary">
                Add Task
            </a>
        </div>
        <div class="card-body">
            @if($project->tasks->count())
                <ul class="list-group">
                    @foreach($project->tasks as $task)
                        <li class="list-group-item">
                            <a href="{{ route('tasks.show', $task) }}">
                                {{ $task->title }} ({{ $task->status }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No tasks yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection