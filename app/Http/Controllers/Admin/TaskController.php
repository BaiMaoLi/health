<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\Task;
use App\Model\admin\Task_User;

use App\Model\admin\Category;
use App\Model\admin\Tag;
use App\Model\user\User;
use App\Model\user\profile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Notifications\EventAlert;
use App\Notifications\UserAlert;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks=Task::all();
        return view('admin.task.show',compact('tasks'));
    }

    public function create()
    {
       return view('admin.task.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
        ]);
        $task = new Task;
        $task->title = $request->input('title');
        $task->category = $request->input('categories');
        $task->task_duration =$request->input('task_duration');
        $task->gender = $request->input('gender');
        $task->age=$request->input('age');
        $task->star=$request->input('star');
        $task->save();
        return redirect(route('task.index'))->with('message','Task Added Successfully');
    }

    public function show($id)
    {
        $user_ids=Task_User::where('task_id',$id)->pluck('user_id')->toArray();
        $users=User::whereIn('id',$user_ids)->get();
        $task_id=$id;
        return view('admin.task.registered_users',compact('users','task_id'));
    }

    public function showUnregsters($id)
    {
        $registered_ids=Task_User::where('task_id',$id)->pluck('user_id')->toArray();
        $users=User::whereNotIn('id',$registered_ids)->get();
        $task=Task::find($id);
        $i=0;
        $unregistered_users=Array();
        $this_year=(new \DateTime())->format('Y');
        $task_age=$task->age;
        $task_gender=$task->gender;
        $task_age=str_replace('+','',$task_age);
        $k=0;
        foreach ($users as $user){
            $profile=profile::where('email',$user->email)->first();
            if ($profile){
		$age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');	
                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=="Both")){
                    $unregistered_users[$k]=$user;
                    $k++;
                }
            }
        }
        $task_id=$id;
        return view('admin.task.unregistered_users',compact('unregistered_users','task_id'));
    }

    public static function IncompleteExpiredTasks(){
        $today=(new \DateTime())->format('Y-m-d');
        $tasks=Task::all();
        foreach($tasks as $task){
            if (!is_null($task->expire_date) and $task->expire_date<$today){
                $task_users=Task_User::where([['task_id','=',$task->id]])->get();
                foreach ($task_users as $task_user) {
                    $task_user->delete();
                }
            }
        }
    }



    public function makeAmbassador($user_id,$task_id){
        $user=User::find($user_id);
        $user->ambassador=1;
        $user->save();
        return redirect()->back()->with('message','User Registered as Ambassador');
    }
    
     public function removeAmbassador($user_id,$task_id){
        $user=User::find($user_id);
        $user->ambassador=0;
        $user->save();
        return redirect()->back()->with('message','User Removed from Ambassador');
    }

    public function makeComplete($user_id,$task_id){
    $task_user=new Task_User();
    $task_user->user_id=$user_id;
    $task_user->task_id=$task_id;
    $task_user->save();
    return redirect()->back()->with('message','User successfully completed this task');
    }

    public function makeIncomplete($user_id,$task_id){
        $task_user=Task_User::where([['user_id','=',$user_id],['task_id','=',$task_id]])->first();
        $task_user->delete();
        return redirect()->back()->with('message','User incomplete this task');
    }




    public function edit($id)
    {
        $task = Task::find($id);
        return view('admin.task.edit',compact('task'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'title'=>'required',
        ]);

        $task=Task::find($id);
        $task->title = $request->input('title');
        $task->category = $request->input('categories');
        $task->task_duration =$request->input('task_duration');
        $task->gender = $request->input('gender');
        $task->age=$request->input('age');
        $task->star=$request->input('star');

        $task->save();
        return redirect(route('task.index'))->with('message','Task Added Successfully');
    }

    public function destroy($id)
    {   $task=Task::find($id);
        $task->delete();
        return redirect()->back()->with('message','Task is deleted successfully');
    }

    function edit_alert($task_id){
        return view('admin.task.edit_alert',compact('task_id'));
    }

    function edit_alertComplete($task_id){
        return view('admin.task.edit_alertComplete',compact('task_id'));
    }



    public function send_alert(Request $request,$task_id){
        $registered_ids=Task_User::where('task_id',$task_id)->pluck('user_id')->toArray();
        $users=User::whereNotIn('id',$registered_ids)->get();

        $task=Task::find($task_id);
        $unregistered_users=Array();
        $this_year=(new \DateTime())->format('Y');
        $task_age=$task->age;
        $task_gender=$task->gender;
        $task_age=str_replace('+','',$task_age);
        $k=0;

        foreach ($users as $user){
            $profile=profile::where('email',$user->email)->first();
            if ($profile){
                $age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');
                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=="Both")){
                    $unregistered_users[$k]=$user;
//                    $user->notify(new UserAlert($request->input('alert_title'),$request->input('alert_body')));
                    $k++;
                }
            }
        }
        return redirect(route('task.index'));
    }

    public function send_alertComplete(Request $request,$task_id){
        $registered_ids=Task_User::where('task_id',$task_id)->pluck('user_id')->toArray();
        $users=User::whereIn('id',$registered_ids)->get();

        $task=Task::find($task_id);
        $unregistered_users=Array();
        $this_year=(new \DateTime())->format('Y');
        $task_age=$task->age;
        $task_gender=$task->gender;
        $task_age=str_replace('+','',$task_age);
        $k=0;

        foreach ($users as $user){
            $profile=profile::where('email',$user->email)->first();
            if ($profile){
                $age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');
                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=="Both")){
                    $unregistered_users[$k]=$user;
//                    $user->notify(new UserAlert($request->input('alert_title'),$request->input('alert_body')));
                    $k++;
                }
            }
        }
        return redirect(route('task.index'));
    }

}
