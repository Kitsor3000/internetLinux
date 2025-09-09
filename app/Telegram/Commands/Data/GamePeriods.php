<?php

declare(strict_types=1);

namespace App\Telegram\Commands\Data;

use App\Enum\GamePeriodStatusEnum;
use App\Models\GamePeriod;
use App\Models\Participant;
use App\Services\BookingService;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;

class GamePeriods extends Command
{

    public function __construct(
        private BookingService $bookingService,
    ) {
        $this->setName('game_periods');
        $this->setDescription(__( 'telegram.game_periods_description' ));
    }

    public function handle()
    {
        $currentParticipant = Participant::getCurrentParticipant();

        $periodsQuery = GamePeriod::query();
        $periodsQuery
            ->where('end_date', '>=', new \DateTime('2 months ago'))
            ->where('status', '!=', GamePeriodStatusEnum::DRAFT->value)
            ->orderBy('start_date', 'desc')
        ;

        $periods = $periodsQuery->get();

        $text = __('telegram.game_periods') . PHP_EOL;

        $text.= PHP_EOL;
        $text.= PHP_EOL;

        $allAvailableForBooking = [];
        $allAvailableForCancel = [];

        foreach ($periods as $period) {
            $text .= __('telegram.game_period'). PHP_EOL;
            $text .= $period->start_date->format('Y-m-d') . ' - ' . $period->end_date->format('Y-m-d') . PHP_EOL;
            $text .= __('telegram.game_period_duration_weeks') . ' - ' . $period->duration_weeks . PHP_EOL;
            $text .= __('telegram.game_period_status.') . $period->status . PHP_EOL;
            $availableBookingsSchedules = [];
            $booked = [];
            $availableReverseBookingsSchedules = [];

            switch ($period->status) {
                case GamePeriodStatusEnum::PLAYING->value:
                    $booked = $this
                        ->bookingService
                        ->getWeeklyBookingsMappedByScheduleId(
                            $currentParticipant,
                            $period,
                        )
                    ;

                    break;
                case GamePeriodStatusEnum::PLANNED->value:
                    $availableReverseBookingsSchedules = $this
                        ->bookingService
                        ->getWeeklyBookingsMappedByScheduleId(
                            $currentParticipant,
                            $period,
                        )
                    ;

                    $availableBookingsSchedules = $this
                        ->bookingService
                        ->getAvailableSchedulesMappedForParticipant(
                            $currentParticipant,
                            $period,
                        )
                    ;

                    break;
                case GamePeriodStatusEnum::FINISHED->value:
                    $booked = $this
                        ->bookingService
                        ->getWeeklyBookingsMappedByScheduleId(
                            Participant::getCurrentParticipant(),
                            $period,
                        )
                    ;

                    break;
                default:
                    break;
            }

            if(count($booked) > 0) {
                $text .= __('telegram.game_period.booked') . PHP_EOL;
                foreach ($booked as $booking) {
                    $text .= $this->bookingService->scheduleOutput($booking->schedule) . PHP_EOL;
                }

                $text .= PHP_EOL;
            }

            if(count($availableBookingsSchedules) > 0) {
                $allAvailableForBooking = array_merge($allAvailableForBooking, $availableBookingsSchedules);
                $text .= __('telegram.game_period.available_for_booking') . PHP_EOL;
                foreach ($availableBookingsSchedules as $availableBookingsSchedule) {
                    $text .= $this->bookingService->scheduleOutput($availableBookingsSchedule). PHP_EOL;
                }

                $text .= PHP_EOL;
            }

            if(count($availableReverseBookingsSchedules) > 0) {
                $allAvailableForCancel = array_merge($allAvailableForCancel, $availableReverseBookingsSchedules);
                $text .= __('telegram.game_period.booked') . ' '. __('telegram.available_to_cancel') . PHP_EOL;
                foreach ($allAvailableForCancel as $booking) {
                    $text .= $this->bookingService->scheduleOutput($booking->schedule) . PHP_EOL;
                }

                $text .= PHP_EOL;
            }

            $text .= PHP_EOL;
            $text .= PHP_EOL;
        }

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
        ;

        foreach ($allAvailableForBooking as $schedule) {
            $reply_markup->row([
                Keyboard::button([
                    'text' =>
                        '/book ' . $schedule->id
                        . ' '
                        . __('telegram.book_schedule')
                        . ' '
                        . $this->bookingService->scheduleOutput($schedule)
                        . ' '
                        . $this->bookingService->periodShortOutput($schedule->period)
                    ,
                ])
            ]);
        }

        foreach ($allAvailableForCancel as $booking) {
            $reply_markup->row([
                Keyboard::button([
                    'text' =>
                        '/unbook ' . $booking->id
                        . ' '
                        . __('telegram.unbook_schedule')
                        . ' '
                        . $this->bookingService->scheduleOutput($booking->schedule)
                        . ' '
                        . $this->bookingService->periodShortOutput($booking->schedule->period)
                    ,
                ])
            ]);
        }

        $response = $this->replyWithMessage([
            'text' => $text,
            'reply_markup' => $reply_markup,
        ]);

        if (count($allAvailableForBooking) == 0 && count($allAvailableForCancel) == 0) {
            $this->triggerCommand('help');
        }

        \Log::info($response);
    }

}
