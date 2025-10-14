@extends('layouts.app')

@section('title', 'Про проект')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Про проект FindMissing UA</h1>

            <div class="prose max-w-none">
                <p class="text-lg text-gray-600 mb-6">
                    Система для пошуку та ведення обліку зниклих осіб.
                    Розроблено в рамках лабораторної роботи з Laravel.
                </p>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h3 class="font-semibold text-blue-800 mb-3">Функціонал системи:</h3>
                    <ul class="text-blue-700 space-y-2">
                        <li>• Додавання та управління інформацією про зниклих осіб</li>
                        <li>• Категорізація за віком та особливими ознаками</li>
                        <li>• Ведення звітів про появи</li>
                        <li>• Геолокація останніх відомих місць перебування</li>
                        <li>• Пошук та фільтрація</li>
                    </ul>
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
