@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $title }}</h1>

        @if($debugMode)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <strong>Debug Mode:</strong> {{ $message }}
            </div>
        @else
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                {{ $message }}
            </div>
        @endif

        <p class="text-gray-600 mb-4">
            This is the about page protected by QueryModeMiddleware.
            Add <code>?mode=debug</code> to the URL to enable debug mode.
        </p>
    </div>
@endsection
