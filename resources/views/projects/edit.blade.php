@extends('layouts.app')

@section('title', 'Edit Project')
@section('nav-title', 'Projects')

@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
    </li>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit Project: {{ $project->name }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Project Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $project->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" 
                               id="start_date" name="start_date" 
                               value="{{ old('start_date', Carbon\Carbon::parse($project->start_date)?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" 
                               id="end_date" name="end_date" 
                               value="{{ old('end_date', Carbon\Carbon::parse($project->end_date)?->format('Y-m-d')) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="department_id" class="form-label">Department *</label>
                    <select class="form-select" id="department_id" name="department_id" required>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" 
                                {{ (old('department_id', $project->department_id) == $department->id) ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Team Members</label>
                    <div class="row">
                        @foreach($users as $user)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="user_{{ $user->id }}" name="users[]" 
                                       value="{{ $user->id }}" 
                                       {{ in_array($user->id, old('users', $currentUsers)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_{{ $user->id }}">
                                    {{ $user->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Project</button>
                <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection