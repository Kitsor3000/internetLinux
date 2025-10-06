<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        return view('lab.index', [
            'title' => 'Lab Controller - Index',
            'message' => 'Welcome to Lab Controller Index Page'
        ]);
    }

    public function about()
    {
        $debugMode = request()->headers->get('X-Debug-Mode') === 'enabled';

        return view('lab.about', [
            'title' => 'About Page',
            'debugMode' => $debugMode,
            'message' => $debugMode ? 'Debug mode is enabled!' : 'Normal mode'
        ]);
    }

    public function status()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'API is working',
            'timestamp' => now(),
            'data' => [
                'version' => '1.0',
                'environment' => app()->environment()
            ]
        ]);
    }

    public function echo(Request $request)
    {
        $input = $request->all();

        return response()->json([
            'received' => $input,
            'headers' => $request->headers->all(),
            'timestamp' => now()
        ]);
    }
}
