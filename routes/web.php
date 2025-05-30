<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/notifications/{notification}/read', function ($notificationId) {
    $notification = Auth::user()->unreadNotifications->findOrFail($notificationId);
    $notification->markAsRead();
    return response()->json(['success' => true]);
})->name('notifications.ajax.read');
