<?php

namespace App\Http\Controllers;
use App\Category0;
use App\Category1;
use App\Category2;
use App\Category3;
use App\address2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CartegoryController extends Controller
{
    public function addCategory(Request $request)
    {


        $user=auth::user();
        $user_id=$user->id;
//        echo "<pre>";
//        print_r($request->toArray());
//        exit();
        for ($i = 0; $i < 10; $i++) {




            $id = $request->input('id-' . $i);
            if (!is_null($request->input('first_name-' . $i))) {
                $category1 = null;
                if ($id != 0) {
                    $category1 = Category1::find($id);
                } else
                    $category1 = new Category1;
                if (!is_null($request->input('check-'.$i)))
                $category1->statues = 'checked';
                else
                $category1->statues = '';


                $category1->first_name = $request->input('first_name-' . $i);
                $category1->last_name = $request->input('last_name-' . $i);
                $category1->phone = $request->input('phone-' . $i);
                $category1->email = $request->input('email-' . $i);
                $category1->user_id = $user_id;
                $category1->save();
            }
           if(is_null($request->input('first_name-' . $i)) && is_null($request->input('last_name-' . $i)) && is_null($request->input('phone-' . $i)) && is_null($request->input('email-' . $i))){
                $del=Category1::find($id);
              if (!is_null($del)){ $del->delete();}
            }
        }
        return redirect('/page3');
    }
    public function addCategory0(Request $request)
    {
        $user=auth::user();
        $user_id=$user->id;
//        echo "<pre>";
//        print_r($request->toArray());
//        exit();
        for ($i = 0; $i < 10; $i++) {
            $id = $request->input('id-' . $i);
            if (!is_null($request->input('first_name-' . $i))) {
                $category0 = null;
                if ($id != 0) {
                    $category0 = Category0::find($id);
                } else
                    $category0 = new Category0;
                if (!is_null($request->input('check-'.$i)))
                    $category0->statues = 'checked';
                else
                    $category0->statues = '';

                $category0->first_name = $request->input('first_name-' . $i);
                $category0->last_name = $request->input('last_name-' . $i);
                $category0->phone = $request->input('phone-' . $i);
                $category0->email = $request->input('email-' . $i);
                $category0->user_id = $user_id;
                $category0->save();
            }
            if(is_null($request->input('first_name-' . $i)) && is_null($request->input('last_name-' . $i)) && is_null($request->input('phone-' . $i)) && is_null($request->input('email-' . $i))){
                $del=Category0::find($id);
                if (!is_null($del)){ $del->delete();}
            }
        }
        return redirect('/page2');
    }
    public function addCategory2(Request $request)
    {
        $user = auth::user();
        $user_id = $user->id;

        for ($i = 0; $i < 5; $i++) {
            $id = $request->input('id-' . $i);
            if (!is_null($request->input('first_name-' . $i))) {
                $category2 = null;
                if ($id != 0) {
                    $category2 = Category2::find($id);
                } else
                    $category2 = new Category2;

                if (!is_null($request->input('check-'.$i)))
                    $category2->statues = 'checked';
                else
                    $category2->statues = '';

                $category2->first_name = $request->input('first_name-' . $i);
                $category2->last_name = $request->input('last_name-' . $i);
                $category2->phone = $request->input('phone-' . $i);
                $category2->email = $request->input('email-' . $i);
                $category2->user_id = $user_id;
                $category2->save();
            }
            if (is_null($request->input('first_name-' . $i)) && is_null($request->input('last_name-' . $i)) && is_null($request->input('phone-' . $i)) && is_null($request->input('email-' . $i))) {
                $del = Category2::find($id);
                if (!is_null($del)) {
                    $del->delete();
                }
            }
        }
        return redirect('/page3');
    }
    public function addCategory3(Request $request)
    {
        $user = auth::user();
        $user_id = $user->id;

        for ($i = 0; $i < 5; $i++) {
            $id = $request->input('id-' . $i);
            if (!is_null($request->input('first_name-' . $i))) {
                $category2 = null;
                if ($id != 0) {
                    $category2 = Category3::find($id);
                } else
                    $category2 = new Category3;

                if (!is_null($request->input('check-'.$i)))
                    $category2->statues = 'checked';
                else
                    $category2->statues = '';

                $category2->first_name = $request->input('first_name-' . $i);
                $category2->last_name = $request->input('last_name-' . $i);
                $category2->phone = $request->input('phone-' . $i);
                $category2->email = $request->input('email-' . $i);
                $category2->user_id = $user_id;
                $category2->save();
            }
            if (is_null($request->input('first_name-' . $i)) && is_null($request->input('last_name-' . $i)) && is_null($request->input('phone-' . $i)) && is_null($request->input('email-' . $i))) {
                $del = Category2::find($id);
                if (!is_null($del)) {
                    $del->delete();
                }
            }
        }
        return redirect('/page3');


    }
    public function address(request $request){
        $address2 = new address2;

        $address2->name2=$request->input('name2');
        $address2->address2=$request->input('address2');
        $address2->phone2=$request->input('phone2');
        $address2->save();
        return redirect('/page4');
    }

    public function address1(request $request){
//        $categories=Category1::where('user_id',$user_id)->get();

        $address1 = new address2;
        $address1->name2=$request->input('name2');
        $address1->address2=$request->input('address2');
        $address1->phone2=$request->input('phone2');
        $address1->save();
        return redirect('/page7');
    }
}
