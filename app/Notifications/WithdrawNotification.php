<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WithdrawNotification extends Notification
{
    use Queueable;

    public $withdraw;

    public function __construct($withdraw)
    {
        $this->withdraw = $withdraw;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->withdraw->user_id,
            'message' => $this->withdraw->user->username.' has made a Withdraw amount of : '.$this->withdraw->withdraw_amount,
            'url' => route('admin.withdraw.filter','pending')
        ];
    }
}
