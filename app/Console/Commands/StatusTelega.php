<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class StatusTelega extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:status-telega';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->writeln('Status Telega');
        $this->output->writeln(json_encode(Telegram::getWebhookInfo()));
        $this->output->writeln(json_encode(Telegram::getWebhookUpdate()));
        $this->output->writeln('End Status Telega');
    }
}
