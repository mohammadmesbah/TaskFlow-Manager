@extends('layouts.app')

@section('title', 'All Projects')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Projects</h1>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Project
        </a>
    </div>

{{--     @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Team</th>
                        <th>Tasks</th>
                        <th>Dates</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>
                            <a href="{{ route('projects.show', $project) }}">
                                {{ $project->name }}
                            </a>
                        </td>
                        <td>{{ $project->department->name }}</td>
                        <td>{{ $project->users->count() }} members</td>
                        <td>{{ $project->tasks->count() }} tasks</td>
                        <td>
                            @if($project->start_date)
                                {{ Carbon\Carbon::parse($project->start_date)->format('M d') }} - 
                                {{ Carbon\Carbon::parse($project->end_date)?->format('M d, Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this project?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection