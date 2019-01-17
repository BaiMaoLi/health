<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;




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

class userExport implements FromCollection,ShouldAutoSize,WithEvents
{
    use Exportable;

    public function collection()
    {
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
//        $collect=collect(['Name'=>$user_print_data['user_name'],'Email'=>$user_print_data['email'],'Employee ID'=>$user_print_data['employee_id'],
//                          'Gender'=>$user_print_data['gender'],'Birthday'=>$user_print_data['birthday'],'Phone'=>$user_print_data['phone'],
//                          'Address'=>$user_print_data['address'],'City'=>$user_print_data['city'],'State'=>$user_print_data['state'],'Zip'=>$user_print_data['zip']]);
//
//
//        return $collect;
        $collect=collect();
        $collect->push([
            'Name'=>'Name',
            'Email'=>'Email',
            'Employee ID'=>'Employee ID',
            'Wellness Star'=>'Wellness Star',
            'Gender'=>'Gender',
            'Birthday'=>'Birthday',
            'Phone'=>'Phone Number',
            'Address'=>'Address',
            'City'=>'City',
            'State'=>'State',
            'Zip'=>'Zip Code',
        ]);
        for ($i=0;$i<count($user_print_data['user_name']);$i++){
            $collect->push([
                'Name'=>$user_print_data['user_name'][$i],
                'Email'=>$user_print_data['email'][$i],
                'Employee ID'=>$user_print_data['employee_id'][$i],
                'Wellness Star'=>$user_print_data['total_complete_star'][$i],
                'Gender'=>$user_print_data['gender'][$i],
                'Birthday'=>$user_print_data['birthday'][$i],
                'Phone'=>$user_print_data['phone'][$i],
                'Address'=>$user_print_data['address'][$i],
                'City'=>$user_print_data['city'][$i],
                'State'=>$user_print_data['state'][$i],
                'Zip'=>$user_print_data['zip'][$i],
            ]);

        }
//        $collect=collect(['Name'=>$user_print_data['user_name'],'Email'=>$user_print_data['email'],'Employee ID'=>$user_print_data['employee_id'],
//            'Gender'=>$user_print_data['gender'],'Birthday'=>$user_print_data['birthday'],'Phone'=>$user_print_data['phone'],
//            'Address'=>$user_print_data['address'],'City'=>$user_print_data['city'],'State'=>$user_print_data['state'],'Zip'=>$user_print_data['zip']]);


        return $collect;
    }


    public function upperUsername($user){
        $user->first_name=ucfirst($user->first_name);
        $user->last_name=ucfirst($user->last_name);
        return $user;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            }
        ];
    }
}
