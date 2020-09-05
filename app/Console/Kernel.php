<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\InstitutionRecurringExpense::class,
        Commands\RecurringExpense::class,
        Commands\RecurringIncome::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('recurring:institution_expense')->daily();
        $schedule->command('recurring:expense')->daily();
        $schedule->command('recurring:income')->daily();
        $schedule->command('freetrial:checker')->daily();
        $schedule->command('subscriptioncounter:institution')->daily();
        // $schedule->command('subscription:renewal')->lastDayOfMonth('17.00');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
