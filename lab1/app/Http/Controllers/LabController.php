<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabController extends Controller
{
    public function index()
    {
        return view('lab.index', [
            'title' => 'Головна сторінка лабораторної',
            'message' => 'Ласкаво просимо до лабораторної роботи з Laravel!',
            'features' => [
                'Middleware для обробки параметрів',
                'Контролери з різними типами відповідей',
                'Blade шаблони з компонентами',
                'JSON API endpoints'
            ]
        ]);
    }

    public function about()
    {
        $debugMode = request()->headers->get('X-Debug-Mode') === 'enabled';

        return view('lab.about', [
            'title' => 'Про проект',
            'debugMode' => $debugMode,
            'message' => $debugMode ? '🔧 Режим налагодження активовано!' : '⚡ Звичайний режим роботи',
            'description' => 'Ця сторінка демонструє роботу middleware, який перевіряє параметр mode=debug в URL.'
        ]);
    }

    public function status()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'API працює коректно',
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'data' => [
                'version' => '1.0',
                'environment' => app()->environment(),
                'framework' => 'Laravel',
                'php_version' => PHP_VERSION
            ]
        ]);
    }

    public function echo(Request $request)
    {
        $input = $request->all();

        return response()->json([
            'message' => 'Отримані дані',
            'received' => $input,
            'server_info' => [
                'timestamp' => now()->format('Y-m-d H:i:s'),
                'method' => $request->method(),
                'url' => $request->fullUrl()
            ]
        ]);
    }
}
