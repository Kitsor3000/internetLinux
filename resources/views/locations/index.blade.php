@extends('layouts.app')

@section('title', 'Локації')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Локації</h1>
            <p class="text-gray-600">Географічні локації, пов'язані з зникненнями</p>
        </div>

        @if($locations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($locations as $location)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $location->city }}</h3>
                            <div class="text-right">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm block">
                                {{ $location->missing_people_count }} зниклих
                            </span>
                                @if($location->sighting_reports_count > 0)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm block mt-1">
                                    {{ $location->sighting_reports_count }} звітів
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            @if($location->district)
                                <p><strong>Район:</strong> {{ $location->district }}</p>
                            @endif
                            @if($location->address)
                                <p><strong>Адреса:</strong> {{ $location->address }}</p>
                            @endif
                            @if($location->latitude && $location->longitude)
                                <p class="text-xs text-gray-500">
                                    Координати: {{ $location->latitude }}, {{ $location->longitude }}
                                </p>
                            @endif
                        </div>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('locations.show', $location) }}"
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                Детальніше →
                            </a>
                            <span class="text-sm text-gray-500">{{ $location->full_address }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <i class="fas fa-map-marker-alt text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-500 text-lg">Локації ще не додані</p>
            </div>
        @endif
    </div>
@endsection
