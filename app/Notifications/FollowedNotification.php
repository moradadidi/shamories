<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class FollowedNotification extends Notification
{
    use Queueable;

    protected $follower;

    public function __construct($follower)
    {
        $this->follower = $follower;
    }

    public function via($notifiable)
    {
        return ['database'];  // Only using database notification
    }

    public function toDatabase($notifiable)
    {

        return [
            'follower_name' => $this->follower->name,
            'message' => "{$this->follower->name} followed you.",
            'image_url' => $this->follower->profile_image_url,
            'id' => $this->follower->id,
            'email' => $this->follower->email,
            


            

        ];
    }
}
