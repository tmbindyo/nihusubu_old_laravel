<?php

namespace App\Console\Commands;

use App\Expense;
use App\Frequency;
use App\Institution;
use Illuminate\Console\Command;
use App\Traits\ReferenceNumberTrait;
use App\Transaction;

class InstitutionRecurringExpense extends Command
{

    use ReferenceNumberTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:institution_expense';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task to schedule coming up recurring institution expenses.';

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
        // Get institutions
        $institutions = Institution::where('is_active', True)->get();
        foreach ($institutions as $institution){
            // get institution frequencies
            $frequencies = Frequency::where('is_institution',True)->where('institution_id',$institution->id)->get();
            foreach ($frequencies as $frequency){

                $datesum = date('d-m-Y', strtotime($today.' + '.$frequency->frequency.' '.$frequency->type));

                // Expenses
                $expenses = Expense::where('frequency_id',$frequency->id)->where('is_recurring',True)->where('is_institution',True)->whereDate('end_repeat', '<', $datesum)->get();
                foreach ($expenses as $expense){
                    $size = 5;
                    $reference = $this->getRandomString($size);
                    // create transaction
                    $transaction = new Transaction();
                    $transaction->expense_id = $expense->id;
                    $transaction->account_id = $expense->account;
                    $transaction->amount = $expense->amount;

                    $transaction->initial_amount = 0;
                    $transaction->subsequent_amount = 0;

                    $transaction->reference = $reference;
                    $transaction->date = date('Y-m-d', strtotime($datesum));
                    $transaction->notes = $expense->notes;
                    $transaction->user_id = 1;
                    $transaction->status_id = 'a40b5983-3c6b-4563-ab7c-20deefc1992b';
                    $transaction->is_user = False;
                    $transaction->is_institution = True;
                    $transaction->save();
                }
            }
        }
        $this->info('Recurring expenses regenerated');


    }
}
