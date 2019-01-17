<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Notifications\UserAlert;
use Illuminate\Support\Facades\File;
use App\Mail\UserMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{

    public function home(){
        $users=User::all();
        return view("admin.email.home",compact('users'));
    }

    public function edit_email(Request $request){
        $selected_indicies=$request->input('selected-user');
        if ($selected_indicies){
            Session::put('selected_ids_for_alert',$selected_indicies);
            return view('admin.email.edit_email');
        }
        else{
            return back();
        }
    }
    public function send_email(Request $request){
        $selected_user=Session::get('selected_ids_for_alert');
        $this->validate($request, [
            'attach_files.*' => 'mimes:doc,pdf,docx,zip,jpg,png,jpeg,gif,bmp'
        ]);

        $title=$request->input('alert_title');
        $data=Array();
        $data['content']=$request->input('alert_body');
        $data['title']=$title;

        $files = $request->file('attach_files');
        if (!$files)
            $files='none';

        for ($i=0;$i<count($selected_user);$i++){
            $user=User::find($selected_user[$i]);
            Mail::to($user->email)->send(new UserMail($data,$files));
        }

        session()->forget('selected_ids_for_alert');

        return redirect('admin/email_page')->with('message','Email was transmitted successfully');
    }
}
