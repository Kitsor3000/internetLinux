<?php

namespace App\Console\Commands;

use App\Telegram\Commands\HelpCommand;
use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class FakeMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fake-message';

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
        $this->output->writeln('Fake message');

        Telegram::sendMessage(['chat_id' => '318286890', 'text' => __('telegram.u_have_verified')]);

    }
}
