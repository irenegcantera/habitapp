<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MensajeNotification extends Notification
{
    use Queueable;

    protected $piso_id;
    // protected $from_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(int $piso_id)
    {
        $this->piso_id = $piso_id;
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
                    ->subject('Mensaje nuevo recibido')
                    ->line('Ha recibido un nuevo mensaje con referencia del piso '.$this->piso_id.'.')
                    ->action('Ver mensaje', url('/'))
                    ->line('Gracias por utilizar nuestra aplicación.');
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
