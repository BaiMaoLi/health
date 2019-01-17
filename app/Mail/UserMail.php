<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Controller;


class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data,$files;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$files)
    {
        $this->data=$data;
        $this->files=$files;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data=$this->data;
        $files=$this->files;
        $emailView=$this->view('admin.email.view')->with(['title'=>$data['title'],'content'=>$data['content']])->from(config('mail.from.address'),'PTI Health');;
        $emailView->subject($data['title'])->replyTo('aaron@knockoutmi.com', 'Reply From the customer of myptihealth.com');

        if($files!='none') {
            foreach($files as $file) {
                $emailView->attach($file->getRealPath(), array(
                        'as' => $file->getClientOriginalName(), // If you want you can chnage original name to custom name
                        'mime' => $file->getMimeType())
                );
            }
        }
        return $emailView;
    }
}
