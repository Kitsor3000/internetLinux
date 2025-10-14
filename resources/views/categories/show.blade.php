@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i>Назад до категорій
            </a>
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $category->name }}</h1>
                    @if($category->description)
                        <p class="text-gray-600 mt-2">{{ $category->description }}</p>
                    @endif
                </div>
                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">
                {{ $missingPeople->total() }} осіб
            </span>
            </div>
        </div>

        @if($missingPeople->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($missingPeople as $person)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $person->full_name }}</h3>
                                @if($person->is_urgent)
                                    <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Терміново
                                </span>
                                @endif
                            </div>

                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                <p><strong>Вік:</strong> {{ $person->age_with_text }}</p>
                                <p><strong>Стать:</strong> {{ $person->gender === 'male' ? 'Чоловік' : 'Жінка' }}</p>
                                <p><strong>Місце:</strong> {{ $person->lastLocation->full_address ?? 'Невідомо' }}</p>
                                <p><strong>Зник:</strong> {{ $person->disappeared_at->format('d.m.Y') }}</p>
                            </div>

                            <div class="flex space-x-2">
                                <a href="{{ route('missing-persons.show', $person) }}"
                                   class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded hover:bg-blue-700 transition">
                                    Детальніше
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Пагінація -->
            <div class="mt-8">
                {{ $missingPeople->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-500 text-lg">В цій категорії поки немає осіб</p>
                <a href="{{ route('missing-persons.create') }}" class="inline-block mt-4 bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 transition">
                    <i class="fas fa-plus mr-2"></i>Додати особу
                </a>
            </div>
        @endif
    </div>
@endsection
