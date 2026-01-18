<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = url(route('admin.password.reset', $this->token, false));

        return (new MailMessage)
            ->subject('Admin Password Reset Request')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You are receiving this email because we received a password reset request for your admin account.')
            ->action('Reset Password', $url)
            ->line('This reset link will expire in 60 minutes.')
            ->line('If you did not request a password reset, no further action is required.')
            ->salutation('— Buggxit Couture Admin Team');
    }
}