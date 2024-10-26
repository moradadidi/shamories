<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class CommentedNotification extends Notification
{
    use Queueable;

    protected $commenter;
    protected $commentContent;

    public function __construct($commenter, $commentContent)
    {
        $this->commenter = $commenter;
        $this->commentContent = $commentContent;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'commenter_name' => $this->commenter->name,
            'message' => "{$this->commenter->name} commented on your post: '{$this->commentContent}'",
            'image_url' => $this->commenter->profile_image_url,
            'id' => $this->commenter->id,
        ];
    }
}
