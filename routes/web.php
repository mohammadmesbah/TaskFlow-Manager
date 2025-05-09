<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('departments', DepartmentController::class);
Route::resource('projects',ProjectController::class);
Route::resource('tasks',TaskController::class);

// Optional: Project-specific tasks route
Route::get('projects/{project}/tasks', [TaskController::class, 'index'])
    ->name('projects.tasks.index');