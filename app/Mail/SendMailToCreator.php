<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailToCreator extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status, $overtime)
    {
        $this->status = $status;
        $this->overtime = $overtime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->status == 2) {
            return $this->subject('Request OT Accepted')->view('mail.sendMailToCreator')->with([
                'overtime' => $this->overtime,
                'statusApprove' => 'denied'
            ]);
        } else {
            return $this->subject('Request OT Denied')->view('mail.sendMailToCreator')->with([
                'overtime' => $this->overtime,
                'statusApprove' => 'accepted'
            ]);
        }
    }
}
