<?php

namespace App\Http\Controllers;

use App\Enum\GamePeriodStatusEnum;
use App\Http\Requests\GamePeriod\GamePeriodStoreRequest;
use App\Http\Resources\GamePeriodCollection;
use App\Models\GamePeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class GamePeriodController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('GamePeriods/Index', [
            'gamePeriods' => new GamePeriodCollection(
                GamePeriod::query()->paginate(),
            ),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('GamePeriods/Create');
    }

    public function store(GamePeriodStoreRequest $request): RedirectResponse
    {
        $period = GamePeriod::create($request->validated());
        $period->status = GamePeriodStatusEnum::DRAFT;
        $period->save();

        return to_route('game_periods.index');
    }

    public function edit(GamePeriod $gamePeriod): Response
    {
        return Inertia::render('GamePeriods/Edit', [
            'gamePeriod' => $gamePeriod,
        ]);
    }

    public function update(Request $request, GamePeriod $gamePeriod)
    {
        $request->validate([
            'start_date' => 'required|string|max:255',
            'end_date' => 'required|string|max:255', // Чи справді потрібен size:13?
            'duration_weeks' => 'required|numeric',
            'status' => Rule::in(GamePeriodStatusEnum::getList())
        ]);

        $gamePeriod->update($request->only([
            'start_date',
            'end_date',
            'duration_weeks',
            'status',
        ]));

        return redirect()->route('game_periods.index')->with('success', __('game_periods.updated'));
    }
}
