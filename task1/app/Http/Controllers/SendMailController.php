<?php

namespace App\Http\Controllers;
use Mail;
use App\Mail\audioMail;
use App\address2;
use App\Category1;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    public  function sendemail(request $request)
    {
        $ii=0;
        $data=array();
        for($ii=0;$ii<4;$ii++)
        {
            $data[$ii]=0;
        }

//       $datas1=Category1::where('statues','checked')->get();
//        $i=0;
//        foreach ($datas1 as $data1){
//
//            $email[$i]=$data1->email;
//            $phone[$i]=$data1->phone;
//            $subject="Hello!";
//
//            $data[0]=$phone[$i];
            $data[1]=$request->input('name2');
            $data[2]=$request->input('address2');
            $data[3]=$request->input('phone2');
            $dd=new audioMail('','hello');
            Mail::to('baimaoli9@gmail.com')->send($dd);

//            $i++;
//        }
//        $data2=address2::where()->get();
    }
}
