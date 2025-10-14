<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\MissingPerson;
use App\Models\Report;
use Illuminate\Http\Request;

class TestDataController extends Controller
{
    public function showData()
    {
        $data = [
            'categories' => Category::all(),
            'locations' => Location::all(),
            'missingPeople' => MissingPerson::with(['categories', 'lastLocation'])->get(),
            'reports' => Report::with(['missingPerson', 'sightingLocation'])->get(),
        ];

        return view('test-data', compact('data'));
    }

    public function showStats()
    {
        $stats = [
            'total_categories' => Category::count(),
            'total_locations' => Location::count(),
            'total_missing_people' => MissingPerson::count(),
            'total_reports' => Report::count(),
            'urgent_cases' => MissingPerson::where('is_urgent', true)->count(),
            'found_people' => MissingPerson::where('status', 'found')->count(),
            'active_searches' => MissingPerson::where('status', 'missing')->count(),
        ];

        return response()->json($stats); // Просто JSON для тесту
    }
}
