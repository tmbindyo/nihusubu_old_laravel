<?php

namespace App\Console\Commands;

use App\Institution;
use App\InstitutionModule;
use App\Subscription;
use App\SubscriptionModule;
use Illuminate\Console\Command;

class SubscriptionRenewal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:renewal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task to schedule calculation of sunscription cost.';

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

        // generates subscription records for the next month for all active accounts

        $today = date('Y-m-d');
        $nextMonth = date('m', strtotime($today. ' + 1 month'));
        $testSubscriptionMonth = now()->format('m');
        if($testSubscriptionMonth == 12){
            $trialEnd = date('Y-m-d', strtotime(now(). '+ 1 year'));
            $subscriptionYear = date('Y', strtotime(now(). '+ 1 year'));
            $subscriptionMonth = 1;
        }else{
            $subscriptionYear = now()->format('yy');
            $subscriptionMonth = date('m', strtotime(now(). '+ 1 month'));
        }
        $subscriptions = Subscription::where('is_active',true)->where('month', now()->format('m'))->where('year', now()->format('yy'))->with('institution')->get();
        foreach($subscriptions as $subscription){
            // check if subscription for month already exists

            // check if trial
            if($subscription->trial_duration >0){
                // get the date the institution was registered
                $institution = Institution::where('id',$subscription->institution_id)->first();
                $institutionRegistered = date('Y-m-d', strtotime($subscription->institution->created_at));
                $trialEnd = date('Y-m-d', strtotime($subscription->institution->created_at. '+ 90 days'));
                // return $institutionRegistered.':'.$trialEnd;
                // check if the institution is past the trial period
                $secs = strtotime($trialEnd) - strtotime($today);
                $days = $secs / 86400;


                $trialDuration = $days;

            }else{
                $trialDuration = 0;
            }

            // check if subscription exists
            $subscriptionChecker = Subscription::where('institution_id',$subscription->institution->id)->where('year', $subscriptionYear)->where('month', $subscriptionMonth)->first();
                if($subscriptionChecker){
                    $subscriptionExists = true;
                }else{
                    // create new subscription for next month
                $nextMonthSubscription = new Subscription();
                $nextMonthSubscription->trial_duration = $trialDuration;
                $nextMonthSubscription->amount = 0;
                $nextMonthSubscription->start_date = now();
                $nextMonthSubscription->month = $subscriptionMonth;
                $nextMonthSubscription->year = $subscriptionYear;
                $nextMonthSubscription->is_institution = true;
                $nextMonthSubscription->is_user = false;
                $nextMonthSubscription->is_active = false;
                $nextMonthSubscription->institution_id = $subscription->institution->id;
                $nextMonthSubscription->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
                $nextMonthSubscription->user_id = 1;
                $nextMonthSubscription->is_paid = false;
                $nextMonthSubscription->save();

                // create institution module records
                $institutionModules = InstitutionModule::where('institution_id',$subscription->institution_id)->with('subscriptionModules', 'totalSubsciption', 'module', 'status')->get();
                foreach($institutionModules as $institutionModule){
                    // check if subscription module exists
                    $subscriptionModuleExists = SubscriptionModule::where('institution_id',$subscription->institution->id)->where('module_id', $institutionModule->module->id)->where('year', now()->format('yy'))->where('month', $subscriptionMonth)->first();
                    // create institution module subscription tracker
                    $subscriptionModule = new SubscriptionModule();
                    $subscriptionModule->amount = 0;
                    $subscriptionModule->month = $subscriptionMonth;
                    $subscriptionModule->year = $subscriptionYear;
                    $subscriptionModule->last_updated = date('Y-m-d', strtotime(now()));
                    $subscriptionModule->start_date = now();
                    $subscriptionModule->module_id = $institutionModule->module->id;
                    $subscriptionModule->subscription_id = $nextMonthSubscription->id;
                    $subscriptionModule->institution_module_id = $institutionModule->id;
                    $subscriptionModule->institution_id = $subscription->institution->id;
                    $subscriptionModule->status_id = 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e';
                    $subscriptionModule->user_id = 1;
                    $subscriptionModule->is_active = true;
                    $subscriptionModule->save();
                }
            }


        }

        $this->info('Subscription renewal regenerated');

    }
}
