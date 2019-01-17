<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home');
    }
    public function sendMail() {
    	Mail::send([],[],function($message)
	{
		$message->to('baimaoli9@gmail.com');
		$message->setBody('Message');
		$message->subject('Subject');
	});
    }

    public function simplemail(){
        $list=\Mail::raw('helloworld',function($message){
            $message->to('baimaoli9@gmail.com');
            $message->subject('Mailgun Testing');
        });
        print_r($list);
        }
}


