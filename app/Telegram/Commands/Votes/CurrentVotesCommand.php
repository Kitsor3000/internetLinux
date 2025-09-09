<?php

namespace App\Telegram\Commands\Votes;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class CurrentVotesCommand extends Command
{
    public function __construct()
    {
        $this->setName('current_votes');
        $this->setDescription(__( 'telegram.current_votes_description' ));;
    }

    public function handle()
    {
//        $this->votesWithPeriods();
        $this->voteWenBook();
    }

    protected function votesWithPeriods()
    {
        $login_keyboard = Keyboard::make()
            ->setOneTimeKeyboard(true)
            ->setSelective(true)
            ->row([
                Keyboard::button([
                    'text' => __('telegram.monday') . ' - ' . __('telegram.training_day') ,
                ]),
                Keyboard::button([
                    'text' => __('telegram.friday') . ' - ' . __('telegram.training_day') ,
                ]),
            ])
            ->row([
                Keyboard::button([
                    'text' => __('telegram.tuesday') . ' - ' . __('telegram.gaming') ,
                ]),
                Keyboard::button([
                    'text' => __('telegram.wednesday') . ' - ' . __('telegram.gaming') ,
                ]),
            ])
            ->row([
                Keyboard::button([
                    'text' => __('telegram.friday') . ' - ' . __('telegram.gaming') ,
                ]),
                Keyboard::button([
                    'text' => __('telegram.sunday') . ' - ' . __('telegram.gaming') ,
                ]),
            ])
        ;

        $answers = $this->replyWithMessage([
            'text' =>
                __('telegram.choose_each_needed_day_in_period')
                . PHP_EOL
                . __('telegram.period')
                . PHP_EOL
                . '2025-07-06 - 2025-07-27'
            ,
            'reply_markup' => $login_keyboard,
        ]);

        \Log::info(json_encode(['answers:' => $answers]));
    }

    protected function voteWenBook()
    {
        $login_keyboard = Keyboard::make()
            ->setOneTimeKeyboard(true)
            ->setSelective(true)
            ->row([
                Keyboard::button([
                    'text' => __('telegram.yes') . ' - ' . __('telegram.had_previous_booking') ,
                ]),
            ])
            ->row([
                Keyboard::button([
                    'text' => __('telegram.no') . ' - ' . __('telegram.i_am_sardelka') ,
                ]),
            ])
        ;

        $answers = $this->replyWithMessage([
            'text' =>
                __('telegram.chosen_day_in_period')
                . PHP_EOL
                . __('telegram.period')
                . PHP_EOL
                . '2025-07-06 - 2025-07-27'
            ,
            'reply_markup' => $login_keyboard,
        ]);

        \Log::info(json_encode(['answers:' => $answers]));

    }

    protected function votesDaysMonTue()
    {

    }

    protected function votesWithThuFri()
    {

    }
}
