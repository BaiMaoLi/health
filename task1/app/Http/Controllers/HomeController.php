<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Category0;
use App\Category1;
use App\Category2;
use App\Category3;
use App\recorder;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//
    }
    public function page_2()
    {
        $user=auth::user();
        $user_id=$user->id;
        $result0=Array();
        for ($i=0;$i<5;$i++){
            $result0[$i]['id']=0;
            $result0[$i]['first_name']='';
            $result0[$i]['last_name']='';
            $result0[$i]['email']='';
            $result0[$i]['phone']='';

        }
        $record=recorder::where('user_id',$user_id)->get();
        $i=0;
        foreach ($record as $recorder0){
            $result0[$i]['id']=$recorder0->id;
            $result0[$i]['first_name']=$recorder0->first_name;
            $result0[$i]['last_name']=$recorder0->last_name;
            $result0[$i]['phone']=$recorder0->phone;
            $result0[$i]['email']=$recorder0->email;
            $i++;
        }

        $user=auth::user();
        $user_id=$user->id;
        $result1=Array();
        for ($i=0;$i<10;$i++){
            $result1[$i]['id']=0;
            $result1[$i]['first_name']='';
            $result1[$i]['last_name']='';
            $result1[$i]['email']='';
            $result1[$i]['phone']='';
            $result1[$i]['statues']='';

        }
        $categories=Category0::where('user_id',$user_id)->get();
        $i=0;
        foreach ($categories as $category){
            $result1[$i]['id']=$category->id;
            $result1[$i]['first_name']=$category->first_name;
            $result1[$i]['last_name']=$category->last_name;
            $result1[$i]['phone']=$category->phone;
            $result1[$i]['email']=$category->email;
            if(($category->statues)!='')
                $result1[$i]['statues']=$category->statues;

            $i++;
        }

        return view('page2',compact('result0','result1'));
    }
    public function homepage()
    {
        if (auth::check())
            return view('page2');
        else
            return view('homepage');
    }
    public function page3()
    {
        $user=auth::user();
        $user_id=$user->id;
        $result=Array();
        for ($i=0;$i<10;$i++){
            $result[$i]['id']=0;
            $result[$i]['first_name']='';
            $result[$i]['last_name']='';
            $result[$i]['email']='';
            $result[$i]['phone']='';
            $result[$i]['statues']='';

        }
        $categories=Category1::where('user_id',$user_id)->get();
        $i=0;
        foreach ($categories as $category){
            $result[$i]['id']=$category->id;
            $result[$i]['first_name']=$category->first_name;
            $result[$i]['last_name']=$category->last_name;
            $result[$i]['phone']=$category->phone;
            $result[$i]['email']=$category->email;
            if(($category->statues)!='')
            $result[$i]['statues']=$category->statues;

            $i++;
        }

        $result2=Array();
        for($i=0;$i<5;$i++){
            $result2[$i]['id']=0;
            $result2[$i]['first_name']='';
            $result2[$i]['last_name']='';
            $result2[$i]['phone']='';
            $result2[$i]['email']='';
            $result2[$i]['statues']='';
        }
        $categories2=Category2::where('user_id',$user_id)->get();
        $i=0;
        foreach($categories2 as $category2 ){
            $result2[$i]['id']=$category2->id;
            $result2[$i]['first_name']=$category2->first_name;
            $result2[$i]['last_name']=$category2->last_name;
            $result2[$i]['phone']=$category2->phone;
            $result2[$i]['email']=$category2->email;
            if(($category2->statues)!='')
                $result2[$i]['statues']=$category2->statues;
            $i++;
        }


        $result3=Array();
        for($i=0;$i<5;$i++){
            $result3[$i]['id']=0;
            $result3[$i]['first_name']='';
            $result3[$i]['last_name']='';
            $result3[$i]['phone']='';
            $result3[$i]['email']='';
            $result3[$i]['statues']='';
        }
        $categories3=Category3::where('user_id',$user_id)->get();
        $i=0;
        foreach($categories3 as $category3 ){
            $result3[$i]['id']=$category3->id;
            $result3[$i]['first_name']=$category3->first_name;
            $result3[$i]['last_name']=$category3->last_name;
            $result3[$i]['phone']=$category3->phone;
            $result3[$i]['email']=$category3->email;
            if(($category3->statues)!='')
                $result3[$i]['statues']=$category3->statues;
            $i++;
        }


        return view('page3',compact('result2','result','result3'));
    }
    public function page4()
    {
        return view('page4');
    }
    public function page5()
    {
        return view('page5');
    }
    public function page6()
    {
        return view('page6');
    }
    public function page7()
    {
        return view('page7');
    }
    public function page1()
    {
        return view('page1');
    }
}
