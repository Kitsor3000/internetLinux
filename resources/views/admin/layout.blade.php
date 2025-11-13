<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Адмінка — @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<header class="bg-gray-800 text-white p-4">
    <div class="max-w-6xl mx-auto flex justify-between">
        <h1 class="text-xl font-bold">Адмін-панель</h1>

        <nav class="space-x-4">
            <a href="{{ route('admin.products.index') }}">Товари</a>
            <a href="{{ route('admin.categories.index') }}">Категорії</a>
            <a href="{{ route('admin.orders.index') }}">Замовлення</a>
        </nav>
    </div>
</header>

<main class="max-w-6xl mx-auto p-6">
    @yield('content')
</main>

</body>
</html>
