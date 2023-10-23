<?php

namespace App\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DatabaseNotification extends Notification
{

    public $subject;
    public $content;

    public function __construct($subject, $content)
    {
        $this->subject = $subject;
        $this->content = $content;
    }

    public function toDatabase($notifiable)
    {
        return [
            'subject' => $this->subject,
            'content' => $this->content,
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'subject' => $this->subject,
            'content' => $this->content,
        ];
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }
}
