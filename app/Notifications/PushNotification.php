<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Notifications\Messages\MailMessage;

class PushNotification extends Notification
{
    use Queueable;
    protected $title;
    protected $isi;
    protected $icon;
    protected $fcmTokens;
    /**
     * Create a new notification instance.
     */
    public function __construct($title, $isi, $fcmTokens)
    {
        $this->title = $title;
        $this->isi = $isi;
        $this->fcmTokens = $fcmTokens;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        return Larafirebase::withTitle($this->title)
            ->withBody($this->isi)
            ->withIcon('https://seeklogo.com/images/F/firebase-logo-402F407EE0-seeklogo.com.png')
            ->withSound('default')
            ->withPriority('high')
            ->sendNotification($this->fcmTokens);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
