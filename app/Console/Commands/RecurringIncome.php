<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RecurringIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:income';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task to schedule coming up recurring income';

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


        // TODO send notification of generation
    }
}
