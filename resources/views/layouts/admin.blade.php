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
    <!-- Mobile Header (hidden on desktop) -->
    <div class="md:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-100 shadow-sm z-40">
        <div class="flex items-center justify-between p-4">
            <h1 class="text-lg font-bold text-primary">DompetKu Admin</h1>
            <button onclick="toggleMobileMenu()" class="p-2 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="flex">
        <!-- Sidebar (Desktop) / Mobile Menu -->
        <aside id="sidebar" class="fixed md:static top-0 left-0 w-64 h-screen bg-gradient-to-b from-primary to-primary-dark text-white md:translate-x-0 -translate-x-full transition-transform duration-300 z-50 md:z-auto overflow-y-auto pt-16 md:pt-0">
            <!-- Logo -->
            <div class="p-6 border-b border-white/20">
                <h2 class="text-2xl font-bold">DompetKu</h2>
                <p class="text-sm text-white/70 mt-1">Admin Panel</p>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l4-4m0 0l4 4m-4-4V5"></path>
                    </svg>
                    <span class="font-semibold">Dashboard</span>
                </a>

                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.users') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-2a6 6 0 0112 0v2zm0 0h6v-2a6 6 0 00-9-5.684M9 21H9m12 0h.01"></path>
                    </svg>
                    <span class="font-semibold">Manajemen User</span>
                </a>
            </nav>

            <!-- User Info & Logout (Bottom) -->
            <div class="absolute bottom-0 left-0 right-0 border-t border-white/20 p-4 space-y-2">
                <div class="bg-white/10 rounded-lg p-3">
                    <p class="text-sm text-white/70">Logged in as</p>
                    <p class="font-semibold truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-white/60">{{ auth()->user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg transition-colors font-semibold text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay untuk mobile -->
        <div id="overlay" class="fixed inset-0 bg-black/50 md:hidden hidden z-40" onclick="toggleMobileMenu()"></div>

        <!-- Main Content -->
        <main class="flex-1 w-full md:pt-0 pt-20 pb-6 md:pb-6">
            <div class="p-4 md:p-8 max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-lg animate-fade-in">
                <p class="font-semibold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl shadow-lg">
                <p class="font-semibold text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <script>
        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Close menu when clicking on a link
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleMobileMenu();
                }
            });
        });
    </script>
</body>
</html>
