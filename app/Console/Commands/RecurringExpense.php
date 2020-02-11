<?php

namespace App\Console\Commands;

use App\Expense;
use App\Frequency;
use App\Income;
use App\IncomeDebit;
use App\Transaction;
use Illuminate\Console\Command;

class RecurringExpense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:expense';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task to schedule coming up recurring expenses.';

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

        // get all users
        $users = User::all();
        foreach ($users as $user){

            $frequencies = Frequency::where('is_user',True)->where('user_id',$user->id)->get();

            foreach ($frequencies as $frequency){
                $datesum = date('d-m-Y', strtotime($today.' + '.$frequency->frequency.' '.$frequency->type));
                $incomes = Income::where('frequency_id',$frequency->id)->where('is_recurring',True)->whereDate('end_repeat', '<', $datesum)->get();

                foreach($incomes as $income){
                    $size = 5;
                    $reference = $this->getRandomString($size);
                    $incomeDebit = new IncomeDebit();
                    $incomeDebit->reference = $reference;
                    $incomeDebit->date = date('Y-m-d', strtotime($datesum));
                    $incomeDebit->amount = $income->amount;
                    $incomeDebit->account_id = $income->account;
                    $incomeDebit->status_id = 'a40b5983-3c6b-4563-ab7c-20deefc1992b';
                    $incomeDebit->income_id = $income->id;
                    $incomeDebit->user_id = $user->id;
                    $incomeDebit->is_debited = True;
                    $incomeDebit->save();

                }
            }
        }

        $this->info('Recurring expenses regenerated');

    }
}
