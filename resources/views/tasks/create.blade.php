@extends('layouts.app')

@section('title', 'Create Task')
@section('nav-title', 'Tasks')

@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.index') }}">Tasks</a>
    </li>
@endsection

@section('content')
<div class="container">
    <h1>Create Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title *</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                   id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date *</label>
            <input type="date" class="form-control @error('due_date') is-invalid @enderror" 
                   id="due_date" name="due_date" value="{{ old('due_date') }}" required>
            @error('due_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status *</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="project_id" class="form-label">Project *</label>
            <select class="form-select @error('project_id') is-invalid @enderror" id="project_id" name="project_id" required>
                <option value="">Select Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
            @error('project_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="users" class="form-label">Assigned To *</label>
            <select class="form-select @error('users') is-invalid @enderror" id="users" name="users[]" multiple required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ (collect(old('users'))->contains($user->id)) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple users.</small>
            @error('users')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection