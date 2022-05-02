<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendSmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send sms';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new \App\Actions\Vonage\Send_Sms())->send();
        return 0;
    }
}
