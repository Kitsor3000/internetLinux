<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class NotAuthorizedCommand extends Command
{
    protected string $name = 'not_authorized';

    public function handle()
    {
        $this->replyWithChatAction([
            'action' => 'typing',
        ]);

        $this->replyWithMessage([
            'text' => __('telegram.not_authorized'),
        ]);

        $this->replyWithChatAction([
            'action' => 'typing',
        ]);

        $this->replyWithMessage([
            'text' => __('telegram.wait_for_admin_update'),
        ]);

        $this->replyWithChatAction([
            'action' => 'typing',
        ]);

        $this->replyWithMessage([
            'text' => __('telegram.or_trigger_directly_if_too_long'),
        ]);
    }
}
