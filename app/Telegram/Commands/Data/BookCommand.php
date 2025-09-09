<?php

namespace App\Telegram\Commands\Data;

use App\Models\Participant;
use App\Models\Schedule;
use App\Services\BookingService;
use Telegram\Bot\Commands\Command;

class BookCommand extends Command
{
    public function __construct(
        private BookingService $bookingService,
    ) {
        $this->setName('book');
        $this->setDescription(__( 'telegram.book_description'));
        $this->setPattern('{scheduleId: \d+}');
    }

    public function handle() {
        $participant = Participant::getCurrentParticipant();
        $scheduleId = $this->argument('scheduleId');

        if (!$scheduleId) {
            $this->replyWithMessage([
                'text' => __('telegram.schedule_not_specified'),
            ]);

            $this->triggerCommand('game_periods');;

            return;
        }

        $schedule = Schedule::find($scheduleId);

        if (!$schedule) {
            $this->replyWithMessage([
                'text' => __('telegram.schedule_not_found'),
            ]);

            $this->triggerCommand('game_periods');;;

            return;
        }

        if (
            $this
                ->bookingService
                ->checkScheduleAvailabilityForParticipant(
                    $participant,
                    $schedule
                )
        ) {
            $booking = $this->bookingService->book($participant, $schedule);

            if ($booking) {
                $this->replyWithMessage([
                    'text' => __('telegram.booked'),
                ]);

                $this->triggerCommand('game_periods');
            }
        } else {
            $this->replyWithMessage([
                'text' => __('telegram.schedule_not_available'),
            ]);

            $this->triggerCommand('game_periods');

        }

    }
}
