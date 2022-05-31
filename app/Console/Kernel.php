<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();everyMinute
         $schedule->command('sendgrid:stats')->daily()->withoutOverlapping();
         $schedule->command('sendgrid:daily_stats')->everyMinute()->withoutOverlapping();
         $schedule->command('sendgrid:dashboard_stats')->everyMinute()->withoutOverlapping();
         $schedule->command('sendgrid:spam')->everyMinute()->withoutOverlapping();
         $schedule->command('sms:send')->everyMinute()->withoutOverlapping();
         $schedule->command('sms:callback')->everyMinute()->withoutOverlapping();
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
