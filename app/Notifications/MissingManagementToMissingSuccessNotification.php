<?php

namespace App\Notifications;

use App\Management;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MissingManagementToMissingSuccessNotification extends Notification
{
    use Queueable;

    protected $management;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Management $management)
    {
        $this->management = $management;
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
                    ->subject('Missing Authorization: Approved!')
                    ->greeting('Congratulations!')
                    ->line($this->management->name.' has approved your missing authorization form.')
                    ->grant()
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
