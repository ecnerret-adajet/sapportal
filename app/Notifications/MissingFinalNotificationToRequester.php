<?php

namespace App\Notifications;

use App\Missing;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MissingFinalNotificationToRequester extends Notification
{
    use Queueable;

    protected $missing;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Missing $missing)
    {
        $this->missing = $missing;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->success()
                    ->subject('Missing Notificaiton Confirmation')
                    ->greeting('Good day!')
                     ->line('This is to confirm that your request form is now successfully created')
                    ->line('Thank you, have a nice day!');
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
