<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScheduleCollection;
use App\Models\GamePeriod;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function index(GamePeriod $gamePeriod)
    {
        $schedulesQuery = Schedule::where('period_id', $gamePeriod->id);

        return Inertia::render('Schedules/Index', [
            'gamePeriod' => $gamePeriod,
            'schedules' => new ScheduleCollection(
                $schedulesQuery->paginate(),
            ),
        ]);
    }

    public function store(Request $request, GamePeriod $gamePeriod)
    {
        $request->validate([
            'day'=> 'required|int|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'type' => 'required|string',
        ]);

        Schedule::create([
            'period_id' => $gamePeriod->id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'type' => $request->type,
        ]);

        return redirect()->route('schedules.index', ['gamePeriod' => $gamePeriod])->with('message', 'Розклад успішно додано.');
    }

    public function create(GamePeriod $gamePeriod) {
        return Inertia::render('Schedules/Create', [
            'gamePeriod' => $gamePeriod,
        ]);
    }

    public function edit(GamePeriod $gamePeriod, Schedule $schedule) {
        return Inertia::render('Schedules/Edit', [
            'gamePeriod' => $gamePeriod,
            'schedule' => $schedule,
        ]);
    }

    public function update(Request $request, GamePeriod $gamePeriod, Schedule $schedule) {
        $request->validate([
            'day'=> 'required|int|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'type' => 'required|string',
        ]);

        $schedule->update($request->only([
            'day',
            'start_time',
            'end_time',
            'type',
        ]));

        return redirect()->route('schedules.index', ['gamePeriod' => $gamePeriod->id]);
    }

    public function destroy(GamePeriod $gamePeriod, Schedule $schedule) {
        Schedule::destroy($schedule->id);

        return redirect()->route('schedules.index', ['gamePeriod' => $gamePeriod->id]);
    }
}
