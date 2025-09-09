<?php

namespace App\Telegram\Commands\Others;

use Telegram\Bot\Commands\Command;

class FeedbackCommand extends Command
{

    public function __construct()
    {
        $this->setName('feedback');
        $this->setDescription(__( 'telegram.register_description' ));;
    }

    public function handle()
    {
        $this->replyWithMessage([
            'text' => __('telegram.feedback_waiting'),
        ]);
    }

}
