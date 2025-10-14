@extends('layouts.app')

@section('title', $location->city)

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('locations.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Назад до локацій
            </a>
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $location->full_address }}</h1>
                    <div class="flex items-center space-x-4 mt-2 text-gray-600">
                    <span class="flex items-center">
                        <i class="fas fa-users mr-2"></i>
                        {{ $location->missing_people_count }} зниклих осіб
                    </span>
                        <span class="flex items-center">
                        <i class="fas fa-eye mr-2"></i>
                        {{ $location->sighting_reports_count }} звітів про появи
                    </span>
                    </div>
                </div>
                @if($location->latitude && $location->longitude)
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm">
                    <i class="fas fa-map-pin mr-1"></i>Координати доступні
                </span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Зниклі особи в цій локації -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Зниклі особи</h2>

                @if($location->missingPeople->count() > 0)
                    <div class="space-y-4">
                        @foreach($location->missingPeople as $person)
                            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $person->full_name }}</h3>
                                    @if($person->is_urgent)
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                        Терміново
                                    </span>
                                    @endif
                                </div>

                                <div class="text-sm text-gray-600 space-y-1">
                                    <p>Вік: {{ $person->age_with_text }}</p>
                                    <p>Зник: {{ $person->disappeared_at->format('d.m.Y') }}</p>
                                    <p>Статус:
                                        <span class="{{ $person->status === 'missing' ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $person->status === 'missing' ? 'В розшуку' : 'Знайдено' }}
                                    </span>
                                    </p>
                                </div>

                                <a href="{{ route('missing-persons.show', $person) }}"
                                   class="inline-block mt-3 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Детальніше →
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-white rounded-lg shadow">
                        <i class="fas fa-users text-3xl text-gray-400 mb-3"></i>
                        <p class="text-gray-500">В цій локації немає зниклих осіб</p>
                    </div>
                @endif
            </div>

            <!-- Звіти про появи -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Звіти про появи</h2>

                @if($location->sightingReports->count() > 0)
                    <div class="space-y-4">
                        @foreach($location->sightingReports as $report)
                            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        {{ $report->missingPerson->full_name }}
                                    </h3>
                                    <span class="px-2 py-1 text-xs rounded-full
                                    {{ $report->status === 'verified' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $report->status === 'verified' ? 'Перевірено' : 'Новий' }}
                                </span>
                                </div>

                                <div class="text-sm text-gray-600 space-y-1">
                                    <p><strong>Повідомив:</strong> {{ $report->reporter_name }}</p>
                                    <p><strong>Телефон:</strong> {{ $report->reporter_phone }}</p>
                                    <p><strong>Час появи:</strong> {{ $report->sighting_time->format('d.m.Y H:i') }}</p>
                                    <p class="mt-2">{{ Str::limit($report->sighting_details, 100) }}</p>
                                </div>

                                <a href="{{ route('missing-persons.show', $report->missingPerson) }}"
                                   class="inline-block mt-3 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    До особи →
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-white rounded-lg shadow">
                        <i class="fas fa-eye text-3xl text-gray-400 mb-3"></i>
                        <p class="text-gray-500">В цій локації немає звітів про появи</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
