@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $title }}</h1>

                @if($debugMode)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-6">
                        <div class="flex items-center justify-center space-x-3 mb-3">
                            <i class="fas fa-bug text-2xl text-yellow-600"></i>
                            <span class="text-xl font-semibold text-yellow-800">Режим налагодження</span>
                        </div>
                        <p class="text-yellow-700">{{ $message }}</p>
                    </div>
                @else
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-6">
                        <div class="flex items-center justify-center space-x-3 mb-3">
                            <i class="fas fa-rocket text-2xl text-blue-600"></i>
                            <span class="text-xl font-semibold text-blue-800">Звичайний режим</span>
                        </div>
                        <p class="text-blue-700">{{ $message }}</p>
                    </div>
                @endif
            </div>

            <div class="prose max-w-none">
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    {{ $description }}
                </p>

                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="font-semibold text-gray-800 mb-3 flex items-center">
                        <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                        Як це працює?
                    </h3>
                    <ul class="text-gray-600 space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-arrow-right text-green-500 mt-1 mr-2"></i>
                            Middleware перевіряє наявність параметра <code class="bg-gray-200 px-2 py-1 rounded">mode=debug</code> в URL
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-arrow-right text-green-500 mt-1 mr-2"></i>
                            Якщо параметр є, додається спеціальний заголовок
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-arrow-right text-green-500 mt-1 mr-2"></i>
                            Контролер перевіряє заголовок і змінює відображення
                        </li>
                    </ul>
                </div>

                <div class="mt-8 text-center">
                    <a href="/lab" class="inline-flex items-center px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Повернутись до всіх сторінок
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
