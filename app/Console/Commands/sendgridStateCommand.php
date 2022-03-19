<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendgridStateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendgrid:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve sendgrid global email statistics';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //'2022-03-01' //format
        $start_date = '2022-01-01';
        $response = (new \App\Actions\SendGrid\Global_Statistics)->getTotalStat($start_date);
        return 'data collected';
    }
}
