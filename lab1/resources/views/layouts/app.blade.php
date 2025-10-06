<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laravel Lab' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
<!-- Header -->
<header class="bg-white shadow-sm border-b">
    <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-3 mb-4 md:mb-0">
                <div class="bg-blue-500 text-white p-2 rounded-lg">
                    <i class="fas fa-flask text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Laravel Lab</h1>
                    <p class="text-sm text-gray-600">Лабораторна робота №1</p>
                </div>
            </div>

            <nav class="flex flex-wrap justify-center gap-2">
                <a href="/" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition flex items-center">
                    <i class="fas fa-home mr-2"></i>Головна
                </a>
                <a href="/lab" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition flex items-center">
                    <i class="fas fa-list mr-2"></i>Всі сторінки
                </a>
                <a href="/lab/about" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>Про проект
                </a>
                <a href="/lab/about?mode=debug" class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg transition flex items-center">
                    <i class="fas fa-bug mr-2"></i>Debug
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-4 py-8">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white border-t mt-12">
    <div class="container mx-auto px-4 py-6">
        <div class="text-center">
            <div class="flex justify-center space-x-6 mb-4">
                <div class="text-center">
                    <div class="bg-green-100 text-green-800 p-3 rounded-full inline-block">
                        <i class="fas fa-check text-lg"></i>
                    </div>
                    <p class="text-sm mt-2 text-gray-600">Middleware</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 text-purple-800 p-3 rounded-full inline-block">
                        <i class="fas fa-code text-lg"></i>
                    </div>
                    <p class="text-sm mt-2 text-gray-600">Controllers</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 text-blue-800 p-3 rounded-full inline-block">
                        <i class="fas fa-palette text-lg"></i>
                    </div>
                    <p class="text-sm mt-2 text-gray-600">Views</p>
                </div>
            </div>
            <p class="text-gray-600">&copy; {{ date('Y') }} Laravel Laboratory. Всі права захищені.</p>
        </div>
    </div>
</footer>
</body>
</html>
