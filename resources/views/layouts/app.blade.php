<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Магазин інструментів')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- Шапка -->
    <header class="bg-blue-600 text-white py-4">
        <div class="max-w-5xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold">
                🔧 ToolStore
            </a>

            <nav class="space-x-4">
                <a href="{{ route('products.index') }}">Товари</a>
                <a href="{{ route('cart.index') }}">Кошик</a>
            </nav>
        </div>
    </header>

    <!-- Контент -->
    <main class="max-w-5xl mx-auto p-6">
        @yield('content')
    </main>

    <!-- Футер -->
    <footer class="bg-gray-800 text-white py-4 mt-10">
        <div class="max-w-5xl mx-auto text-center">
            © {{ date('Y') }} ToolStore
        </div>
    </footer>

</body>
</html>
