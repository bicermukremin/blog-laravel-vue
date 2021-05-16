<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    public $token;

/**
 * Create a new notification instance.
 *
 * @return void
 */
public function __construct($token)
{
    $this->token = $token;
}

/**
 * Get the notification's delivery channels.
 *
 * @param  mixed  $notifiable
 * @return array
 */
public function via($notifiable)
{
    return ['mail'];
}

/**
 * Build the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    return (new MailMessage)
         ->greeting('Merhabalar. Web Developer(Mükremin Biçer)')
        ->line('Şifre değişim isteğinde bulunduğunuz için bu mail gönderilmiştir.') // Here are the lines you can safely override
        ->action('Şifre Sıfırla', url('password/reset', $this->token))
        ->line('Şifre değişim istemiyorsanız herhangi bir şey yapmanıza gerek yoktur.');
}
}
