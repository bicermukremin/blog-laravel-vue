<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentReplyNotification extends Notification
{
    use Queueable;
    public $reply;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply)
    {
       $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url=url('/'.$this->reply->comment->blog->slug);
        
        return (new MailMessage)
                    ->greeting('Merhabalar. Web Developer(Mükremin Biçer)')
                    ->line('Yapmış olduğunuz yoruma cevap geldi')
                    ->action('Cevabı Gör',$url)
                    ->line('Teşekkür ederiz bizi tercih ettiğiniz için!');
    }
    public function toDatabase($notifiable)
    {
        return[
            'description'=>$this->reply->description        ];
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
            //
        ];
    }
}