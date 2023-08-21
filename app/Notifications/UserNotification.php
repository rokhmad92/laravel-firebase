<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Kutia\Larafirebase\Facades\Larafirebase;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    protected $fcmTokens;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public function __construct($title, $message, $fcmTokens)
    // {
    //     $this->title = $title;
    //     $this->message = $message;
    //     $this->fcmTokens = $fcmTokens;
    // }

    public function __construct($fcmTokens)
    {
        $this->fcmTokens = $fcmTokens;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        return Larafirebase::withTitle('Selamat Datang')
            ->withBody("Terima kasih sudah mendaftar di aplikasi kami!")
            ->withIcon('https://seeklogo.com/images/F/firebase-logo-402F407EE0-seeklogo.com.png')
            ->withSound('default')
            ->withPriority('high')
            ->sendNotification($this->fcmTokens);
    }
}
