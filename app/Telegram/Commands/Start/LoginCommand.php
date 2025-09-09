<?php

declare(strict_types=1);

namespace App\Telegram\Commands\Start;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class LoginCommand extends Command
{
    public function __construct()
    {
        $this->setName('login');
        $this->setDescription(__( 'telegram.login_description' ));
    }

    public function handle()
    {
        $login_keyboard = Keyboard::make()
            ->setOneTimeKeyboard(true)
            ->setSelective(true)
            ->row([
                Keyboard::button([
                    'text' => __('telegram.login_with_tg'),
                    'request_contact' => true,
                ]),
            ])
        ;

        $this->replyWithMessage([
            'text' => __('telegram.login_requested'),
            'reply_markup' => $login_keyboard,
        ]);
    }
}
