<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <!-- Header -->
        <header class="bg-blue-800 text-white shadow-lg">
            <div class="container mx-auto px-4 py-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-3 mb-4 md:mb-0">
                        <div class="bg-white text-blue-800 p-2 rounded-lg">
                            <i class="fas fa-search text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">FindMissing UA</h1>
                            <p class="text-sm">Система пошуку зниклих осіб</p>
                        </div>
                    </div>

                    <nav class="flex flex-wrap justify-center gap-2">
                        <a href="{{ route('home') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                            <i class="fas fa-home mr-2"></i>Головна
                        </a>
                        <a href="{{ route('categories.index') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                            <i class="fas fa-tags mr-2"></i>Категорії
                        </a>
                        <a href="{{ route('locations.index') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                            <i class="fas fa-map-marker-alt mr-2"></i>Локації
                        </a>

                        @auth
                            <!-- Адмін меню -->
                            <a href="{{ route('missing-persons.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg transition">
                                <i class="fas fa-plus mr-2"></i>Додати особу
                            </a>
                            <a href="{{ route('locations.create') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg transition">
                                <i class="fas fa-map-pin mr-2"></i>Додати локацію
                            </a>

                            <!-- Dropdown меню користувача -->
                            <div class="relative group">
                                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition flex items-center">
                                    <i class="fas fa-user mr-2"></i>{{ Auth::user()->name }}
                                    <i class="fas fa-chevron-down ml-2"></i>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block z-50">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user-edit mr-2"></i>Профіль
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Вийти
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Гостьове меню -->
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg transition">
                                <i class="fas fa-sign-in-alt mr-2"></i>Увійти
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg transition">
                                <i class="fas fa-user-plus mr-2"></i>Реєстрація
                            </a>
                        @endauth
                    </nav>
                </div>
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        @if(isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>
</div>

<!-- Scripts для Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<!-- Script для dropdown меню -->
<script>
    // Додаємо функціонал для dropdown меню
    document.addEventListener('DOMContentLoaded', function() {
        const dropdowns = document.querySelectorAll('.group');

        dropdowns.forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const menu = dropdown.querySelector('.hidden');

            button.addEventListener('click', function() {
                menu.classList.toggle('hidden');
            });

            // Закриваємо меню при кліку поза ним
            document.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    });
</script>
</body>
</html>
