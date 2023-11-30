<?php

namespace App\Notifications;

use App\Helpers\Helper\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DepositNotification extends Notification
{
    use Queueable;

    public $deposit, $type, $payment_type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($deposit, $type, $payment_type)
    {
        $this->deposit = $deposit;

        $this->type = $type;
        $this->payment_type = $payment_type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {

        if($this->payment_type === 'payment'){
            return [
                'user_id' => $this->deposit->user_id,
                'message' => $this->deposit->user->username.' has made a Payment Request amount of : '.Helper::formatter($this->deposit->amount),
                'url' => route('admin.payments.index', $this->type)
            ];
        }


        return [
            'user_id' => $this->deposit->user_id,
            'message' => $this->deposit->user->username.' has made a deposit amount of : '.Helper::formatter($this->deposit->amount),
            'url' => route('admin.deposit', $this->type)
        ];
    }
}
