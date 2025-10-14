<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Система пошуку зниклих осіб')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
<!-- Header -->
<header class="bg-blue-800 text-white shadow-lg">
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <div class="bg-white text-blue-800 p-2 rounded-lg">
                    <i class="fas fa-search text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">
                        <a href="{{ route('home') }}">FindMissing UA</a>
                    </h1>
                    <p class="text-sm">Система пошуку зниклих осіб</p>
                </div>
            </div>

            <nav class="flex flex-wrap justify-center gap-2">
                <a href="{{ route('home') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-home mr-2"></i>Головна
                </a>
                <a href="{{ route('missing-persons.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg transition">
                    <i class="fas fa-plus mr-2"></i>Додати особу
                </a>
                <a href="{{ route('categories.index') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-tags mr-2"></i>Категорії
                </a>
                <a href="{{ route('locations.index') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-map-marker-alt mr-2"></i>Локації
                </a>
                <a href="{{ route('about') }}" class="px-4 py-2 text-white hover:bg-blue-700 rounded-lg transition">
                    <i class="fas fa-info-circle mr-2"></i>Про проект
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- Flash Messages -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-4 mt-4">
        <div class="container mx-auto">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-4 mt-4">
        <div class="container mx-auto">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('error') }}
        </div>
    </div>
@endif

<!-- Main Content -->
<main class="container mx-auto px-4 py-8">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="container mx-auto px-4 text-center">
        <p class="text-lg font-semibold">&copy; {{ date('Y') }} FindMissing UA</p>
        <p class="text-gray-400 mt-2">Система пошуку зниклих осіб</p>
        <p class="text-sm text-gray-500 mt-4">Гаряча лінія: <strong>0 800 330 111</strong></p>
    </div>
</footer>
</body>
</html>
