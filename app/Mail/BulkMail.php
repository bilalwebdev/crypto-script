<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($subject, $html)
    {
        $this->subject = $subject;
        $this->html = $html;
    }

    public function build()
    {
        return $this->markdown('emails.template_email')->subject($this->subject)->with('html', $this->html);
    }
}
