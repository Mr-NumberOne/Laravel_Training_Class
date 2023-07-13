<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GeneralNotification extends Notification
{
    use Queueable;
    public $tries = 2;
    public $timeout = 10;
    public $options;

    /**
     * Create a new notification instance.
     */
    public function __construct($options=[])
    {
        array_merge([
            'content'=>"",
            'action_url'=>env("APP_URL"),//when clicking on noti
            'btn_text'=>env("APP_NAME"),
            'methods'=>['database'],//mail, slack
            'image'=>env("DEFAULT_IMAGE_AVATAR"),
        ],$options);
        $this->options=$options;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $this->options['methods'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
            ->subject('You have a notification')
            ->greeting("Hey,there")
            ->line($this->options['content'])
            ->action($this->options['btn_text'], $this->options['action_url']);
    }

    public function toDatabase($notifiable){

        $content=$this->options['content'];
        return [
            'message'=>'<a href="'.$this->options['action_url'].'">'.$content.'</a>',
            'image'=>$this->options['image'],
            'content'=>$this->options['content'],
            'date'=>now(),
            'action_url'=>$this->options['action_url'],
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
