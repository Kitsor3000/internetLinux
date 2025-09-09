<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ParticipantCollection;
use App\Models\Participant;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InvoicesController extends Controller
{
    public function index()
    {
        return Inertia::render('Invoices/Index', [
            'participants' => new ParticipantCollection(
                Participant::query()->paginate(),
            ),
        ]);
    }

    public function create()
    {
        return Inertia::render('Participants/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:participants,name',
            'phone' => 'required|string|size:13|unique:participants,phone',
            'telegram_username' => 'required|string|max:255',
            'joined_date' => 'required|date',
        ]);

        Participant::create($request->all());

        return redirect()->back()->with('success', 'Учасника додано успішно');
    }

    public function update(Request $request, Participant $participant)
    {
        $request->validate([
            'name' => 'required|string|max:255', // Видалено 'unique', щоб дозволити залишати незмінне ім'я
            'phone' => 'required|string|size:13',
            'telegram_username' => 'required|string|max:255',
            'joined_date' => 'required|date',
        ]);

        $participant->update($request->only([
            'name',
            'phone',
            'telegram_username',
            'joined_date',
            'telegram_allowed',
        ]));

        return redirect()->route('participants.index')->with('success', 'Учасника оновлено успішно');
    }

    public function show($id)
    {
        $participant = Participant::findOrFail($id);

        return view('participants.show', compact('participant'));
    }

    public function edit($id): Response
    {
        $participant = Participant::findOrFail($id);

        return Inertia::render('Participants/Edit', [
            'participant' => $participant,
        ]);
    }

    public function destroy($id)
    {
        $participant = Participant::findOrFail($id);
        $participant->delete();

        return redirect()->route('participants.index')->with('success', 'Учасника видалено');
    }
}
