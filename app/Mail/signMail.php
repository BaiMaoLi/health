<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class signMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailView=$this->view('user.signup_email')->from(config('mail.from.address'),'PTI Health');;
        $emailView->subject('Thank you for registering on PTI Health!')->replyTo('aaron@knockoutmi.com', 'Reply From the customer of myptihealth.com');
        return $emailView;
    }
}
