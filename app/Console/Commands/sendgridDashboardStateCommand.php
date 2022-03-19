<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendgridDashboardStateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendgrid:dashboard_stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate state for dashboard';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new \App\Actions\SendGrid\Global_Statistics)->avgState(1);
        (new \App\Actions\SendGrid\Global_Statistics)->avgState(7);
        (new \App\Actions\SendGrid\Global_Statistics)->avgState(30);
        return 0;
    }
}
