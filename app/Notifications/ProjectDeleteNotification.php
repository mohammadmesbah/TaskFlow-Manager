<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProjectDeleteNotification extends Notification
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
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'project_id' => $this->project->id,
            'project_name' => $this->project->name,
            'message' => "A project you were assigned to has been deleted.",
        ];
    }
}
