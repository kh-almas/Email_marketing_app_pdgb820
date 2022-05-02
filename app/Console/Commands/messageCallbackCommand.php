<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class messageCallbackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:callback';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get sms information from nexmo';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new \App\Actions\Vonage\Send_Sms())->status();
        return 0;
    }
}
