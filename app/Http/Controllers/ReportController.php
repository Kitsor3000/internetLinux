<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\MissingPerson;
use App\Models\Location;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MissingPerson $missingPerson)
    {
        $validated = $request->validate([
            'reporter_name' => 'required|string|max:255',
            'reporter_phone' => 'required|string|max:20',
            'sighting_details' => 'required|string|min:10',
            'sighting_location_id' => 'required|exists:locations,id',
            'sighting_time' => 'required|date',
        ]);

        $validated['missing_person_id'] = $missingPerson->id;
        $validated['user_id'] = auth()->id() ?? 1; // Тимчасово
        $validated['status'] = 'new';

        Report::create($validated);

        return redirect()->route('missing-persons.show', $missingPerson)
            ->with('success', 'Звіт про появу успішно додано!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $missingPersonId = $report->missing_person_id;
        $report->delete();

        return redirect()->route('missing-persons.show', $missingPersonId)
            ->with('success', 'Звіт видалено!');
    }
}
