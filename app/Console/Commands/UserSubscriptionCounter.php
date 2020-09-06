<?php

namespace App\Console\Commands;

use App\Expense;
use App\User;
use App\Frequency;
use App\Income;
use App\IncomeDebit;
use App\Transaction;
use App\UserAccount;
use Illuminate\Console\Command;

class UserSubscriptionCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptioncounter:user';

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

        // Date today
        $today = date('Y-m-d');





        $this->info('Recurring expenses regenerated');

    }
}
