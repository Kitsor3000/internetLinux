<?php

namespace App\Telegram\Commands\Data;

use App\Models\Participant;
use App\Models\WeeklyBooking;
use Telegram\Bot\Commands\Command;

class UnbookCommand extends Command
{
    public function __construct()
    {
        $this->setName('unbook');
        $this->setDescription(__( 'telegram.unbook_description'));
        $this->setPattern('{bookingId: \d+}');
    }

    public function handle()
    {
        $participant = Participant::getCurrentParticipant();
        $bookingId = $this->argument('bookingId');

        if (!$bookingId) {
            $this->replyWithMessage([
                'text' => __('telegram.booking_not_specified'),
            ]);


            $this->triggerCommand('game_periods');

            return;
        }

        $booking = WeeklyBooking::find($bookingId);

        if(!$booking) {
            $this->replyWithMessage([
                'text' => __('telegram.booking_not_found'),
            ]);

            $this->triggerCommand('game_periods');;
        }

        if($booking->participant_id !== $participant->id) {
            $this->replyWithMessage([
                'text' => __('telegram.booking_not_found'),
            ]);
        }

        $booking->delete();

        $this->replyWithMessage([
            'text' => __('telegram.unbooked'),
        ]);

        $this->triggerCommand('game_periods');
    }
}
