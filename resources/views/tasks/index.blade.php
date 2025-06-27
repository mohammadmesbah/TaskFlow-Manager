@extends('layouts.app')

@section('title', 'Tasks')
@section('nav-title', 'Tasks')

@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.index') }}">Tasks</a>
    </li>
@endsection


@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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
                <td>{{ $task->project->name ?? 'N/A' }}</td>
                <td>
                    @if($task->users->isNotEmpty())
                        @foreach($task->users as $user)
                            <span class="badge bg-primary">{{ $user->name }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">No users assigned</span>
                    @endif
                </td>
                <td>{{ $task->status }}</td>
                <td>
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info">View</a>
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