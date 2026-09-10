<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kantin Multi-Tenant' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.css'])
</head>
<body class="bg-gray-100 min-h-screen text-gray-800 antialiased">
    <header class="bg-red-600 text-white p-4 shadow-md sticky top-0 z-50">
        <h1 class="font-bold text-lg">Kantin Multi-Tenant</h1>
    </header>
    <main class="p-4 max-w-md mx-auto">
        {{ $slot }}
    </main>
</body>
</html>