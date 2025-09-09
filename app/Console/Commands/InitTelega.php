<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\HttpKernel\Controller\TraceableArgumentResolver;
use Telegram\Bot\Laravel\Facades\Telegram;

class InitTelega extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-telega';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First load of telega';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Telegram::getMe();

        $this->output->writeln(json_encode($response));
        $this->output->writeln('Set webhook');
        $this->output->writeln(Telegram::getBotConfig()['webhook_url']);
        Telegram::deleteWebhook();
        Telegram::setWebhook(['url' => Telegram::getBotConfig()['webhook_url']]);

        Telegram::commandsHandler(true);


    }
}
