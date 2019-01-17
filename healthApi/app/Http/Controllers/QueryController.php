<?php

namespace App\Http\Controllers;

//use http\Env\Response;
//use http\QueryString;
//use MongoDB\Driver\ReadConcern;

use Illuminate\Http\Request;
use App\Query;
use App\queryCategory;
use App\scoreInterp;
use App\UserProfile;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    function insertQueryCategory(Request $request){
        $queryCategory=new queryCategory;
        $queryCategory->category_name=$request->input('category_name');
        if(!is_null($request->input('happy_marks')))
            $queryCategory->happy_marks=$request->input('happy_marks');
        if(!is_null($request->input('excellent_marks')))
            $queryCategory->excellent_marks=$request->input('excellent_marks');
        if(!is_null($request->input('good_marks')))
            $queryCategory->good_marks=$request->input('good_marks');
        if(!is_null($request->input('bad_marks')))
            $queryCategory->bad_marks=$request->input('bad_marks');
        $queryCategory->save();
        return 'success';
    }

    function getQueryCategory(){
        $query_categories=queryCategory::all();
        $result=Array();
        $i=0;
        foreach ($query_categories as $query_category){
            $result[$i]=$query_category['category_name'];
            $i++;
        }
        return response()->json(['result'=>$result]);
    }



    function getQuery(Request $request){   //Get Query
        $category_name=$request->input('category_name');
        $category=queryCategory::where('category_name',$category_name)->get();
        if ($category->first()){
            $category_id=$category->first()->id;
            $queries=Query::where('category_id',$category_id)->get();
            $result=Array();
            $index=0;
            foreach ($queries as $query){
                $prefix=$query->prefix;
                if (!is_null($prefix))
                    $result[$index]['query']=$query->prefix."(".$query->query.")";
                else
                    $result[$index]['query']=$query->query;
                $result[$index]['results_string']=$query->results_string;
                $result[$index]['results_value']=$query->results_value;
                $index++;
            }
            return response()->json(['result'=>$result]);
        }
        else
            return $category_name;


    }

    function insertQuery(Request $request){
        $category_name=$request->input('category_name');
        $category=queryCategory::where('category_name',$category_name)->get()->first();
        $category_id=$category->id;
        $query=new Query;
        $query->category_id=$category_id;
        if (!is_null($request->input('prefix')))
            $query->prefix=$request->input('prefix');
        $query->query=$request->input('query');
        $query->results_string=$request->input('results_string');
        $query->results_value=$request->input('resutls_value');
        $query->save();
        return response()->json(['result'=>'Fail']);
    }

    function insertScoreInterp(Request $request){
        $scoreInterp=new scoreInterp;
        $scoreInterp->general_health=$request->input('general_health');
        $scoreInterp->fitness_bmi=$request->input('fitness_bmi');
        $scoreInterp->habits=$request->input('habits');
        $scoreInterp->level=$request->input('level');
        $scoreInterp->save();
        return 'success';
    }

    function saveQueryResult(Request $request){
        $score_history=(int)$request->input('history');
        $score_fitness=(int)$request->input('fitness');
        $score_emotial=(int)$request->input('emotial');
        $score_nutrition=(int)$request->input('nutrition');
        $score_lifestyle=(int)$request->input('lifestyle');
        $score_markers=(int)$request->input('markers');
        $score_bmi=(int)$request->input('bmi');

        $general_health='bad';
        $fitness="bad";
        $habits='bad';

    //---------  General Health Part  --------------//
        if ($score_history>=17){
            if ($score_markers>=24)
                $general_health='excellent';
            elseif ( $score_markers>=22)
                $general_health='good';
        }
        elseif($score_history>=15){
            if ($score_markers>=24)
                $general_health='happy zone';
            elseif ( $score_markers>=22)
                $general_health='good';
        }


    //---------  Fitness Part  ------------------//
        if ($score_bmi>=6){
            if ($score_fitness>=18)
                $fitness='excellent';
            elseif($score_bmi>=17)
                $fitness='happy zone';
            elseif ($score_bmi>=16)
                $fitness='good';
        }
        elseif($score_bmi>=4){
            if ($score_fitness>=17)
                $fitness='happy zone';
            elseif($score_bmi>=16)
                $fitness='good';
        }

    // -----------  Habits Part  ------------------//
        if ($score_emotial>=21){
            if ($score_lifestyle>=10){
                if ($score_nutrition>=15)
                    $habits='good';
                elseif($score_nutrition>=13)
                    $habits='happy zone';
            }
            elseif($score_lifestyle>=9){
                if ($score_nutrition>=13)
                    $habits='happy zone';
            }
        }

    //-----------  Getting Level  --------------//

        $level=1;
        $score_interp1=scoreInterp::where([['general_health','=',$general_health],['fitness_bmi','=',$fitness],['habits','=',$habits]])->get();
        if ($score_interp1->first())
            $level=$score_interp1->first()->level;
        $user=Auth::user();
        $user_profile=UserProfile::where('user_id',$user->id)->get()->first();
        $user_profile->level=$level;
        $user_profile->save();
        return response()->json(['level'=>$level]);
//          return response()->json(['general_health'=>$general_health,'fitness'=>$fitness,'habbits'=>$habits]);
    }



}

