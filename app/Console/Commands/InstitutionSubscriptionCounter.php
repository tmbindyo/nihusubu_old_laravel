<?php

namespace App\Console\Commands;

use App\Institution;
use App\InstitutionModule;
use App\Subscription;
use App\SubscriptionModule;
use Illuminate\Console\Command;

class InstitutionSubscriptionCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptioncounter:institution';

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

        // runs daily and on a daily accumilates the amount of money owed.

        $subscriptions = Subscription::where('is_active',true)->where('month',now()->format('m'))->where('year',now()->format('yy'))->get();
        foreach($subscriptions as $subscription){
            $totalCost = 0;
            $institutionModules = InstitutionModule::where('institution_id',$subscription->institution_id)->with('subscriptionModules', 'totalSubsciption', 'module', 'status')->get();
            foreach($institutionModules as $institutionModule){
                $moduleCost = 0;
                $subscriptionModules = SubscriptionModule::where('institution_module_id',$institutionModule->id)->where('month',now()->format('m'))->where('year',now()->format('yy'))->get();
                foreach ($subscriptionModules as $subscriptionModule){
                    if($subscriptionModule->is_active){
                        $subscriptionModule->amount = $subscriptionModule->amount+$institutionModule->module->daily_price;
                        $subscriptionModule->last_updated = date('Y-m-d');
                        $subscriptionModule->save();
                    }
                    // get last updated
                    // return $subscriptionModule;
                    $moduleCost += $subscriptionModule->amount;

                }
                $totalCost += $moduleCost;
            }

            // update subscription cost
            $subscription->amount = $totalCost;
            $subscription->save();
            // $subscription->amount =
        }



        $this->info('Recurring expenses regenerated');

    }
}
