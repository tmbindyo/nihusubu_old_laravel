<?php

namespace App\Console\Commands;

use App\Expense;
use App\User;
use App\Frequency;
use App\Income;
use App\IncomeDebit;
use App\Mail\FreeTrial1Month;
use App\Mail\FreeTrial2Weeks;
use App\Mail\FreeTrialOver;
use App\Subscription;
use App\Transaction;
use App\UserAccount;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;

class FreeTrialChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'freetrial:checker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task to check the free trial.';

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
        // monthly
        // checks if the trial has come to an end, if yes,

        // Date today
        $today = date('Y-m-d');
        $lastDayOfMonth = date('Y-m-d');
        $subscriptions = Subscription::where('is_trial',true)->with('institution')->get();
        foreach($subscriptions as $subscription){
            //trial_duration
            $trialEnd = date('Y-m-d', strtotime($today. ' + '.$subscription->trial_duration.' days'));
            $secs = strtotime($trialEnd) - strtotime($subscription->created_at);
            $days = $secs / 86400;
            // first check if its overdue
            if($days <= 0 && $today = $lastDayOfMonth){
                // second check is if the trial has expired
                // update subscription to not valid
                $subscription->is_paid = false;
                $subscription->is_active = false;
                $subscription->save();
                // send email to inform
            }elseif($days == 1 ){
                // first check is if the subscription is remaining with 1 day, send an email.
                // get institution admins
                $roleName = $subscription->institution->portal.' admin';
                $institutionAdmin = Role::where('institution_id',$subscription->institution_id)->where('name',$roleName)->get();
                $roleUsers = User::role($institutionAdmin)->with('roles')->get();
                foreach($roleUsers as $roleUser){
                    Mail::to($roleUser->email)->send(new FreeTrialOver($subscription));
                }
            }elseif($days == 14 ){
                // $days > 1 && $days <= 14
                // first check is if the subscription is remaining with 2 weeks, send an email.
                // get institution admins
                $roleName = $subscription->institution->portal.' admin';
                $institutionAdmin = Role::where('institution_id',$subscription->institution_id)->where('name',$roleName)->get();
                $roleUsers = User::role($institutionAdmin)->with('roles')->get();
                foreach($roleUsers as $roleUser){
                    Mail::to($roleUser->email)->send(new FreeTrial2Weeks($subscription));
                }
            }elseif($days == 28 ){
                //$days > 14 && $days <= 28
                // first check is if the subscription is remaining with 1 month, send an email.
                // get institution admins
                $roleName = $subscription->institution->portal.' admin';
                $institutionAdmin = Role::where('institution_id',$subscription->institution_id)->where('name',$roleName)->get();
                $roleUsers = User::role($institutionAdmin)->with('roles')->get();
                foreach($roleUsers as $roleUser){
                    Mail::to($roleUser->email)->send(new FreeTrial1Month($subscription));
                }
            }
        }
        $this->info('Free trials have been checked');
    }
}
