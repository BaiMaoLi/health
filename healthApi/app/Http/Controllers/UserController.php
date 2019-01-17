<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserProfile;
use Illuminate\Support\Facades\Auth;
use Validator;
class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $token =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['status' => "true",'token'=>'Bearer '.$token]);
        }
        else{
            return response()->json(['status'=>'false'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'=>'required',
            'last_name'=>'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'city'=>'required',
            'birthday'=>'required'
        ]);
        if ($validator->fails()) {
//            return response()->json(['error'=>$validator->errors()], 401);
            return response()->json(['status'=>"false"]);
        }
        $input = $request->except(array('city','birthday'));
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token =  $user->createToken('MyApp')-> accessToken;
        $user_id=$user->id;
        $user_profile=new UserProfile;
        $user_profile->user_id=$user_id;
        $user_profile->city=$request->input('city');
        $user_profile->birthday=$request->input('birthday');
        $user_profile->save();

        return response()->json(['status'=>"true", 'token'=>'Bearer '.$token]);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }
}