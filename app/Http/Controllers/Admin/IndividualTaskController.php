<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\IndividualTask;
use App\Model\admin\IndividualTask_User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\User;
use Illuminate\Support\Facades\Session;
use App\Notifications\UserAlert;

class IndividualTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show(){
        $tasks=IndividualTask::all()->sortByDesc('category');
        return view('admin.individual_task.show',compact('tasks'));
    }


    public function SelectUser(){
        $users=User::all();
        return view('admin.individual_task.selectuser',compact('users'));
    }

    public function create(Request $request){
        $selected_indicies=$request->input('selected-user'); /*        $selected_indicies are having the indices of selected user No.*/
        if ($selected_indicies){
            Session::put('selected_ids_for_individual_task',$selected_indicies);
            return view('admin.individual_task.create');
        }
        else{
            return back();
        }
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'required',
        ]);

        $task = new IndividualTask;
        $task->title = $request->input('title');
        $task->category = $request->input('categories');
        $task->star=$request->input('star');
        if (!is_null($request->input('task_duration'))){
            $task->task_duration = $request->input('task_duration');
        }

        $task->save();

        $selected_user=Session::get('selected_ids_for_individual_task');
        for ($i=0;$i<count($selected_user);$i++){
            $user=User::find($selected_user[$i]);
            $individual_task_user=new IndividualTask_User;
            $individual_task_user->task_id=$task->id;
            $individual_task_user->user_id=$user->id;
            $individual_task_user->save();
        }
        return redirect('admin/IndividualTask/SelectUser')->with('message','Task created successfully');
    }

    public function edit($id){
        $task=IndividualTask::where('id',$id)->first();
        return view('admin.individual_task.edit',compact('task'));
    }

    public function update(Request $request,$id){
//        $task=IndividualTask::where('id',$id)->first();
        $task=IndividualTask::find($id);
        $task->title=$request->input('title');
        $task->category = $request->input('categories');
        $task->star=$request->input('star');
        if (!is_null($request->input('task_duration'))){
            $task->task_duration =$request->input('task_duration');
        }

        $task->save();
        return redirect('admin/IndividualTask/show')->with('message','Task updated successfully');
    }

    public function destroy($id){
        $task=IndividualTask::find($id);
        $task->delete();
        $task_users=IndividualTask_User::where('task_id',$id)->get();
        foreach ($task_users as $task_user){
            $task_user->delete();
        }
        return redirect('admin/IndividualTask/show')->with('message','Task deleted successfully');
    }

    public function ShowCompleteUsers($id){
        $completed_tasks=IndividualTask_User::where([['task_id','=',$id],['isCompleted','=',1]])->get()->pluck('user_id')->toArray();
        $users=User::whereIn('id',$completed_tasks)->get();
        $task_id=$id;
        return view('admin.individual_task.completeusers',compact('users','task_id'));
    }

    public function ShowIncompleteUsers($id){
        $incompleted_tasks=IndividualTask_User::where([['task_id','=',$id],['isCompleted','=',0]])->get()->pluck('user_id')->toArray();
        $users=User::whereIn('id',$incompleted_tasks)->get();
        $task_id=$id;
        return view('admin.individual_task.incompleteusers',compact('users','task_id'));
    }

    public function markIncomplete($user_id,$task_id){
        $task_user=IndividualTask_User::where([['user_id','=',$user_id],['task_id','=',$task_id]])->first();
        $task_user->isCompleted=0;
        $task_user->save();
        return redirect()->back()->with('message','User incomplete this task');
    }

    public function markComplete($user_id,$task_id){
        $task_user=IndividualTask_User::where([['user_id','=',$user_id],['task_id','=',$task_id]])->first();
        $task_user->isCompleted=1;
        $task_user->save();
        return redirect()->back()->with('message','User successfully complete this task');
    }

    public function IncompleteExpiredTasks(){
        $today=(new \DateTime())->format('Y-m-d');
        $individual_tasks=IndividualTask::all();
        foreach ($individual_tasks as $temp){
            if (!is_null($temp->expire_date) and $temp->expire_date<$today){
                $task_users=IndividualTask_User::where('task_id',$temp->id)->get();
                foreach ($task_users as $task_user) {
                    $task_user->isCompleted=0;
                    $task_user->save();
                }
            }
        }
    }
    function edit_alert($task_id){
        return view('admin.individual_task.edit_alert',compact('task_id'));
    }

    function edit_alertComplete($task_id){
        return view('admin.individual_task.edit_alertComplete',compact('task_id'));
    }



    public function send_alert(Request $request,$task_id){
        $incompleted_tasks=IndividualTask_User::where([['task_id','=',$task_id],['isCompleted','=',0]])->get()->pluck('user_id')->toArray();
        $users=User::whereIn('id',$incompleted_tasks)->get();
        foreach ($users as $user){
            $user->notify(new UserAlert($request->input('alert_title'),$request->input('alert_body')));
        }
        return redirect('admin/IndividualTask/show');
    }

    public function send_alertComplete(Request $request,$task_id){
        $incompleted_tasks=IndividualTask_User::where([['task_id','=',$task_id],['isCompleted','=',1]])->get()->pluck('user_id')->toArray();
        $users=User::whereIn('id',$incompleted_tasks)->get();
        foreach ($users as $user){
            $user->notify(new UserAlert($request->input('alert_title'),$request->input('alert_body')));
        }
        return redirect('admin/IndividualTask/show');
    }



}
