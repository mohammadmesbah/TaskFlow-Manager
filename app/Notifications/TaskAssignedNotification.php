<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    public $task;
    public $project;

    /**
     * Create a new notification instance.
     */
    public function __construct($task, $project)
    {
        $this->task = $task;
        $this->project = $project;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->project->id,
            'project_name' => $this->project->name,
            'assigned_by' => Auth::user()->name,
        ];
    }

    /**
     * Get the database representation of the notification.
     */
    /* public function toDatabase(object $notifiable): array
    {
        return [
            'task_id' => $this->task->id,
            'task_title' => $this->task->title,
            'project_id' => $this->project->id,
            'project_name' => $this->project->name,
            'assigned_by' => auth()->user()->name,
        ];
    } */
}
