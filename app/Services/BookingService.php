<?php

namespace App\Services;

use App\Models\GamePeriod;
use App\Models\Participant;
use App\Models\Price;
use App\Models\Schedule;
use App\Models\WeeklyBooking;

class BookingService
{
    public function getWeeklyBookingsMappedByScheduleId(
        Participant $participant,
        GamePeriod $gamePeriod,
    ): iterable {
        $weeklyBookings =
            WeeklyBooking::query()
                ->where('participant_id', $participant->id)
                ->where('period_id', $gamePeriod->id)
                ->get()
            ;

        $schedulesMapped = [];

        foreach ($weeklyBookings as $weeklyBooking) {
            $schedulesMapped[$weeklyBooking->schedule_id] = $weeklyBooking;
        }

        return $schedulesMapped;
    }

    public function getSchedulesMapped(
        GamePeriod $gamePeriod,
    ): iterable {
        $schedules = Schedule::query()
            ->where('period_id', $gamePeriod->id)
            ->get()
        ;

        $schedulesMapped = [];

        foreach ($schedules as $schedule) {
            $schedulesMapped[$schedule->id] = $schedule;
        }

        return $schedulesMapped;
    }

    public function checkScheduleAvailability(Schedule $schedule): bool
    {
        return
            WeeklyBooking
                ::query()
                ->where('schedule_id', $schedule)
                ->count('id')
            <= 12
        ;
    }

    public function checkScheduleAvailabilityForParticipant(
        Participant $participant,
        Schedule $schedule,
    ): bool
    {
        return
            WeeklyBooking
                ::query()
                ->where('participant_id', $participant->id)
                ->where('schedule_id', $schedule->id)
                ->doesntExist()
            ;

    }

    public function getAvailableSchedulesMappedForParticipant(
        Participant $participant,
        GamePeriod $gamePeriod,
    ): iterable {
        $availableSchedules = [];
        $schedules = $this->getSchedulesMapped($gamePeriod);
        $participantBookings = $this->getWeeklyBookingsMappedByScheduleId($participant, $gamePeriod);

        foreach ($schedules as $schedule) {
            if ($this->checkScheduleAvailability($schedule)) {
                if (isset($participantBookings[$schedule->id]) === false) {
                    $availableSchedules[$schedule->id] = $schedule;
                }
            }
        }

        return $availableSchedules;
    }

    public function scheduleOutput(Schedule $schedule)
    {
        return __('common.day_of_week.' . $schedule->day)
            .  ' '
            . $schedule->start_time->format('H:i')
            . ' - '
            . $schedule->end_time->format('H:i')
            . ' '
            . __('common.training_type.'.$schedule->type);
    }

    public function periodShortOutput(GamePeriod $gamePeriod): string {
        return $gamePeriod->start_date->format('Y-m-d') . ' - ' . $gamePeriod->end_date->format('Y-m-d') . ' ' . __('common.weeks') . ' ' . $gamePeriod->duration_weeks;
    }

    public function book(
        Participant $participant,
        Schedule $schedule,
    ): WeeklyBooking {
        return WeeklyBooking::create([
            'period_id' => $schedule->period_id,
            'participant_id' => $participant->id,
            'schedule_id' => $schedule->id,
            'fixed_price' => $this->getPriceValueForSchedule($schedule),
        ]);
    }

    public function getPriceValueForSchedule(Schedule $schedule): float
    {
        $bookingType = $schedule->type ? 'training' : 'game';

        $price = Price
            ::query()
            ->where('booking_type', $bookingType)
            ->where('pricing_type', 'booking')
            ->first()
        ;

        $priceValue = $price->price;

        return $priceValue * $schedule->period->duration_weeks;
    }
}
