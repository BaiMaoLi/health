<?php

namespace App\Http\Controllers;
use App\recorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Mail;

class RecorderController extends Controller
{
    public function page3(){
        return view('page3');
    }

    public function ajaxUpdate(Request $request){

        $input = $_FILES['audio_data']['tmp_name'];

        $date=new \DateTime();
        $output=$date->format('Y-m-d h-i-s');
        $output.='.wav';
        $url=public_path().'/audio_messages/'.$output;
        $url1=url('/public/audio_messages/'.$output);
        Session::put('urlo', $url1);
        move_uploaded_file($input, $url);
        return $url1;
    }
    public function addrecorder(Request $request){

        $user=auth::user();
        $user_id=$user->id;
        for ($i = 0; $i < 5; $i++) {
            $id = $request->input('id-' . $i);
            if (!is_null($request->input('first_name-' . $i))) {
                $recorders = null;
                if ($id != 0) {
                    $recorders = recorder::find($id);
                } else
                    $recorders = new recorder;

                $recorders->first_name = $request->input('first_name-' . $i);
                $recorders->last_name = $request->input('last_name-' . $i);
                $recorders->phone = $request->input('phone-' . $i);
                $recorders->email = $request->input('email-' . $i);
                $recorders->user_id = $user_id;
                $recorders->save();
            }
            if(is_null($request->input('first_name-' . $i)) && is_null($request->input('last_name-' . $i)) && is_null($request->input('phone-' . $i)) && is_null($request->input('email-' . $i))){
                $del=recorder::find($id);
                if (!is_null($del)){ $del->delete();}
            }
        }
        return redirect('/page2');
    }
}
