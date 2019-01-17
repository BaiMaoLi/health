<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\admin\Task;
use App\Model\admin\Task_User;
use App\Model\admin\IndividualTask;
use App\Model\admin\IndividualTask_User;

class checkTaskDuration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkTask:checkTask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make All Users Incomplete for Expired Task';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this_year=(new \DateTime())->format('Y');
        $tasks=Task::all();
        foreach ($tasks as $task){
            $task_duration=substr($task->task_duration,0,1);
            $created_year=(new \DateTime($task->created_at))->format('Y');
            if (((int)$this_year-(int)$created_year) % (int)$task_duration ==0){
                $task_users=Task_User::where('task_id',$task->id)->get();
                foreach($task_users as $task_user){
                    $task_user->delete();
                }
            }
        }

        $tasks=IndividualTask::all();
        foreach ($tasks as $task){
            $task_duration=substr($task->task_duration,0,1);
            $created_year=(new \DateTime($task->created_at))->format('Y');
            if (((int)$this_year-(int)$created_year) % (int)$task_duration ==0){
                $task_users=IndividualTask_User::where('task_id',$task->id)->get();
                foreach($task_users as $task_user){
                    $task_user->delete();
                }
            }
        }

    }
}
