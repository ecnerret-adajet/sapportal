<?php

namespace App\Notifications;

use App\SapuserApprover;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SapuserApproverToFunctionalSuccessNotification extends Notification
{
    use Queueable;

    protected $sapuserApprover;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(SapuserApprover $sapuserApprover)
    {
        $this->sapuserApprover = $sapuserApprover;
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
                    ->subject('New User Creation/Deletion Form : SAP Personnel')
                    ->greeting('Good day!')
                    ->line($this->sapuserApprover->name.' has submitted a user creation/deletion form under your approval')
                    ->action('Visit the portal now',  url('/sapusers/functional/create/'.$this->sapuserApprover->id))
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
