<?php

namespace App\Console\Commands;

use App\Institution;
use App\InstitutionModule;
use App\Subscription;
use App\SubscriptionModule;
use Illuminate\Console\Command;

class SubscriptionChecker extends Command
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

        // this function checks if the subscription is valid

        $subscriptionData = array();

        $subscriptions = Subscription::where('month',now()->format('m'))->where('year',now()->format('yy'))->get();
        foreach($subscriptions as $subscription){
            $totalCost = 0;
            $institutionModuleData = array();
            $institutionModules = InstitutionModule::where('institution_id',$subscription->institution_id)->with('subscriptionModules', 'totalSubsciption', 'module', 'status')->get();
            foreach($institutionModules as $institutionModule){
                $moduleCost = 0;
                $subscriptionModules = SubscriptionModule::where('institution_module_id',$institutionModule->id)->where('month',now()->format('m'))->where('year',now()->format('yy'))->get();
                foreach ($subscriptionModules as $subscriptionModule){
                    $moduleCost += $subscriptionModule->amount;
                }
                $totalCost += $moduleCost;
                $institutionSubscriptionData = array();
                $institutionSubscriptionData['id'] = $institutionModule->id;
                $institutionSubscriptionData['module_id'] = $institutionModule->module_id;
                $institutionSubscriptionData['module'] = $institutionModule->module->name;
                $institutionSubscriptionData['cost'] = $moduleCost;
                $institutionSubscriptionData['status_id'] = $institutionModule->status_id;
                $institutionSubscriptionData['status'] = $institutionModule->status->name;
                $institutionSubscriptionData['subscription_modules'] = $subscriptionModules;
                $institutionModuleData[] = $institutionSubscriptionData;
                // update module cost
            }

            $subArray = array("subscription" => $subscription, "institutionModules"=>$institutionModuleData);
            $subscriptionData[] = $subArray;
            // update subscription cost
            // $subscription->amount =
        }
        return $subscriptionData[0]['institutionModules'][2]['cost'];

        $this->info('Recurring expenses regenerated');

    }
}
