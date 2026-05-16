<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProgramNotification extends Notification
{
    use Queueable;

    protected $program_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($program_data)
    {
        $this->program_data = $program_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'program_id'   => $this->program_data['program_id'],
            'program_name' => $this->program_data['program_name'],
            'org_name'     => $this->program_data['org_name'],
            'status'       => $this->program_data['status'],
            'type'         => $this->program_data['type'] ?? 'program_approval'
        ];
    }
}
