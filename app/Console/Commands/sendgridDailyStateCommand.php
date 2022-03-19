<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendgridDailyStateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendgrid:daily_stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve sendgrid global email statistics daily';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start_date = now()->format('Y-m-d');
        $response = (new \App\Actions\SendGrid\Global_Statistics)->updateLastDaysStat($start_date);
        return 0;
    }
}
