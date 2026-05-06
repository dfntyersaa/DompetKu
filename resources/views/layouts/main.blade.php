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
    <!-- Desktop Navigation Bar (VISIBLE ON DESKTOP) -->
    <nav class="hidden md:block sticky top-0 z-30 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-primary">DompetKu</h1>
                
                <div class="flex items-center gap-8">
                    <!-- Desktop Navigation Links -->
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg font-semibold transition-colors {{ request()->routeIs('dashboard') ? 'text-primary bg-primary/10' : 'text-neutral-text hover:bg-gray-100' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('transaksi.index') }}" class="px-4 py-2 rounded-lg font-semibold transition-colors {{ request()->routeIs('transaksi.*') ? 'text-primary bg-primary/10' : 'text-neutral-text hover:bg-gray-100' }}">
                        Transaksi
                    </a>
                    <a href="{{ route('budget.index') }}" class="px-4 py-2 rounded-lg font-semibold transition-colors {{ request()->routeIs('budget.*') ? 'text-primary bg-primary/10' : 'text-neutral-text hover:bg-gray-100' }}">
                        Budget
                    </a>

                    <!-- User Dropdown -->
                    <div class="relative" id="userDropdown">
                        <button onclick="toggleUserDropdown()" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdownMenu" class="absolute top-full right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 hidden z-50">
                            <div class="p-3 border-b border-gray-100">
                                <p class="font-semibold text-sm text-neutral-text">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-neutral-text-secondary">{{ auth()->user()->email }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="p-2">
                                @csrf
                                <button type="submit" class="w-full text-left text-sm font-semibold text-red-500 hover:bg-red-50 rounded-lg px-3 py-2 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Header with Hamburger (VISIBLE ON MOBILE) -->
    <div class="md:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-100 z-30 h-20">
        <div class="flex items-center justify-between px-4 h-full">
            <h1 class="text-xl font-bold text-primary">DompetKu</h1>
            <button onclick="toggleMobileMenu()" class="p-2 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Sidebar Menu (HIDDEN BY DEFAULT, VISIBLE WHEN TOGGLED) -->
    <div id="mobileMenuOverlay" class="md:hidden fixed inset-0 bg-black/50 hidden z-40" onclick="toggleMobileMenu()"></div>
    <div id="mobileSidebar" class="md:hidden fixed left-0 top-0 h-screen w-64 bg-white transform -translate-x-full z-50 transition-transform duration-300 overflow-y-auto pt-24">
        <div class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary font-semibold' : 'text-neutral-text hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l4-4m0 0l4 4m-4-4V5"></path>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('transaksi.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('transaksi.*') ? 'bg-primary/10 text-primary font-semibold' : 'text-neutral-text hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Transaksi
            </a>

            <a href="{{ route('budget.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('budget.*') ? 'bg-primary/10 text-primary font-semibold' : 'text-neutral-text hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                Budget
            </a>
        </div>

        <!-- Mobile Logout -->
        <div class="absolute bottom-0 left-0 right-0 border-t border-gray-100 p-4 space-y-3">
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-neutral-text-secondary">Logged in as</p>
                <p class="font-semibold text-sm truncate">{{ auth()->user()->name }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-500 text-white rounded-lg font-semibold text-sm hover:bg-red-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main class="pt-20 md:pt-0 pb-28 md:pb-8">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 md:py-8">
            @yield('content')
        </div>
    </main>

    <!-- Bottom Navigation (Mobile Only - VISIBLE ON MOBILE) -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 z-20">
        <div class="flex justify-around items-center h-20">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center flex-1 py-2 hover:bg-gray-50 {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-neutral-text-secondary' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l4-4m0 0l4 4m-4-4V5"></path>
                </svg>
                <span class="text-xs font-semibold">Dashboard</span>
            </a>

            <a href="{{ route('transaksi.index') }}" class="flex flex-col items-center justify-center flex-1 py-2 hover:bg-gray-50 {{ request()->routeIs('transaksi.*') ? 'text-primary' : 'text-neutral-text-secondary' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-xs font-semibold">Transaksi</span>
            </a>

            <a href="{{ route('budget.index') }}" class="flex flex-col items-center justify-center flex-1 py-2 hover:bg-gray-50 {{ request()->routeIs('budget.*') ? 'text-primary' : 'text-neutral-text-secondary' }}">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
                <span class="text-xs font-semibold">Budget</span>
            </a>

            <button onclick="toggleMobileMenu()" class="flex flex-col items-center justify-center flex-1 py-2 hover:bg-gray-50 text-neutral-text-secondary">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                </svg>
                <span class="text-xs font-semibold">Menu</span>
            </button>
        </div>
    </nav>

    <!-- Session Alerts -->
    @if (session('success'))
        <div class="fixed top-24 md:top-20 right-4 z-50">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-lg">
                <p class="font-semibold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-24 md:top-20 right-4 z-50">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl shadow-lg">
                <p class="font-semibold text-sm">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <script>
        function toggleMobileMenu() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileMenuOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleUserDropdown() {
            const menu = document.getElementById('userDropdownMenu');
            menu.classList.toggle('hidden');
        }

        // Close user dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown && !dropdown.contains(e.target)) {
                document.getElementById('userDropdownMenu').classList.add('hidden');
            }
        });

        // Close menu when clicking a link
        document.querySelectorAll('#mobileSidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleMobileMenu();
                }
            });
        });

        // Close menu with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('mobileSidebar');
                if (!sidebar.classList.contains('-translate-x-full')) {
                    toggleMobileMenu();
                }
            }
        });
    </script>
</body>
</html>
