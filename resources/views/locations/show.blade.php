@extends('layouts.app')

@section('title', $location->full_address)

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <!-- Заголовок -->
            <div class="mb-6">
                <a href="{{ route('locations.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
                    <i class="fas fa-arrow-left mr-2"></i>Назад до списку локацій
                </a>
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $location->full_address }}</h1>
                        <p class="text-gray-600 mt-2">Локація в системі пошуку</p>
                    </div>
                    <div class="text-right">
                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm">
                        {{ $location->missing_people_count ?? 0 }} зниклих
                    </span>
                    </div>
                </div>
            </div>

            <!-- Основна інформація -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Інформація про локацію</h2>
                    <div class="space-y-3">
                        <div>
                            <strong>Місто:</strong> {{ $location->city }}
                        </div>
                        @if($location->district)
                            <div>
                                <strong>Район:</strong> {{ $location->district }}
                            </div>
                        @endif
                        @if($location->address)
                            <div>
                                <strong>Адреса:</strong> {{ $location->address }}
                            </div>
                        @endif
                        @if($location->latitude && $location->longitude)
                            <div>
                                <strong>Координати:</strong>
                                {{ number_format($location->latitude, 6) }}, {{ number_format($location->longitude, 6) }}
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Статистика</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span>Зниклих осіб:</span>
                            <span class="font-semibold">{{ $location->missing_people_count ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Звітів про появи:</span>
                            <span class="font-semibold">{{ $location->sighting_reports_count ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Кнопки дій -->
            @auth
                <div class="flex space-x-4 mb-8">
                    <a href="{{ route('locations.edit', $location) }}"
                       class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition">
                        <i class="fas fa-edit mr-2"></i>Редагувати
                    </a>
                    <form action="{{ route('locations.destroy', $location) }}" method="POST"
                          onsubmit="return confirm('Ви впевнені, що хочете видалити цю локацію?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600 transition">
                            <i class="fas fa-trash mr-2"></i>Видалити
                        </button>
                    </form>
                </div>
            @endauth

            <!-- Зниклі особи в цій локації -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Зниклі особи в цій локації</h2>
                @if($missingPeople->count() > 0)
                    <div class="space-y-4">
                        @foreach($missingPeople as $person)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $person->full_name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $person->age_with_text }}, {{ $person->gender === 'male' ? 'чоловік' : 'жінка' }}</p>
                                    </div>
                                    <a href="{{ route('missing-persons.show', $person) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm">
                                        Детальніше →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $missingPeople->links() }}
                    </div>
                @else
                    <p class="text-gray-500">Немає зниклих осіб, пов'язаних з цією локацією</p>
                @endif
            </div>
        </div>
    </div>
@endsection
