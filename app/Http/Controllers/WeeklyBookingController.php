<?php

namespace App\Http\Controllers;

use App\Models\GamePeriod;
use App\Models\Participant;
use App\Models\Price;
use App\Models\Schedule;
use App\Models\WeeklyBooking;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WeeklyBookingController extends Controller
{
    public function index(GamePeriod $gamePeriod)
    {
        $bookings = WeeklyBooking::where('period_id', $gamePeriod->id)
            ->with(['participant', 'schedule'])
            ->get()
            ->map(function ($booking) {
                return [
                    'id'              => $booking->id,
                    'participant'     => $booking->participant,
                    'schedule_id'     => $booking->schedule_id,
                    'fixed_price'     => $booking->fixed_price,
                    'time'            => $booking->schedule
                        ? ($booking->schedule->start_time->format('H:i').' - '.$booking->schedule->end_time->format('H:i'))
                        : null,
                    'schedule'        => $booking->schedule,
                ];
            })
        ;

        return Inertia::render('WeeklyBookings/Index', [
            'gamePeriod' => $gamePeriod,
            'bookings'   => $bookings,
        ]);
    }


    public function store(Request $request, GamePeriod $game_period)
    {
        $request->validate([
            'participant_ids' => 'required|array',
            'participant_ids.*' => 'exists:participants,id',
            'schedule_id' => 'required|exists:schedule,id',
            'pricing_types' => 'required|array',
        ]);

        $schedule = Schedule::find($request->schedule_id);

        foreach ($request->participant_ids as $participantId) {
            $existingBooking = WeeklyBooking::where('period_id', $game_period->id)
                ->where('participant_id', $participantId)
                ->where('schedule_id', $request->schedule_id)
                ->first();

            if ($existingBooking) {
                continue;
            }

            $pricingType = $request->pricing_types[$participantId] ?? 'one_time';

            $priceRecord = Price::where('booking_type', $schedule->booking_type)
                ->where('pricing_type', $pricingType)
                ->first();

            if (! $priceRecord) {
                return redirect()->back()->with('error', 'Ціна для обраного типу бронювання не знайдена.');
            }

            WeeklyBooking::create([
                'period_id' => $game_period->id,
                'participant_id' => $participantId,
                'schedule_id' => $request->schedule_id,
                'day_of_week' => $schedule->day,
                'start_time' => $schedule->start_time,
                'end_time' => $schedule->end_time,
                'booking_type' => $schedule->booking_type,
                'fixed_price' => $priceRecord->price,
            ]);
        }

        return redirect()->route('weekly_bookings.index', ['game_period' => $game_period->id])
            ->with('message', 'Гравці успішно додані до бронювання.');
    }

    public function destroy($id)
    {
        $booking = WeeklyBooking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('message', 'Бронювання успішно видалено.');
    }
}
