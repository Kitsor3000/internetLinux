<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::withCount(['missingPeople', 'sightingReports'])->get();
        return view('locations.index', compact('locations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        $location->load(['missingPeople', 'sightingReports.missingPerson']);
        return view('locations.show', compact('location'));
    }
}
