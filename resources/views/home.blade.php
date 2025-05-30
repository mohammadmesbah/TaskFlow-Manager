@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row g-4">
                        <!-- Projects Section -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <i class="fas fa-tasks fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">{{ __('My Projects') }}</h5>
                                    <p class="card-text">
                                        <i class="fas fa-tasks me-2"></i>
                                        {{ __('View and manage your assigned projects') }}
                                    </p>
                                    @if ($projects->isEmpty())
                                        <div class="text-center py-4">
                                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">{{ __('No projects assigned yet') }}</p>
                                        </div>
                                    @else
                                        <div class="list-group list-group-flush">
                                            @foreach ($projects as $project)
                                                <a href="{{ route('projects.show', $project) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-1">{{ $project->name }}</h6>
                                                        <small class="text-muted">
                                                            <i class="fas fa-building me-1"></i>
                                                            {{ $project->department->name ?? 'N/A' }}
                                                        </small>
                                                    </div>
                                                    <span class="badge bg-{{ $project->status === 'completed' ? 'success' : ($project->status === 'in_progress' ? 'warning' : 'secondary') }}">
                                                        {{ ucfirst($project->status) }}
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Departments Section -->
                        <div class="col-md-6">
                            <a href="{{ route('departments.index') }}" class="text-decoration-none">
                                <div class="card h-100 text-center">
                                    <div class="card-body">
                                        <i class="fas fa-building fa-3x text-secondary mb-3"></i>
                                        <h5 class="card-title">{{ __('Departments') }}</h5>
                                        <p class="card-text">
                                            <i class="fas fa-building me-2"></i>
                                            {{ __('View and manage departments') }}
                                        </p>
                                        {{--  --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
