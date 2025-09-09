<?php

declare(strict_types=1);

namespace App\Telegram\Commands\Start;

use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    public function __construct()
    {
        $this->setName('start');
        $this->setDescription(__( 'telegram.start_description' ));
    }

    public function handle()
    {
        // TODO: typing

        $this->replyWithMessage([
            'text' => __('telegram.start'),
        ]);

        // TODO: typing

        $this->triggerCommand('help');
    }
}
