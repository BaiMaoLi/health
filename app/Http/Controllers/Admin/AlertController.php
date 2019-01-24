<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Notifications\UserAlert;

class AlertController extends Controller
{

    public function home(){
        $users=User::all();
        return view("admin.alert.home",compact('users'));
    }

    public function edit_alert(Request $request){
        $selected_indicies=$request->input('selected-user');
        if ($selected_indicies){
            Session::put('selected_ids_for_alert',$selected_indicies);
            return view('admin.alert.edit_alert');
        }
        else{
            return back();
        }
    }
    public function send_alert(Request $request){
        $selected_user=Session::get('selected_ids_for_alert');
        $i=0;
        for ($i=0;$i<count($selected_user);$i++){
            $user=User::find($selected_user[$i]);
        }
        session()->forget('selected_ids_for_alert');
        return redirect('admin/alert_page')->with('message','Message was transmitted successfully');
    }


}
