<?php

namespace App\Http\Controllers;

use App\Models\MissingPerson;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MissingPersonController extends Controller
{
    public function __construct()
    {
        // Дозволяємо перегляд всім, але редагування тільки авторизованим
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index()
    {
        $missingPeople = MissingPerson::with(['lastLocation', 'categories', 'user'])
            ->latest()
            ->paginate(10);

        return view('missing-persons.index', compact('missingPeople'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', MissingPerson::class);
        $categories = Category::all();
        $locations = Location::all();
        return view('missing-persons.create', compact('categories', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:0|max:120',
            'gender' => 'required|in:male,female,unknown',
            'description' => 'required|string|min:10',
            'special_marks' => 'nullable|string',
            'last_location_id' => 'required|exists:locations,id',
            'disappeared_at' => 'required|date',
            'contact_info' => 'required|string',
            'is_urgent' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Обробка фото
        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('missing-persons', 'public');
        }

        $validated['user_id'] = auth()->id() ?? 1; // Тимчасово
        $validated['status'] = 'missing';

        $missingPerson = MissingPerson::create($validated);

        // Додаємо категорії
        if (isset($validated['categories'])) {
            $missingPerson->categories()->sync($validated['categories']);
        }

        return redirect()->route('missing-persons.show', $missingPerson)
            ->with('success', 'Інформацію про зниклу особу успішно додано!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MissingPerson $missingPerson)
    {


        $missingPerson->load(['lastLocation', 'categories', 'reports.sightingLocation', 'user']);
        return view('missing-persons.show', compact('missingPerson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MissingPerson $missingPerson)
    {
        $this->authorize('update', $missingPerson);
        $categories = Category::all();
        $locations = Location::all();
        return view('missing-persons.edit', compact('missingPerson', 'categories', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MissingPerson $missingPerson)
    {
        $this->authorize('update', $missingPerson);
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'age' => 'required|integer|min:0|max:120',
            'gender' => 'required|in:male,female,unknown',
            'description' => 'required|string|min:10',
            'special_marks' => 'nullable|string',
            'last_location_id' => 'required|exists:locations,id',
            'disappeared_at' => 'required|date',
            'contact_info' => 'required|string',
            'status' => 'required|in:missing,found,search_suspended',
            'is_urgent' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Обробка фото
        if ($request->hasFile('photo')) {
            // Видаляємо старе фото
            if ($missingPerson->photo_path) {
                Storage::disk('public')->delete($missingPerson->photo_path);
            }
            $validated['photo_path'] = $request->file('photo')->store('missing-persons', 'public');
        }

        $missingPerson->update($validated);

        // Оновлюємо категорії
        $missingPerson->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('missing-persons.show', $missingPerson)
            ->with('success', 'Інформацію оновлено успішно!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MissingPerson $missingPerson)
    {

        $this->authorize('delete', $missingPerson);
        // Видаляємо фото
        if ($missingPerson->photo_path) {
            Storage::disk('public')->delete($missingPerson->photo_path);
        }

        $missingPerson->delete();

        return redirect()->route('missing-persons.index')
            ->with('success', 'Запис про зниклу особу видалено!');
    }
}
