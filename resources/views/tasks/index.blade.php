@extends('layouts.app')

@section('title', 'Tasks')
@section('nav-title', 'Tasks')

@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.index') }}">Tasks</a>
    </li>
@endsection


@section('content')
<div class="container">
    <h1>Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Project</th>
                <th>Assigned To</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->project->name }}</td>
                <td>{{ $task->user->name }}</td>
                <td>{{ $task->due_date->format('M d, Y') }}</td>
                <td>
                    <span class="badge bg-{{ 
                        $task->status == 'completed' ? 'success' : 
                        ($task->status == 'in_progress' ? 'warning' : 'secondary') 
                    }}">
                        {{ ucfirst($task->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection