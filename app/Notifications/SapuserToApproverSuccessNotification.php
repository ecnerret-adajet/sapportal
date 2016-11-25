<?php

namespace App\Notifications;

use App\Sapuser;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SapuserToApproverSuccessNotification extends Notification
{
    use Queueable;

    protected $sapuser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Sapuser $sapuser)
    {
        $this->sapuser = $sapuser;
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
                    ->subject('New Sap User Creation/Deletion Form')
                    ->greeting('Good day!')
                    ->line($this->sapuser->requested_by.' has submitted a sap user creation/deletion form under your approval')
                    ->action('Visit the portal now',  url('/sapusers/approver/create/'.$this->sapuser->id))
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
