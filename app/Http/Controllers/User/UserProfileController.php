<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\profile;
use App\Model\user\User;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;



use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email=auth::user()->email;
        $profile = profile::where('email',$email)->first();
        if($profile){
        	if($profile->birthday){
        	 $profile->birthday=(new \DateTime($profile->birthday))->format('m/d/Y');
        	
        	}
        
        }
        
       
        $user= User::where('email', $email)->first();
        $user=$this->upperUsername($user);
	$i=0;
        $states=Array();
        if ($fh = fopen(asset('public/States.txt'), 'r')) {
            while (!feof($fh)) {
                $states[$i]=fgets($fh);
                $states[$i]=str_replace("\n", "", $states[$i]);
                $states[$i]=str_replace("\r", "", $states[$i]);
                $i++;
            }
        }
        return view('user.userprofile',compact('profile','user','states'));



    }
    
     public function upperUsername($user){
        $user->first_name=ucfirst($user->first_name);
        $user->last_name=ucfirst($user->last_name);
        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'email',
            'address',
            'city',
            'state',
            'zip',
            'profile_picture'=>'image|mimes:jpeg,jpg,bmp,png,gif|max:1000',
            'phone',
            'birthday',
            'gender',
        ],
            [
//                'profile_picture.required' 	=> 'Please upload an image',
                'profile_picture.image' 		=> 'Please upload a valid image',
                'profile_picture.max' 		=> 'Please upload an image within 1 MB'
            ]
        );


        $email=auth::user()->email;
        $profile=profile::where('email',$email)->first();
        $avatar_id=$request->input('avatar_number');
        if (is_null($profile)){
            $profile=new profile;
            $profile->email=$request->input('email');
            $profile->address=$request->input('address');
            $profile->city=$request->input('city');
            $profile->state=$request->input('state');
            $profile->zip=$request->input('zip');
            $profile->phone=$request->input('phone');
            $profile->birthday=$request->input('birthday');
            $profile->gender=$request->input('gender');
            $profile->email=$request->input('email');
            $profile->save();
        }
        else{
            $profile->email=$request->input('email');
            $profile->address=$request->input('address');
            $profile->city=$request->input('city');
            $profile->state=$request->input('state');
            $profile->zip=$request->input('zip');
            $profile->phone=$request->input('phone');
            $profile->birthday=$request->input('birthday');
            $profile->gender=$request->input('gender');
            $profile->save();

        }
//
        $profile = profile::where('email',$email)->first();

        if ($avatar_id=='0') {
            if (Input::hasFile('profile_picture')) {
                $profile_picture = $request->file('profile_picture');
                $profile_picture->move(public_path() . '/user/images/profile_pictures', $profile_picture->getClientOriginalName());
                $url = URL::to("/") . '/public/user/images/profile_pictures/' . $profile_picture->getClientOriginalName();
                $profile->profile_picture = $url;
                $profile->save();
            }
        }
        else{
            $url = URL::to("/") . '/public/user/images/profile_pictures/' .'avatar'.$avatar_id.'.png';
            $profile->profile_picture = $url;
            $profile->save();
        }
        $user= User::where('email', $email)->first();
        $user->email=$request->input('email');
        $user->first_name=$request->input('first_name');
        $user->last_name=$request->input('last_name');
        $user->employee_number=$request->input('employee_id');
        $user->save();
        return redirect(route('profile.index'))->with('message','Event Added Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
