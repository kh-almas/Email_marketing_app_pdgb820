<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class spamCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendgrid:spam';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect spam email from sendgrid';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new \App\Actions\SendGrid\Spam_Reporte)->updateSpamList();
        return 0;
    }
}
