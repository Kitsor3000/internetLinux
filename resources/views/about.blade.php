@extends('layouts.app')

@section('title', 'Про проект')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Про проект</h1>

            <div class="prose max-w-none">
                <p class="text-lg text-gray-600 mb-6">
                    <strong>FindMissing UA</strong> - це система для пошуку та ведення обліку зниклих осіб.
                    Проект розроблено в рамках лабораторної роботи з Laravel.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-blue-800 mb-2">⚡ Можливості системи</h3>
                        <ul class="text-blue-700 space-y-1">
                            <li>• Додавання зниклих осіб</li>
                            <li>• Категорізація та пошук</li>
                            <li>• Звіти про появи</li>
                            <li>• Геолокація</li>
                            <li>• CRUD операції</li>
                        </ul>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="font-semibold text-green-800 mb-2">🛠️ Технології</h3>
                        <ul class="text-green-700 space-y-1">
                            <li>• Laravel 10</li>
                            <li>• MySQL/SQLite</li>
                            <li>• Tailwind CSS</li>
                            <li>• Blade Templates</li>
                            <li>• Eloquent ORM</li>
                        </ul>
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                    <h3 class="font-semibold text-yellow-800 mb-3">📚 Лабораторна робота №2</h3>
                    <p class="text-yellow-700">
                        Цей проект демонструє роботу з міграціями, моделями, контролерами та представленнями
                        в Laravel. Реалізовано повний цикл CRUD операцій для системи пошуку зниклих осіб.
                    </p>
                </div>

                <div class="text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Повернутись на головну
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
