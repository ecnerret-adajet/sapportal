<?php

namespace App\Notifications;

use App\Functional;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MissingFunctionalToManagementFailedNotification extends Notification
{
    use Queueable;

    protected $functional;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Functional $functional)
    {
        $this->functional = $functional;
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
                    ->subject('Missing Authorization: Deny!')
                    ->greeting('Good day!')
                    ->line($this->functional->name.' has denied your missing authorization form.')
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
