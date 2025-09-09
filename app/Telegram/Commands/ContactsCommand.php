<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class ContactsCommand extends Command
{
    public function __construct()
    {
        $this->setName('contacts');
        $this->setDescription(__( 'telegram.contacts_description'));
    }

    public function handle()
    {
        $this->replyWithMessage([
            'text' => __('telegram.contacts'),
        ]);

        $this->replyWithMessage([
            'text' => __('telegram.phone'),
        ]);

        $this->replyWithMessage([
            'text' => '+380982628582',
        ]);

        $this->replyWithMessage([
            'text' => __('telegram.admin'),
        ]);

        $this->replyWithMessage([
            'text' => '@LaT1K77',
        ]);
    }

}
