<?php

namespace App\Console\Commands;

use App\Notifications\AccountExpiration;
use App\subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class expire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
//        date('Y-m-d',strtotime(subscription::find(6)->end)) ==
        $users_id = subscription::where('end', '=', Carbon::now()->addDays(2)->format('Y-m-d 00:00:00'))->pluck('user_id')->toArray();
        $subscribers = subscription::where('end', '=', Carbon::now()->addDays(2)->format('Y-m-d 00:00:00'))->get();
        $users = User::whereIn('id',$users_id)->get();
        //Notify related user about account emigrations
        foreach ($users as $user){
            foreach ($subscribers as $subscriber){
                $user->notify(new AccountExpiration($subscriber->name_ar,$subscriber->name_en,$subscriber->end));
            }
        }

    }
}
