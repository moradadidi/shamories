<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class LikedNotification extends Notification
{
    use Queueable;

    protected $liker;

    public function __construct($liker)
    {
        $this->liker = $liker;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'liker_name' => $this->liker->name,
            'message' => "{$this->liker->name} liked your post.",
            'image_url' => $this->liker->profile_image_url,
            'id' => $this->liker->id,
        ];
    }
}
