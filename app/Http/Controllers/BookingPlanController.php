<?php

namespace App\Http\Controllers;

use App\Models\BookingPlan;
use App\Models\Participant;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingPlanController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('bookings.participant')->get();
        $participants = Participant::all();

        return Inertia::render('Booking/Index', [
            'schedules' => $schedules,
            'participants' => $participants,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedule,id',
            'participant_id' => 'required|exists:participants,id',
            'planned_date' => 'required|date',
        ]);

        BookingPlan::create($request->only('schedule_id', 'participant_id', 'planned_date'));

        return redirect()->back()->with('message', 'Гравця успішно додано до тренування.');
    }
}
