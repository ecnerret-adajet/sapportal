<?php

namespace App\Notifications;

use App\SapuserFunctional;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SapuserFunctionalToBasisFailedNotification extends Notification
{
    use Queueable;

    protected $sapuserFunctional;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(SapuserFunctional $sapuserFunctional)
    {
        $this->sapuserFunctional = $sapuserFunctional;
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
                     ->subject('User Creation/Deletion Denied!')
                    ->greeting('Good day!')
                    ->line($this->sapuserFunctional->name.' has denied your user creation/deletion form.')
                    ->failed()
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
