<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Document;
use App\Model\admin\IndividualTask;
use App\Model\admin\IndividualTask_User;
use App\Model\admin\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use App\Model\admin\Task_User;
use App\Model\user\profile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Admin\TaskController;
use Excel;
use App\Exports\userExport;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        TaskController::IncompleteExpiredTasks();

        $users = user::all();
        $i=0;
        $wellness_stars=Array();
        foreach ($users as $user) {
            $count1=0;
            $count2=0;
            $user_tasks=Task_User::where('user_id',$user->id)->get();
            foreach ($user_tasks as $user_task){
                $temp=Task::where('id',$user_task->task_id)->get();
                if ($temp->first())
                    $count1+=$temp->first()->star;
            }

            $individual_task_users=IndividualTask_User::where([['user_id','=',$user->id],['isCompleted','=',1]])->get();
            foreach ($individual_task_users as $individual_task_user){
                $temp=IndividualTask::where('id',$individual_task_user->task_id)->get();
                if ($temp->first())
                    $count2+=$temp->star;
            }


            $wellness_stars[$i]=$count1+$count2;
            $i++;

        }
        return view('admin.user.show',compact('users','wellness_stars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');

    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'employee_number' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'city',
            'state',
            'zip',
            'profile_picture'=>'image|mimes:jpeg,jpg,bmp,png,gif|max:1000',
            'phone',
            'birthday',
            'gender',
            ],
            [
            'profile_picture.image' 		=> 'Please upload a valid image',
            'profile_picture.max' 		=> 'Please upload an image within 1 MB'
        ]);
        $request['password'] = bcrypt($request->password);
        $user = new user();
        $user->first_name=$request->input('first_name');
        $user->last_name=$request->input('last_name');
        $user->email=$request->input('email');
        $user->employee_number=$request->input('employee_number');
        $user->password=$request->input('password');
        $user->save();

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
        $url='';
        if(Input::hasFile('profile_picture')){
            $profile_picture = $request->file('profile_picture');
            $profile_picture->move(public_path().'/user/images/profile_pictures',$profile_picture->getClientOriginalName());
            $url=URL::to("/").'/public/user/images/profile_pictures/'.$profile_picture->getClientOriginalName();

        }
        $profile->profile_picture = $url;
        $profile->save();



        return redirect(route('user.index'));
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $user = user::find($id);
        $profile=profile::where('email',$user->email)->first();
        return view('admin.user.edit',compact('user','profile'));
    }


    public function update(Request $request, $id)
    {
//        $this->validate($request,[
//            'first_name' => 'required|string|max:255',
//            'last_name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255',
//            'employee_number' => 'required|string|max:255',
//        ]);
//        $user = user::where('id',$id)->update($request->except('_token','_method'));

        if(!is_null($request->input('password'))){
            $this->validate($request,[
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'employee_number' => 'required|string|max:255',
                'city',
                'state',
                'zip',
                'profile_picture'=>'image|mimes:jpeg,jpg,bmp,png,gif|max:1000',
                'phone',
                'birthday',
                'gender',
                'password' => 'string|min:6|confirmed',
            ],
                [
                    'profile_picture.image' 		=> 'Please upload a valid image',
                    'profile_picture.max' 		=> 'Please upload an image within 1 MB'
                ]);
        }
        else{
            $this->validate($request,[
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'employee_number' => 'required|string|max:255',
                'city',
                'state',
                'zip',
                'profile_picture'=>'image|mimes:jpeg,jpg,bmp,png,gif|max:1000',
                'phone',
                'birthday',
                'gender',
                'password',
            ],
                [
                    'profile_picture.image' 		=> 'Please upload a valid image',
                    'profile_picture.max' 		=> 'Please upload an image within 1 MB'
                ]);
        }

        $user = user::where('id',$id)->first();
        $user->first_name=$request->input('first_name');
        $user->last_name=$request->input('last_name');
        $user->email=$request->input('email');
        $user->employee_number=$request->input('employee_number');
        if(!is_null($request->input('password'))){
            $user->password=bcrypt($request->input('password'));
        }
        $user->save();

        $email=$request->input('email');
        $profile=profile::where('email',$email)->first();
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
            $profile->email=$email;
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

        if(Input::hasFile('profile_picture')){
            $profile_picture = $request->file('profile_picture');
            $profile_picture->move(public_path().'/user/images/profile_pictures',$profile_picture->getClientOriginalName());
            $url=URL::to("/").'/public/user/images/profile_pictures/'.$profile_picture->getClientOriginalName();
            $profile->profile_picture = $url;
            $profile->save();
        }
        return redirect(route('user.index'))->with('message','User updated successfully');
    }

    public function showTasks($id){
        $user=User::find($id);
        $user=$this->upperUsername($user);
        $user_name=$user->first_name." ".$user->last_name."'s ";
        $user_id=$id;
        $completed_tasks=Array();
        $incompleted_tasks=Array();
        //$profile=profile::where('email',$user->email)->first();
        $profile1=profile::where('email',$user->email)->get();
        if(count($profile1)){
	    $profile=profile::where('email',$user->email)->first();
            $completed_ids=Task_User::where('user_id',$id)->pluck('task_id')->toArray();
            $completed_tasks=Task::whereIn('id',$completed_ids)->get();
            $this_year=(new \DateTime())->format('Y');
            $this_day=(new \DateTime())->format('Y-m-d');
            $tasks=Task::whereNotIn('id',$completed_ids)->get();
            $age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');
            $k=0;
            foreach ($tasks as $task){
                $task_age=$task->age;
                $task_gender=$task->gender;
                $task_age=str_replace('+','',$task_age);
//                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=='Both') and $task->expire_date>$this_day){
                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=='Both')){
                    $incompleted_tasks[$k]=$task;
                    $k++;
                }
            }
        }

        $individual_complete_task_indicies=IndividualTask_User::where([['user_id','=',$user->id],['isCompleted','=',1]])->get()->pluck('task_id')->toArray();
        $individual_incomplete_task_indicies=IndividualTask_User::where([['user_id','=',$user->id],['isCompleted','=',0]])->get()->pluck('task_id')->toArray();

        $individual_complete_tasks=IndividualTask::whereIn('id',$individual_complete_task_indicies)->get();
        $individual_incomplete_tasks=IndividualTask::whereIn('id',$individual_incomplete_task_indicies)->get();

        return view('admin.user.usertask',compact('completed_tasks','incompleted_tasks','user_id','individual_complete_tasks','individual_incomplete_tasks','user_name'));
    }

    public function upperUsername($user){
        $user->first_name=ucfirst($user->first_name);
        $user->last_name=ucfirst($user->last_name);
        return $user;
    }



    public function printAll(){
        $users=User::all();
        $i=0;
        $user_print_data=Array();
        foreach ($users as $user){
            $user=$this->upperUsername($user);
            $user_id=$user->id;

            $user_print_data['user_name'][$i]=$user->first_name." ".$user->last_name;
            $user_print_data['employee_id'][$i]=$user->employee_number;
            $user_print_data['email'][$i]=$user->email;


            $user_print_data['my_physical_total_star'][$i]=0;
            $user_print_data['my_physical_completed_star'][$i]=0;
            $user_print_data['my_education_total_star'][$i]=0;
            $user_print_data['my_education_completed_star'][$i]=0;
            $user_print_data['my_lifestyle_total_star'][$i]=0;
            $user_print_data['my_lifestyle_completed_star'][$i]=0;

            $user_print_data['my_physical_task']['task'][$i]=null;
            $user_print_data['my_physical_task']['state'][$i]=null;
            $user_print_data['my_education_task']['task'][$i]=null;
            $user_print_data['my_education_task']['state'][$i]=null;
            $user_print_data['my_lifestyle_task']['task'][$i]=null;
            $user_print_data['my_lifestyle_task']['state'][$i]=null;



            $tasks=Task::all();
            $j=0;
            $k=0;
            $l=0;
            $profile=profile::where('email',$user->email)->first();

            if ($profile){
                $user_print_data['profile_state'][$i]=1;
                $user_print_data['gender'][$i]=$profile->gender;
                $user_print_data['birthday'][$i]=$profile->birthday;
                $user_print_data['phone'][$i]=$profile->phone;
                $user_print_data['address'][$i]=$profile->address;
                $user_print_data['city'][$i]=$profile->city;
                $user_print_data['state'][$i]=$profile->state;
                $user_print_data['zip'][$i]=$profile->zip;




                $this_year=(new \DateTime())->format('Y');
                $age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');

                foreach ($tasks as $task){
                    $task_age=$task->age;
                    $task_gender=$task->gender;
                    $task_age=str_replace('+','',$task_age);
                    if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=='Both')){
                        $task_user=Task_User::where([['user_id','=',$user_id],['task_id','=',$task->id]])->get();
                        $completed_state=count($task_user);
                        switch ($task->category){
                            case 'My Physical':
                                $user_print_data['my_physical_task']['task'][$i][$j]=$task->title;
                                $user_print_data['my_physical_task']['state'][$i][$j]=$completed_state;
                                $user_print_data['my_physical_total_star'][$i]+=$task->star;
                                if ($completed_state>0)
                                    $user_print_data['my_physical_completed_star'][$i]+=$task->star;
                                $j++;
                                break;
                            case 'My Education':
                                $user_print_data['my_education_task']['task'][$i][$k]=$task->title;
                                $user_print_data['my_education_task']['state'][$i][$k]=$completed_state;
                                $user_print_data['my_education_total_star'][$i]+=$task->star;
                                if ($completed_state>0)
                                    $user_print_data['my_education_completed_star'][$i]+=$task->star;
                                $k++;
                                break;
                            case 'My Lifestyle':
                                $user_print_data['my_lifestyle_task']['task'][$i][$l]=$task->title;
                                $user_print_data['my_lifestyle_task']['state'][$i][$l]=$completed_state;
                                $user_print_data['my_lifestyle_total_star'][$i]+=$task->star;
                                if ($completed_state>0)
                                    $user_print_data['my_lifestyle_completed_star'][$i]+=$task->star;
                                $l++;
                        }

                    }
                }

                $individual_task_indicies=IndividualTask_User::where('user_id',$user_id)->get()->pluck('task_id')->toArray();
                $individual_tasks=IndividualTask::whereIn('id',$individual_task_indicies)->get();
                foreach ($individual_tasks as $task){
                    $completed_state=IndividualTask_User::where([['user_id','=',$user_id],['task_id','=',$task->id]])->first()->isCompleted;
                    switch ($task->category){
                        case 'My Physical':
                            $user_print_data['my_physical_task']['task'][$i][$j]=$task->title;
                            $user_print_data['my_physical_task']['state'][$i][$j]=$completed_state;
                            $user_print_data['my_physical_total_star'][$i]+=$task->star;
                            if ($completed_state>0)
                                $user_print_data['my_physical_completed_star'][$i]+=$task->star;
                            $j++;
                            break;
                        case 'My Education':
                            $user_print_data['my_education_task']['task'][$i][$k]=$task->title;
                            $user_print_data['my_education_task']['state'][$i][$k]=$completed_state;
                           $user_print_data['my_education_total_star'][$i]+=$task->star;
                            if ($completed_state>0)
                                $user_print_data['my_education_completed_star'][$i]+=$task->star;
                            $k++;
                            break;
                        case 'My Lifestyle':
                            $user_print_data['my_lifestyle_task']['task'][$i][$l]=$task->title;
                            $user_print_data['my_lifestyle_task']['state'][$i][$l]=$completed_state;
                            $user_print_data['my_lifestyle_total_star'][$i]+=$task->star;
                            if ($completed_state>0)
                                $user_print_data['my_lifestyle_completed_star'][$i]+=$task->star;
                            $l++;
                    }
                }
            }
            else{  //If there is not finished profile
                $user_print_data['profile_state'][$i]=0;
                $user_print_data['gender'][$i]=null;
                $user_print_data['birthday'][$i]=null;
                $user_print_data['phone'][$i]=null;
                $user_print_data['address'][$i]=null;
                $user_print_data['city'][$i]=null;
                $user_print_data['state'][$i]=null;
                $user_print_data['zip'][$i]=null;
            }
            $user_print_data['total_complete_star'][$i]=$user_print_data['my_physical_completed_star'][$i]+$user_print_data['my_education_completed_star'][$i]+$user_print_data['my_lifestyle_completed_star'][$i];
            $i++;




        }
//        echo "<pre>";
//        print_r($user_print_data);
//        exit();



        return view('admin.user.printall',compact('user_print_data'));

    }


    public function printUser($id){
        $user=User::find($id);

        $user_print_data=Array();

        $user=$this->upperUsername($user);
        $user_id=$user->id;

        $user_print_data['user_name']=$user->first_name." ".$user->last_name;
        $user_print_data['employee_id']=$user->employee_number;
        $user_print_data['email']=$user->email;


        $user_print_data['my_physical_total_star']=0;
        $user_print_data['my_physical_completed_star']=0;
        $user_print_data['my_education_total_star']=0;
        $user_print_data['my_education_completed_star']=0;
        $user_print_data['my_lifestyle_total_star']=0;
        $user_print_data['my_lifestyle_completed_star']=0;

        $user_print_data['my_physical_task']['task']=null;
        $user_print_data['my_physical_task']['state']=null;
        $user_print_data['my_education_task']['task']=null;
        $user_print_data['my_education_task']['state']=null;
        $user_print_data['my_lifestyle_task']['task']=null;
        $user_print_data['my_lifestyle_task']['state']=null;



        $tasks=Task::all();
        $j=0;
        $k=0;
        $l=0;
        $profile=profile::where('email',$user->email)->first();

        if ($profile){
            $user_print_data['profile_state']=1;
            $user_print_data['gender']=$profile->gender;
            $user_print_data['birthday']=$profile->birthday;
            $user_print_data['phone']=$profile->phone;
            $user_print_data['address']=$profile->address;
            $user_print_data['city']=$profile->city;
            $user_print_data['state']=$profile->state;
            $user_print_data['zip']=$profile->zip;




            $this_year=(new \DateTime())->format('Y');
            $age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');

            foreach ($tasks as $task){
                $task_age=$task->age;
                $task_gender=$task->gender;
                $task_age=str_replace('+','',$task_age);
                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=='Both')){
                    $task_user=Task_User::where([['user_id','=',$user_id],['task_id','=',$task->id]])->get();
                    $completed_state=count($task_user);
                    switch ($task->category){
                        case 'My Physical':
                            $user_print_data['my_physical_task']['task'][$j]=$task->title;
                            $user_print_data['my_physical_task']['state'][$j]=$completed_state;
                            $user_print_data['my_physical_total_star']+=$task->star;
                            if ($completed_state>0)
                                $user_print_data['my_physical_completed_star']+=$task->star;
                            $j++;
                            break;
                        case 'My Education':
                            $user_print_data['my_education_task']['task'][$k]=$task->title;
                            $user_print_data['my_education_task']['state'][$k]=$completed_state;
                            $user_print_data['my_education_total_star']+=$task->star;
                            if ($completed_state>0)
                                $user_print_data['my_education_completed_star']+=$task->star;
                            $k++;
                            break;
                        case 'My Lifestyle':
                            $user_print_data['my_lifestyle_task']['task'][$l]=$task->title;
                            $user_print_data['my_lifestyle_task']['state'][$l]=$completed_state;
                            $user_print_data['my_lifestyle_total_star']+=$task->star;
                            if ($completed_state>0)
                                $user_print_data['my_lifestyle_completed_star']+=$task->star;
                            $l++;
                    }

                }
            }

            $individual_task_indicies=IndividualTask_User::where('user_id',$user_id)->get()->pluck('task_id')->toArray();
            $individual_tasks=IndividualTask::whereIn('id',$individual_task_indicies)->get();
            foreach ($individual_tasks as $task){
                $completed_state=IndividualTask_User::where([['user_id','=',$user_id],['task_id','=',$task->id]])->first()->isCompleted;
                switch ($task->category){
                    case 'My Physical':
                        $user_print_data['my_physical_task']['task'][$j]=$task->title;
                        $user_print_data['my_physical_task']['state'][$j]=$completed_state;
                        $user_print_data['my_physical_total_star']+=$task->star;
                        if ($completed_state>0)
                            $user_print_data['my_physical_completed_star']+=$task->star;
                        $j++;
                        break;
                    case 'My Education':
                        $user_print_data['my_education_task']['task'][$k]=$task->title;
                        $user_print_data['my_education_task']['state'][$k]=$completed_state;
                        $user_print_data['my_education_total_star']+=$task->star;
                        if ($completed_state>0)
                            $user_print_data['my_education_completed_star']+=$task->star;
                        $k++;
                        break;
                    case 'My Lifestyle':
                        $user_print_data['my_lifestyle_task']['task'][$l]=$task->title;
                        $user_print_data['my_lifestyle_task']['state'][$l]=$completed_state;
                        $user_print_data['my_lifestyle_total_star']+=$task->star;
                        if ($completed_state>0)
                            $user_print_data['my_lifestyle_completed_star']+=$task->star;
                        $l++;
                }
            }
        }
        else{  //If there is not finished profile
            $user_print_data['profile_state']=0;
            $user_print_data['gender']=null;
            $user_print_data['birthday']=null;
            $user_print_data['phone']=null;
            $user_print_data['address']=null;
            $user_print_data['city']=null;
            $user_print_data['state']=null;
            $user_print_data['zip']=null;
        }
        $user_print_data['total_complete_star']=$user_print_data['my_physical_completed_star']+$user_print_data['my_education_completed_star']+$user_print_data['my_lifestyle_completed_star'];


//        echo "<pre>";
//        print_r($user_print_data);
//        exit();



        return view('admin.user.print',compact('user_print_data'));

    }

    public function downloadExcel(){
        return Excel::download(new userExport(), 'export.xlsx');

//        $user=User::get()->toArray();
//        $collect=collect($user);
        $collect=collect([
            [
                'name' => 'Povilas',
                'surname' => 'Korop',
                'email' => 'povilas@laraveldaily.com',
                'twitter' => '@povilaskorop'
            ],
            [
                'name' => 'Taylor',
                'surname' => 'Otwell',
                'email' => 'taylor@laravel.com',
                'twitter' => '@taylorotwell'
            ]
        ]);
        return $collect;


    }







    public function destroy($id)
    {
        user::where('id',$id)->delete();
        return redirect()->back()->with('message','User is deleted successfully');
    }








}
