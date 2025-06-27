<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ProjectAssignedNotification extends Notification
{
    use Queueable;

    public $project;

    /**
     * Create a new notification instance.
     */
    public function __construct($project)
    {
        $this->project = $project;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'project_id' => $this->project->id,
            'project_name' => $this->project->name,
            'assigned_by' => optional(Auth())->name,
        ];
    }
}
