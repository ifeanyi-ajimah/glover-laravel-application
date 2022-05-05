<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestDeclinedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $trackRequest;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trackRequest, $user)
    {
        $this->trackRequest = $trackRequest;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('A request has been declined') 
        ->view('emails.declined');
    }
}
