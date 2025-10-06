<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lab 1' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-blue-600 text-white p-4">
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold">Laravel Lab 1</h1>
        <div class="mt-2 space-x-4">
            <a href="/" class="hover:text-blue-200">Home</a>
            <a href="/lab" class="hover:text-blue-200">Lab Index</a>
            <a href="/lab/about" class="hover:text-blue-200">About</a>
            <a href="/lab/about?mode=debug" class="hover:text-blue-200">About (Debug)</a>
            <a href="/lab/status" class="hover:text-blue-200">Status</a>
            <a href="/lab/echo" class="hover:text-blue-200">Echo</a>
        </div>
    </div>
</nav>

<main class="container mx-auto p-6">
    @yield('content')
</main>

<footer class="bg-gray-800 text-white p-4 mt-8">
    <div class="container mx-auto text-center">
        &copy; {{ date('Y') }} Laravel Lab 1
    </div>
</footer>
</body>
</html>
