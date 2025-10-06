@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $title }}</h1>
        <p class="text-gray-600 mb-4">{{ $message }}</p>

        <div class="bg-blue-50 border border-blue-200 rounded p-4">
            <h2 class="text-xl font-semibold text-blue-800 mb-2">Available Routes:</h2>
            <ul class="list-disc list-inside text-blue-700 space-y-1">
                <li><a href="/lab/about" class="hover:underline">/lab/about</a> - About page</li>
                <li><a href="/lab/about?mode=debug" class="hover:underline">/lab/about?mode=debug</a> - About with debug mode</li>
                <li><a href="/lab/status" class="hover:underline">/lab/status</a> - Status API</li>
                <li><a href="/lab/echo?test=data" class="hover:underline">/lab/echo</a> - Echo API</li>
            </ul>
        </div>
    </div>
@endsection
