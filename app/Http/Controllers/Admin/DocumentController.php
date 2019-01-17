<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\Event;
use App\Model\admin\event_user;
use App\Model\admin\Category;
use App\Model\admin\Tag;
use App\Model\user\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Notifications\EventAlert;

class DocumentController extends Controller
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
        $documents=Document::all();
        return view('admin.document.show',compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.document.create');
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
            'title'=>'required',
            'file'=>'required|mimes:pdf,doc,docx|max:10000'
        ]);
        $document=new Document;
        $document->title=$request->input('title');
        $document->age=$request->input('age');
        $document->gender=$request->input('gender');

        if(Input::hasFile('file')){
            $file = $request->file('file');
            $file->move(public_path().'/documents',$file->getClientOriginalName());
//            $url=URL::to("/").'/public/documents/'.$file->getClientOriginalName();
            $url=$file->getClientOriginalName();
            $document->url = $url;
        }
        $document->save();


        return redirect(route('health-forms.index'))->with('message','Document uploaded Successfully');


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
        return view('admin.event.registered_users',compact('users'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::find($id);
        return view('admin.document.edit',compact('document'));
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
            'title'=>'required',
            'file'=>'max:10000'
        ]);
        $document = Document::find($id);
        $document->title=$request->input('title');
        $document->age=$request->input('age');
        $document->gender=$request->input('gender');

        if(Input::hasFile('file')){
            $file = $request->file('file');
            $file->move(public_path().'/documents',$file->getClientOriginalName());
//            $url=URL::to("/").'/public/documents/'.$file->getClientOriginalName();
            $url=$file->getClientOriginalName();
            File::delete('public/documents/'.$document->url);
            $document->url = $url;
        }
        $document->save();

        return redirect(route('health-forms.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document=Document::find($id);
        File::delete('public/documents/'.$document->url);
        $document->delete();
        return redirect()->back()->with('message','Document deleted successfully');
    }
}
