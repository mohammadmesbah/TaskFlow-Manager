@extends('layouts.app')
@section('title', 'Department Details')
@section('nav-title', 'Departments')

@section('nav-links')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('departments.index') }}">Departments</a>
    </li>
@endsection

@section('content')
<div class="container">
    <h1>{{ $department->name }}</h1>
    
    <div class="card">
        <div class="card-body">
            <p><strong>Description:</strong> {{ $department->description ?? 'N/A' }}</p>
            <p><strong>Manager:</strong> {{ $department->manager?->name ?? 'Not assigned' }}</p>
            <p><strong>Created:</strong> {{ $department->created_at->format('M d, Y') }}</p>
        </div>
    </div>
    
    <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection