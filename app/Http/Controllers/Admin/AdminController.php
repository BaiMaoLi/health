<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin',['except' => 'create_admin']);
    }

    public function create_admin(Request $request){

        $this->validate($request,[
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $new_admin=new admin;
        $new_admin->first_name=$request->input('first-name');
        $new_admin->last_name=$request->input('last-name');
        $new_admin->email=$request->input('email');
        $new_admin->password=bcrypt($request->input('password'));
        $new_admin->save();
        return redirect('/admin/home');
    }
}
