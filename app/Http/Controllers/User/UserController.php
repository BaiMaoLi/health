<?php

namespace App\Http\Controllers\User;
use App\Model\admin\IndividualTask;
use App\Model\admin\IndividualTask_User;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Model\admin\Document;
use App\Model\admin\Event;
use App\Model\user\User;
use App\Model\admin\event_user;
use App\Model\user\profile;
use App\Model\admin\Task_User;
use App\Model\admin\Task;

use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function template(){
        return view('user.template');
    }

    public function logged(){
        $email=auth::user()->email;
        $profile=profile::where('email',$email)->first();
        $user=User::where('email',auth::user()->email)->first();
        $user=$this->upperUsername($user);
        $user_id=auth::user()->id;
        $event_ids=event_user::where('user_id',$user_id)->pluck('event_id')->toArray();
        $events=Event::whereIn('id',$event_ids)->get();

    //Getting Wellness Stars
            $user=auth::user();
            $user=$this->upperUsername($user);
            $user_id=$user->id;
            $tasks=Task::all();

            $my_physical_completed_star=0;
            $my_education_completed_star=0;
            $my_lifestyle_completed_star=0;

            $my_physical_total_star=0;
            $my_education_total_star=0;
            $my_lifestyle_total_star=0;


            $profile=profile::where('email',$user->email)->first();
            if ($profile){
                $this_year=(new \DateTime())->format('Y');
                $this_day=(new \DateTime())->format('Y-m-d');
                $age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');

                foreach ($tasks as $task){
                    $task_age=$task->age;
                    $task_gender=$task->gender;
                    $task_age=str_replace('+','',$task_age);
    //                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=='Both') and $task->expire_date>$this_day){
                    if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=='Both')){
                        $task_user=Task_User::where([['user_id','=',$user_id],['task_id','=',$task->id]])->get();
                        $completed_state=count($task_user);
                        switch ($task->category){
                            case 'My Physical':
                                    $my_physical_total_star+=$task->star;
                                if ($completed_state>0)
                                {
                                    $my_physical_completed_star+=$task->star;
                                }
                                break;
                            case 'My Education':
                                    $my_education_total_star+=$task->star;
                                if ($completed_state>0){
                                    $my_education_completed_star+=$task->star;
                                }
                                break;
                            case 'My Lifestyle':
                                    $my_lifestyle_total_star+=$task->star;
                                if ($completed_state>0)
                                    $my_lifestyle_completed_star+=$task->star;

                        }

                    }
                }

                $individual_task_indicies=IndividualTask_User::where('user_id',$user_id)->get()->pluck('task_id')->toArray();
                $individual_tasks=IndividualTask::whereIn('id',$individual_task_indicies)->get();
                foreach ($individual_tasks as $task){
                    $completed_state=IndividualTask_User::where([['user_id','=',$user_id],['task_id','=',$task->id]])->first()->isCompleted;
                    switch ($task->category){
                        case 'My Physical':
                                $my_physical_total_star+=$task->star;
                            if ($completed_state>0){
                                $my_physical_completed_star+=$task->star;
                            }
                            break;
                        case 'My Education':
                                $my_education_total_star+=$task->star;
                            if ($completed_state>0){
                                $my_education_completed_star+=$task->star;
                            }

                            break;
                        case 'My Lifestyle':
                                $my_lifestyle_total_star+=$task->star;
                            if ($completed_state>0){
                                $my_lifestyle_completed_star+=$task->star;
                            }
                    }
                }
            }

        return view('user.logged_home',compact('user','profile','events', 'my_physical_total_star','my_physical_completed_star','my_education_completed_star','my_education_total_star',
            'my_lifestyle_completed_star','my_lifestyle_total_star'));
    }


    public function upperUsername($user){
        $user->first_name=ucfirst($user->first_name);
        $user->last_name=ucfirst($user->last_name);
        return $user;
    }

    public function heart(){
        $user=auth::user();
        $user=$this->upperUsername($user);
        $this->IncompleteExpiredTasks($user->id);
        $user_id=$user->id;
        $tasks=Task::all();
        $my_physical_task=Array();
        $my_education_task=Array();
        $my_lifestyle_task=Array();

        $my_physical_completed_star=0;
        $my_education_completed_star=0;
        $my_lifestyle_completed_star=0;

        $my_physical_total_star=0;
        $my_education_total_star=0;
        $my_lifestyle_total_star=0;


        $i=0;
        $j=0;
        $k=0;
        $profile=profile::where('email',$user->email)->first();
        if ($profile){
            $this_year=(new \DateTime())->format('Y');
            $this_day=(new \DateTime())->format('Y-m-d');
            $age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');

            foreach ($tasks as $task){
                $task_age=$task->age;
                $task_gender=$task->gender;
                $task_age=str_replace('+','',$task_age);
//                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=='Both') and $task->expire_date>$this_day){
                if ($age>=$task_age and ($profile->gender==$task_gender or $task_gender=='Both')){
                    $task_user=Task_User::where([['user_id','=',$user_id],['task_id','=',$task->id]])->get();
                    $completed_state=count($task_user);
                    switch ($task->category){
                        case 'My Physical':
                            $my_physical_task[$i]['task']=$task;
                            $my_physical_task[$i]['state']=$completed_state;
                            $my_physical_total_star+=$task->star;
                            if ($completed_state>0)
                                $my_physical_completed_star+=$task->star;
                            $i++;
                            break;
                        case 'My Education':
                            $my_education_task[$j]['task']=$task;
                            $my_education_task[$j]['state']=$completed_state;
                            $my_education_total_star+=$task->star;
                            if ($completed_state>0)
                                $my_education_completed_star+=$task->star;
                            $j++;
                            break;
                        case 'My Lifestyle':
                            $my_lifestyle_task[$k]['task']=$task;
                            $my_lifestyle_task[$k]['state']=$completed_state;
                            $my_lifestyle_total_star+=$task->star;
                            if ($completed_state>0)
                                $my_lifestyle_completed_star+=$task->star;
                            $k++;
                    }

                }
            }

            $individual_task_indicies=IndividualTask_User::where('user_id',$user_id)->get()->pluck('task_id')->toArray();
            $individual_tasks=IndividualTask::whereIn('id',$individual_task_indicies)->get();
            foreach ($individual_tasks as $task){
                $completed_state=IndividualTask_User::where([['user_id','=',$user_id],['task_id','=',$task->id]])->first()->isCompleted;
                switch ($task->category){
                    case 'My Physical':
                        $my_physical_task[$i]['task']=$task;
                        $my_physical_task[$i]['state']=$completed_state;
                        $my_physical_total_star+=$task->star;
                        if ($completed_state>0)
                            $my_physical_completed_star+=$task->star;
                        $i++;
                        break;
                    case 'My Education':
                        $my_education_task[$j]['task']=$task;
                        $my_education_task[$j]['state']=$completed_state;
                        $my_education_total_star+=$task->star;
                        if ($completed_state>0)
                            $my_education_completed_star+=$task->star;
                        $j++;
                        break;
                    case 'My Lifestyle':
                        $my_lifestyle_task[$k]['task']=$task;
                        $my_lifestyle_task[$k]['state']=$completed_state;
                        $my_lifestyle_total_star+=$task->star;
                        if ($completed_state>0)
                            $my_lifestyle_completed_star+=$task->star;
                        $k++;
                }
            }
        }
        return view('user.heart',compact('user','my_physical_task','my_education_task','my_lifestyle_task',
                                         'my_physical_total_star','my_physical_completed_star','my_education_completed_star','my_education_total_star',
                                          'my_lifestyle_completed_star','my_lifestyle_total_star'));
    }


    public function IncompleteExpiredTasks($user_id){
        $today=(new \DateTime())->format('Y-m-d');
        $completed_ids=Task_User::where('user_id',$user_id)->get()->pluck('task_id')->toArray();
        $completed_tasks=Task::whereIn('id',$completed_ids)->get();
        foreach ($completed_tasks as $task){
            if (!is_null($task->expire_date) and $task->expire_date<$today){
                $task_user=Task_User::where([['task_id','=',$task->id],['user_id','=',$user_id]])->first();
                $task_user->delete();
            }
        }

        $individual_complete_task_ids=IndividualTask_User::where([['user_id','=',$user_id],['isCompleted','=',1]])->get()->pluck('task_id')->toArray();
        $individual_complete_tasks=IndividualTask::whereIn('id',$individual_complete_task_ids)->get();
        foreach ($individual_complete_tasks as $task){
            if (!is_null($task->expire_date) and $task->expire_date<$today){
                $task_user=IndividualTask_User::where([['user_id','=',$user_id],['task_id',$task->id]])->first();
                $task_user->isCompleted=0;
                $task_user->save();
            }
        }



    }

    public function single_event($id){
        $event=Event::find($id);
        $user=User::where('email',auth::user()->email)->first();
           $user=$this->upperUsername($user);
        return view('user.single_event',compact('user','event'));
        return redirect('event_confirm/'.$id);

    }

    public function register_event($id){
        $event=Event::find($id);
        $user=User::where('email',auth::user()->email)->first();
           $user=$this->upperUsername($user);
        $event_user=new event_user();
        $event_user->event_id=$event->id;
        $event_user->user_id=$user->id;
        $event_user->save();
        $user=User::where('email',auth::user()->email)->first();
        $events=Event::all();
//        return redirect('calendar');
        return redirect('event_confirm/'.$id);
//        return view('user.single_event_confirmation',compact('user','event'));

    }

    public function unregister_event($id){
        $event_user=event_user::where(['user_id'=>auth::user()->id,'event_id'=>$id]);
        $event_user->delete();
        return redirect('calendar');

    }

    public function all_alert(){
        $user=User::where('email',auth::user()->email)->first();
           $user=$this->upperUsername($user);
        return view('user.all_alert',compact('user'));
    }

    public function document(){
        $user=auth::user();
        $user=$this->upperUsername($user);
        $profile=profile::where('email',$user->email)->first();
        $this_year=(new \DateTime())->format('Y');
        $document=Array();
        $documents=Document::all();
        $k=0;
        if ($profile){
            $age=(int)$this_year-(int)(new \DateTime($profile->birthday))->format('Y');
            foreach ($documents as $temp_doc){
                $doc_age=(int)str_replace('+','',$temp_doc->age);
                if ($age>$doc_age and ($temp_doc->gender=='Both' or $temp_doc->gender==$profile->gender)){
                    $document[$k]=$temp_doc;
                    $k++;
                }
            }
        }



        return view('user.documents',compact('user','document'));
    }


    public function calendar(){

        $dateTime=new \DateTime();
        $month=$dateTime->format('F');
        $events=Event::where(\DB::raw('substr(event_date,1,2)'),'=',$dateTime->format('m'))->get();
        $user=User::where('email',auth::user()->email)->first();
           $user=$this->upperUsername($user);
        $events_registered=Array();
        $k=0;
        foreach($events as $event){
            $i=event_user::where(['user_id'=>auth::user()->id,'event_id'=>$event['id']])->first();
            if (!is_null($i)){
                $events_registered[$k]=1;
            }
            else
                $events_registered[$k]=0;
            $k++;
        }
        return view('user.calendar',compact('events','user','events_registered','month'));
    }


    public function calendar_month($month){

        $dateObj   = \DateTime::createFromFormat('!m', $month);
        $month = $dateObj->format('F');


        $events=Event::where(\DB::raw('substr(event_date,1,2)'),'=', $dateObj->format('m'))->get();
        $user=User::where('email',auth::user()->email)->first();
           $user=$this->upperUsername($user);
        $events_registered=Array();
        $k=0;
        foreach($events as $event){
            $i=event_user::where(['user_id'=>auth::user()->id,'event_id'=>$event['id']])->first();
            if (!is_null($i)){
                $events_registered[$k]=1;
            }
            else
                $events_registered[$k]=0;
            $k++;
        }
        return view('user.calendar',compact('events','user','events_registered','month'));
    }



    public function edit_profile(){
        return view('user.edit_profile');
    }

    public function single_event_confirmation($id){
        $event=Event::find($id);
        $user=User::where('email',auth::user()->email)->first();
           $user=$this->upperUsername($user);
        return view('user.single_event_confirmation',compact('user','event'));
//        $user=User::where('email',auth::user()->email)->first();
//        return view('user.single_event_confirmation',compact('user'));
    }

    public function get_event_date(Request $request){
        $user_id=auth::user()->id;
        $dateObj   = \DateTime::createFromFormat('!m', $request->input('month'));
        $month = $dateObj->format('m');
        $events_registered=event_user::where('user_id',$user_id)->pluck('event_id')->toArray();   //Finding Eevent registered by user
//        $event_date=Event::whereIn('id',$events_registered)->
//        where(\DB::raw('substr(event_date,1,2)'),'=',$month)->get()
//            ->pluck('event_date')->toArray();  //Getting Event Date

        $event_date=Event::where(\DB::raw('substr(event_date,1,2)'),'=',$month)->get()
            ->pluck('event_date')->toArray();  //Getting Event Date

        $registered_date1=Event::where(\DB::raw('substr(event_date,1,2)'),'=',$month)->
        whereIn('id',$events_registered)->get()->pluck('event_date')->toArray();

        $months=Array();
        $dates=Array();
        $registered_date=Array();

        for ($i=0;$i<count($registered_date1);$i++){
            $registered_date[$i]=(new \DateTime($registered_date1[$i]))->format('d');
        }

        for($i=0;$i<count($event_date);$i++){
            $months[$i]=(new \DateTime($event_date[$i]))->format('m');
            $dates[$i]=(new \DateTime($event_date[$i]))->format('d');
        }
        return response()->json(['months'=>$months, 'dates'=>$dates,'Request_Month'=>$month,
            'registered_date'=>$registered_date]);

    }


    //For getting Single Event when clicking event date in calendar page
    public function get_single_event(Request $request){
        $dateObj   = \DateTime::createFromFormat('!m', $request->input('month'));
        $month = $dateObj->format('m');
        $dateObj   = \DateTime::createFromFormat('!d', $request->input('date'));
        $date = $dateObj->format('d');
        $event=Event::where(\DB::raw('substr(event_date,1,5)'),'=',$month.'/'.$date)->get();  //Getting Event Date
        return response()->json(['month'=>$month, 'date'=>$date,'event'=>$event]);
    }

    public function get_all_event(Request $request){
        $dateObj   = \DateTime::createFromFormat('!m', $request->input('month'));
        $month = $dateObj->format('m');
        $event=Event::where(\DB::raw('substr(event_date,1,2)'),'=',$month)->get();  //Getting Event Date
        return response()->json(['month'=>$month,'event'=>$event]);
    }

    public function getMonthEvents(Request $request){
        $dateObj   = \DateTime::createFromFormat('!m', $request->input('month'));
        $month = $dateObj->format('m');
        $event=Event::where(\DB::raw('substr(event_date,1,2)'),'=',$month)->get();  //Getting Event Date

        $user_id=auth::user()->id;
        $event_ids=event_user::where('user_id',$user_id)->pluck('event_id')->toArray();
        $myevent=Event::where(\DB::raw('substr(event_date,1,2)'),'=',$month)->whereIn('id',$event_ids)->get();


        return response()->json(['month'=>$month,'event'=>$event,'myevent'=>$myevent]);
//        return response()->json(['month'=>$month,'event'=>$event]);
    }


    public function notifications()
    {
//        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
//        return auth()->user()->unreadNotifications()->get()->toArray();
//        return auth()->user()->readNotifications()->get()->toArray();
        return auth()->user()->notifications;

    }

    public function single_notification($id)
    {
        $all_notification=auth()->user()->unreadNotifications()->get()->toArray();
        return $all_notification[$id];
    }

    public function notyRead(Request $request)
    {
        $id=$request->input('id');
        $notification = auth::user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['success'=>'Succss']);
    }
    public function notyRemove(Request $request)
    {
        $exist=0;
        $id=$request->input('id');
        $notification = auth::user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->delete();
            $exist=1;
        }
        return response()->json(['success'=>'Succss','exist'=>$exist]);

    }

    public function notyRemoveAll(Request $request)
    {
        $notifications= auth()->user()->notifications;
        foreach ($notifications as $notification){
            $notification->delete();
        }

        return response()->json(['success'=>'Succss']);
    }
    public function downloadFile($id){
        $document=Document::find($id);
        $file= public_path(). "/documents/".$document->url;
        return Response::download($file);
    }
}

