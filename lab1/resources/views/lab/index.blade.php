@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $title }}</h1>
            <p class="text-xl text-gray-600 mb-8">{{ $message }}</p>

            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center justify-center">
                    <i class="fas fa-star text-yellow-500 mr-3"></i>
                    Можливості проекту
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($features as $feature)
                        <div class="flex items-start space-x-3 p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                            <i class="fas fa-check text-green-500 mt-1"></i>
                            <span class="text-gray-700">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="/lab/about" class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition group">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full inline-block mb-4 group-hover:bg-blue-200 transition">
                    <i class="fas fa-info-circle text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Про проект</h3>
                <p class="text-sm text-gray-600">Звичайний режим</p>
            </a>

            <a href="/lab/about?mode=debug" class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition group">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full inline-block mb-4 group-hover:bg-yellow-200 transition">
                    <i class="fas fa-bug text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Debug режим</h3>
                <p class="text-sm text-gray-600">З параметром ?mode=debug</p>
            </a>

            <a href="/lab/status" class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition group">
                <div class="bg-green-100 text-green-600 p-3 rounded-full inline-block mb-4 group-hover:bg-green-200 transition">
                    <i class="fas fa-heartbeat text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Статус API</h3>
                <p class="text-sm text-gray-600">Перевірка роботи</p>
            </a>

            <a href="/lab/echo?test=hello&data=example" class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-lg transition group">
                <div class="bg-purple-100 text-purple-600 p-3 rounded-full inline-block mb-4 group-hover:bg-purple-200 transition">
                    <i class="fas fa-exchange-alt text-2xl"></i>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Echo API</h3>
                <p class="text-sm text-gray-600">Тестовий endpoint</p>
            </a>
        </div>
    </div>
@endsection
