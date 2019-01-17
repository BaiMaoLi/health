<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class audioMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public function __construct($data,$subject)
    {
        $this->data=$data;
        $this->subject=$subject;
    }

    public function build()
    {
        return $this->view("email.sendmail",["data"=>$this->data])->subject($this->subject);
    }
}
