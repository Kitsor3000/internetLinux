<?php

namespace App\Telegram\Commands;

use App\Models\Participant;
use App\Models\User;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

final class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected string $name = 'help';

    /**
     * @var array Command Aliases
     */
    protected array $aliases = ['listcommands'];

    /**
     * @var string Command Description
     */

    private const NOT_AUTH_ACTIONS = [
        'login',
        'help',
        'contacts',
    ];

    private const AUTH_ACTIONS = [
//        'current_votes',
        'status',
        'game_periods',
        'transactions',
        'help',
        'contacts',
        'invoices',
    ];

    private const NOT_ALLOWED_ACTIONS = [
        'help',
        'contacts',
    ];

    public function __construct()
    {
        $this->setDescription(__('telegram.help_list_available_actions'));
    }

    /**
     * {@inheritdoc}
     */
    public function handle(): void
    {

        \Log::info(json_encode($this->telegram->getCommandBus()->getCommands()));

        $text = __('telegram.available_commands') . PHP_EOL;

        $commands = $this->telegram->getCommandBus()->getCommands();

        if ($participant = Participant::getCurrentParticipant()) {
            if($participant->telegram_allowed) {
                $targetNames = self::AUTH_ACTIONS;
            } else {
                $text .= __('telegram.not_authorized') . PHP_EOL;
                $targetNames = self::NOT_ALLOWED_ACTIONS;
            }
        } else {
            \Log::info('user is not logged in');
            $targetNames = self::NOT_AUTH_ACTIONS;
        }

        foreach ($targetNames as $targetName) {
            if (($handler = $commands[$targetName]) instanceof Command) {
                $text .= sprintf('/%s - %s' . PHP_EOL, $handler->getName(), $handler->getDescription());
            }
        }

        $this->replyWithMessage([
            'text' => $text,
            'reply_markup' => Keyboard::remove(),
        ]);
    }

    private function lastRequestedAction(User $user): string
    {
        return false;
    }
}
