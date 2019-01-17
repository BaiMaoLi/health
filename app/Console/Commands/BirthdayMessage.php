<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\user\User;
use App\Model\user\profile;
use App\Notifications\UserAlert;

class BirthdayMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthdaymessage:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Our Ptihealth.com congratulate your birthday. Enjoy your birthday.';

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
        $today=(new \DateTime())->format('m/d');





        $profiles=profile::where('birthday','LIKE','%'.$today.'%')->get();

        foreach ($profiles as $profile){
            $temp=User::where('email',$profile->email)->get();
            if ($temp->first()) {
                $user = $temp->first();
                $user->notify(new UserAlert('Wishing you a Happy Birthday!',''));
            }
        }

    }
}

