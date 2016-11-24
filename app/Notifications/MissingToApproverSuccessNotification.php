<?php

namespace App\Notifications;

use App\Missing;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MissingToApproverSuccessNotification extends Notification
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
                    ->subject('New Missing Authorization Form')
                    ->greeting('Good day!')
                    ->line($this->missing->requested_by.' has submitted a missing authorization under your approval')
                    ->action('Visit the portal now',  url('/missings/approver/create/'.$this->missing->id))
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
