@extends('layouts.app')

@section('title', $missingPerson->full_name)

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <!-- Заголовок -->
            <div class="mb-6">
                <a href="{{ route('missing-persons.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
                    <i class="fas fa-arrow-left mr-2"></i>Назад до списку
                </a>
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $missingPerson->full_name }}</h1>
                        <p class="text-gray-600 mt-2">Зник {{ $missingPerson->disappeared_at->format('d.m.Y') }}</p>
                    </div>
                    <div class="text-right">
                        @if($missingPerson->is_urgent)
                            <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Терміново
                        </span>
                        @endif
                        <span class="block mt-2 px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm">
                        {{ $missingPerson->status === 'missing' ? 'В розшуку' : 'Знайдено' }}
                    </span>
                    </div>
                </div>
            </div>

            <!-- Основна інформація -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Основна інформація</h2>
                    <div class="space-y-3">
                        <div>
                            <strong>Вік:</strong> {{ $missingPerson->age_with_text }}
                        </div>
                        <div>
                            <strong>Стать:</strong> {{ $missingPerson->gender === 'male' ? 'Чоловік' : 'Жінка' }}
                        </div>
                        <div>
                            <strong>Остання відома локація:</strong>
                            {{ $missingPerson->lastLocation->full_address ?? 'Невідомо' }}
                        </div>
                        <div>
                            <strong>Контактна інформація:</strong> {{ $missingPerson->contact_info }}
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Опис</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $missingPerson->description }}</p>

                    @if($missingPerson->special_marks)
                        <div class="mt-4">
                            <strong>Особливі прикмети:</strong>
                            <p class="text-gray-700">{{ $missingPerson->special_marks }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Категорії -->
            @if($missingPerson->categories->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Категорії</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($missingPerson->categories as $category)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Кнопки дій -->
            <div class="flex space-x-4">
                <a href="{{ route('missing-persons.edit', $missingPerson) }}"
                   class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition">
                    <i class="fas fa-edit mr-2"></i>Редагувати
                </a>
                <form action="{{ route('missing-persons.destroy', $missingPerson) }}" method="POST"
                      onsubmit="return confirm('Ви впевнені, що хочете видалити цей запис?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600 transition">
                        <i class="fas fa-trash mr-2"></i>Видалити
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
