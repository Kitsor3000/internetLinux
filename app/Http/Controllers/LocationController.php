<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function __construct()
    {
        // Дозволяємо перегляд всім, але редагування тільки авторизованим
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::withCount(['missingPeople', 'sightingReports'])
            ->latest()
            ->paginate(9);

        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Location::class);
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        Location::create($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Локацію успішно додано!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        $missingPeople = $location->missingPeople()
            ->with('categories')
            ->where('status', 'missing')
            ->paginate(10);

        $sightingReports = $location->sightingReports()
            ->with('missingPerson')
            ->latest()
            ->paginate(10);

        return view('locations.show', compact('location', 'missingPeople', 'sightingReports'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        $this->authorize('update', $location);
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $this->authorize('update', $location);
        $validated = $request->validate([
            'city' => 'required|string|max:255',
            'district' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $location->update($validated);

        return redirect()->route('locations.show', $location)
            ->with('success', 'Локацію успішно оновлено!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $this->authorize('delete', $location);
        // Перевіряємо чи є пов'язані записи
        if ($location->missingPeople()->count() > 0 || $location->sightingReports()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Неможливо видалити локацію, оскільки є пов\'язані записи про зниклих осіб або звіти про появи.');
        }

        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Локацію успішно видалено!');
    }
}
