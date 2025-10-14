@extends('layouts.app')

@section('title', 'Редагувати локацію: ' . $location->city)

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Редагувати локацію: {{ $location->city }}</h1>

            <form action="{{ route('locations.update', $location) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Місто *</label>
                        <input type="text" id="city" name="city" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('city', $location->city) }}">
                        @error('city')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="district" class="block text-sm font-medium text-gray-700 mb-2">Район</label>
                        <input type="text" id="district" name="district"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('district', $location->district) }}">
                        @error('district')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Адреса</label>
                    <input type="text" id="address" name="address"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('address', $location->address) }}">
                    @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">Широта</label>
                        <input type="number" id="latitude" name="latitude" step="any"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('latitude', $location->latitude) }}">
                        @error('latitude')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">Довгота</label>
                        <input type="number" id="longitude" name="longitude" step="any"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('longitude', $location->longitude) }}">
                        @error('longitude')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-4 pt-6">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-save mr-2"></i>Оновити
                    </button>
                    <a href="{{ route('locations.show', $location) }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition font-semibold">
                        <i class="fas fa-times mr-2"></i>Скасувати
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
