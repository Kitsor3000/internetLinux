@extends('layouts.app')

@section('title', 'Категорії')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Категорії</h1>
            <p class="text-gray-600">Категорії для класифікації зниклих осіб</p>
        </div>

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h3>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                            {{ $category->missing_people_count }} осіб
                        </span>
                        </div>

                        @if($category->description)
                            <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                        @endif

                        <div class="flex justify-between items-center">
                            <a href="{{ route('categories.show', $category) }}"
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                Переглянути осіб →
                            </a>
                            <span class="text-sm text-gray-500">{{ $category->slug }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <i class="fas fa-tags text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-500 text-lg">Категорії ще не створені</p>
            </div>
        @endif
    </div>
@endsection
