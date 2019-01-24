<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\Event;
use App\Model\admin\event_user;
use App\Model\admin\Category;
use App\Model\admin\Tag;
use App\Model\user\User;
use App\Model\admin\Task;
use App\Model\admin\Task_User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Notifications\EventAlert;
use App\Notifications\UserAlert;

class EventController extends Controller
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
        $events=Event::all();
        return view('admin.event.show',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('admin.event.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'event_title'=>'required',
            'event_date'=>'required',
            'event_time'=>'required',
            'featured_picture'=>'image|mimes:jpeg,jpg,bmp,png,gif|max:10000',
            'slide_picture'=>'image|mimes:jpeg,jpg,bmp,png,gif|max:10000',
            'event_body'=>'required',
        ],
            [
                'featured_picture.image' 		=> 'Please upload a valid image',
                'featured_picture.max' 		=> 'Please upload an image within 1 MB'
            ],
            [
                'slide_picture.image' 		=> 'Please upload a valid image',
                'slide_picture.max' 		=> 'Please upload an image within 1 MB'
            ]);



        $event = new Event;
        $event->event_title = $request->input('event_title');
        $event->event_date = $request->input('event_date');
        $event->event_time = $request->input('event_time');
        $event->event_body = $request->input('event_body');
        $event->event_location=$request->input('event_location');
        $event->tag_name=$request->input('tags');
        $event->category_name=$request->input('categories');
//        return "fdfd";
        if(Input::hasFile('featured_picture')){
            $featured_picture = $request->file('featured_picture');
//            $featured_picture->move(public_path().'/event_pictures',$featured_picture->getClientOriginalName());
            $event->featured_picture =$featured_picture->getClientOriginalName();;
        }
        if(Input::hasFile('slide_picture')){
            $featured_picture = $request->file('slide_picture');
//            $featured_picture->move(public_path().'/slide_pictures',$featured_picture->getClientOriginalName());
            $event->slide_picture = $featured_picture->getClientOriginalName();;
        }


        if (!is_null($request->input('create_task'))){
            $task=new Task;
            $task->title=$request->input('event_title');
            $task->category=$request->input('tags');
            $task->task_duration='1 Year';
            $task->gender='Both';
            $task->age='0+';
            $task->star=1;
            $task->save();
            $event->create_task='1';
            $event->task_id=$task->id;
        }


        $event->save();

        // -------------------Sending EventAlert to All Users----------------

        $EventAlert_id=$event->id;
        $EventAlert_title="New Event Added";

        $EventAlert_time=((new \DateTime($event->event_date))->format('F')." ".
            (new \DateTime($event->event_date))->format('d').", at ". (new \DateTime($event->event_time))->format('h:i a'));
        $EventAlert_location=$event->event_location;
        $users=User::all();
        foreach ($users as $user){
            $user->notify(new EventAlert($EventAlert_title,$EventAlert_time,$EventAlert_location,$EventAlert_id));
        }
        return redirect(route('event.index'))->with('message','Event Added Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_ids=event_user::where('event_id',$id)->pluck('user_id')->toArray();

        $users=User::whereIn('id',$user_ids)->get();
        $event_id=$id;

        return view('admin.event.registered_users',compact('users','event_id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.event.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request,[
            'event_title'=>'required',
            'event_date'=>'required',
            'event_time'=>'required',
            'featured_picture'=>'image|mimes:jpeg,jpg,bmp,png,gif|max:10000',
            'slide_picture'=>'image|mimes:jpeg,jpg,bmp,png,gif|max:10000',
            'event_body'=>'required',
        ]);


        $event=Event::find($id);
        if(Input::hasFile('featured_picture')){
            $featured_picture = $request->file('featured_picture');
//            $featured_picture->move(public_path().'/event_pictures',$featured_picture->getClientOriginalName());
            if (!is_null($event->featured_picture)){
                $file_name='public/event_pictures/'.$event->featured_picture;
                if (file_exists($file_name))
                    File::delete($file_name);
            }
            $event->featured_picture = $featured_picture->getClientOriginalName();;
        }
        if(Input::hasFile('slide_picture')){
            $featured_picture = $request->file('slide_picture');
//            $featured_picture->move(public_path().'/slide_pictures',$featured_picture->getClientOriginalName());
            if (!is_null($event->slide_picture)){
                $file_name='public/slide_pictures/'.$event->slide_picture;
                if (file_exists($file_name))
                    File::delete($file_name);
            }
            $event->slide_picture =$featured_picture->getClientOriginalName();
        }


        //---------------------------------------------Making Event Alert------------------------------------
        //---------------------------------------------------------------------------------------------------//

        $EventAlert_title="";
        if (strcmp($event->event_date, $request->input('event_date'))!=0 or strcmp($event->event_time,$request->input('event_time'))!=0){
            if (strcmp($event->event_location, $request->input('event_location'))!=0){
                $EventAlert_title="The time and location of event has been changed";
            }
            else{
                $EventAlert_title="The time of event has been changed";
            }

        }
        else{
            if (strcmp($event->event_location, $request->input('event_location'))!=0){
                $EventAlert_title="The location of event has been changed";
            }
            else{
                if (strcmp($event->event_title, $request->input('event_title'))!=0 or strcmp($event->event_body,$request->input('event_body'))!=0){
                    $EventAlert_title="The description of event has been changed";
                }
//                else{   /* If all are not changed*/
//                    return redirect(route('event.index'));
//                }
            }
        }

        $event->event_title = $request->input('event_title');
        $event->event_date = $request->input('event_date');
        $event->event_time = $request->input('event_time');
        $event->event_body = $request->input('event_body');
        $event->event_location=$request->input('event_location');
        $event->tag_name=$request->input('tags');
        $event->category_name=$request->input('categories');

        if (!is_null($request->input('create_task'))){
            if ($event->task_id!=0)
            {
                $task=Task::find($event->task_id);
                if (is_null($task))
                {
                    $task=new Task;
                }
                $task->title=$request->input('event_title');
                $task->category=$request->input('tags');
                $task->task_duration='1 Year';
                $task->gender='Both';
                $task->age='0+';
                $task->star=1;
                $task->save();
                $event->task_id=$task->id;
                $event->create_task='1';
            }
            else
            {
                $task=new Task;
                $task->title=$request->input('event_title');
                $task->category=$request->input('tags');
                $task->task_duration='900';
                $task->gender='Both';
                $task->age='0+';
                $task->star=1;
                $task->save();
                $event->create_task='1';
                $event->task_id=$task->id;
            }

        }
        else{

            if ($event->task_id!=0){
                $task=Task::find($event->task_id);
                if (!is_null($task))
                    $task->delete();
                $task_users=Task_User::where('task_id',$event->task_id)->get();
                foreach($task_users as $task_user){
                    $task_user->delete();
                }
            }
            $event->create_task='0';
        }
        $event->save();
        $EventAlert_id=$event->id;
        $EventAlert_time=((new \DateTime($event->event_date))->format('F')." ".
            (new \DateTime($event->event_date))->format('d').", at ". (new \DateTime($event->event_time))->format('h:i a'));
        $EventAlert_location=$event->event_location;

        $user_registered=event_user::all()->pluck('user_id')->toArray();  /*Getting Users registered at this event*/
        $users=User::whereIn('id',$user_registered)->get();
        foreach ($users as $user){
            $user->notify(new EventAlert($EventAlert_title,$EventAlert_time,$EventAlert_location,$EventAlert_id));
        }
        return redirect(route('event.index'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::find($id);
        $EventAlert_title="The ".$event->event_title. " has been deleted";
        $EventAlert_id=$event->id;
        $EventAlert_time=((new \DateTime($event->event_date))->format('F')." ".
            (new \DateTime($event->event_date))->format('d').", at ". (new \DateTime($event->event_time))->format('h:i a'));
        $EventAlert_location=$event->event_location;

        $user_registered=event_user::all()->pluck('user_id')->toArray();  /*Getting Users registered at this event*/
        $users=User::all();
        foreach ($users as $user){
            $user->notify(new EventAlert($EventAlert_title,$EventAlert_time,$EventAlert_location,$EventAlert_id));
        }


        if (!is_null($event->slide_picture)){
            $file_name='public/slide_pictures/'.$event->slide_picture;
            if (file_exists($file_name))
                File::delete($file_name);
        }
        if (!is_null($event->featured_picture)){
            $file_name='public/event_pictures/'.$event->featured_picture;
            if (file_exists($file_name))
                File::delete($file_name);
        }

        $event->delete();
        event_user::where('event_id',$id)->delete();

        return redirect()->back()->with('message','Event is deleted successfully');
    }

    public function edit_alert($event_id){
        return view('admin.event.edit_alert',compact('event_id'));
    }

    public function send_alert(Request $request, $event_id){
        $user_ids=event_user::where('event_id',$event_id)->pluck('user_id')->toArray();
        $users=User::whereIn('id',$user_ids)->get();
        foreach ($users as $user){
            $user->notify(new UserAlert($request->input('alert_title'),$request->input('alert_body')));
        }
        return redirect(route('event.index'));
    }


}
