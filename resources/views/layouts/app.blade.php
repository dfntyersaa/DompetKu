<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DompetKu - Smart Finance Tracker">
    <title>@yield('title', 'DompetKu')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-neutral-bg font-sans text-neutral-text">
    @yield('content')

    <!-- Navigation Alert -->
    @if ($errors->any())
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl shadow-lg">
                <p class="font-semibold">Terjadi kesalahan!</p>
                @foreach ($errors->all() as $error)
                    <p class="text-sm">- {{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-lg animate-fade-in">
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl shadow-lg">
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
        </div>
    @endif
</body>
</html>
