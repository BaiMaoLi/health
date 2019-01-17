<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\UserAlert;
use Illuminate\Support\Facades\Auth;
use App\Model\user\User;

class Send_Alert extends Controller
{
    public function send_alert(){
//        return "1";
        $user=User::find(1);
        $user->notify(new UserAlert());
        return back()->withSuccess("You are now friends with {$user->name}");
    }
}
