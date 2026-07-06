<!DOCTYPE html>
<html lang="id" class="h-full bg-[#FAF4EE]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Layanan TI - BIRO TI BPK RI')</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FAF4EE;
        }
        .font-mono {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #e2e6ea;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
</head>
<body class="h-full text-gray-800 antialiased selection:bg-[#fcf4ec] selection:text-[#b26d27]" x-data="{ mobileMenuOpen: false }">

    @php
        $currentUser = Auth::user();
        $subbagMaster = [
            'k1' => 'Subbagian Pengelolaan Infrastruktur dan Jaringan',
            'k2' => 'Subbagian Pelayanan TIK',
            'k3' => 'Subbagian Pengembangan Sistem Informasi Pemeriksaan',
            'k4' => 'Subbagian Pengembangan Sistem Informasi Kelembagaan',
            'k5' => 'Subbagian Sains Data',
            'k6' => 'Subbagian Tata Kelola Data',
            'k7' => 'Subbagian Keamanan Informasi',
            'k8' => 'Subbagian MIOT',
        ];
        $subbagName = $currentUser && $currentUser->subbagId ? ($subbagMaster[$currentUser->subbagId] ?? '') : '';

        // Role display helper
        $roleDisplay = 'Pegawai BPK RI';
        if ($currentUser) {
            switch ($currentUser->role) {
                case 'pengguna': $roleDisplay = 'Pegawai BPK RI'; break;
                case 'kasubbag': $roleDisplay = 'Kasubbag TI'; break;
                case 'solver': $roleDisplay = 'Solver TI'; break;
                case 'operator': $roleDisplay = 'Operator Biro TI'; break;
            }
        }

        // Sidebar nav items mapping
        $navItems = [];
        if ($currentUser) {
            if ($currentUser->role === 'pengguna') {
                $navItems = [
                    ['label' => 'Beranda', 'route' => 'dashboard', 'icon' => 'home'],
                    ['label' => 'Tiket saya', 'route' => 'dashboard.tiket', 'icon' => 'layers'],
                ];
            } elseif ($currentUser->role === 'kasubbag') {
                $navItems = [
                    ['label' => 'Inbox Tiket', 'route' => 'kasubbag', 'icon' => 'inbox'],
                ];
            } elseif ($currentUser->role === 'solver') {
                $navItems = [
                    ['label' => 'Tugas Saya', 'route' => 'solver', 'icon' => 'check-square'],
                ];
            } elseif ($currentUser->role === 'operator') {
                $navItems = [
                    ['label' => 'Overview', 'route' => 'operator', 'icon' => 'layout-dashboard'],
                    ['label' => 'Semua Tiket', 'route' => 'operator.tiket', 'icon' => 'file-spreadsheet'],
                    ['label' => 'Analitik', 'route' => 'operator.analitik', 'icon' => 'bar-chart-3'],
                ];
            }
        }
    @endphp

    <div class="min-h-screen flex flex-col">
        <!-- TOP BAR (Full Width) -->
        <header class="bg-white border-b border-[#e2e6ea] h-16 flex items-center justify-between px-6 z-30 shrink-0">
            <!-- Left Side: Brand Logo -->
            <div class="flex items-center gap-2.5">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-1.5 text-gray-500 hover:bg-slate-100 rounded-lg cursor-pointer">
                    <i data-lucide="menu" class="w-5.5 h-5.5"></i>
                </button>
                <a href="/" class="flex items-center gap-2.5">
                    <img src="/logo-melati.png" alt="Logo Melati" class="w-7 h-7 object-contain">
                    <span class="text-base font-extrabold text-[#b26d27] tracking-tight">Melati V2</span>
                </a>
            </div>

            <!-- Center: Search Input -->
            <div class="flex-1 max-w-sm mx-6 relative hidden md:block">
                <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="text" placeholder="Cari Tiket Anda" class="w-full bg-[#f5f6f8] border-0 text-gray-700 rounded-full pl-9.5 pr-4 py-2 text-xs outline-none focus:ring-1 focus:ring-[#b26d27]/30 transition-all font-semibold placeholder:text-gray-400">
            </div>

            <!-- Right Side: User Actions -->
            <div class="flex items-center gap-4.5">
                @if($currentUser && $currentUser->role === 'pengguna')
                    <!-- Create Ticket Button -->
                    <a href="{{ route('dashboard.lapor') }}" class="bg-[#c69a6b] hover:bg-[#b27c3f] text-white font-bold text-xs px-4 py-2 rounded-full transition-all shadow-xs flex items-center gap-1.5 cursor-pointer">
                        <span>+ Buat tiket</span>
                    </a>
                @endif

                <!-- Notification Bell -->
                <button class="text-gray-500 hover:text-gray-800 p-1.5 rounded-full hover:bg-slate-50 transition-all cursor-pointer relative">
                    <i data-lucide="bell" class="w-4.5 h-4.5"></i>
                    <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                </button>

                <!-- User Profile Info -->
                <div class="flex items-center gap-2.5 pl-3 border-l border-slate-100">
                    <div class="w-8 h-8 rounded-full bg-slate-200 border border-slate-300 text-gray-700 flex items-center justify-center font-extrabold text-xs">
                        {{ $currentUser ? substr($currentUser->name, 0, 2) : 'US' }}
                    </div>
                    <div class="text-left leading-tight hidden sm:block">
                        <div class="text-xs font-bold text-gray-900">{{ $currentUser->name ?? '' }}</div>
                        <div class="text-[10px] text-gray-400 font-medium">{{ $roleDisplay }}</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- LAYOUT INNER CONTAINER -->
        <div class="flex-1 flex relative">
            
            <!-- DESKTOP SIDEBAR -->
            <aside class="hidden md:flex md:w-56 md:flex-col border-r border-[#e2e6ea] bg-white h-[calc(100vh-4rem)] shrink-0 select-none">
                <div class="flex flex-col h-full justify-between py-4">
                    <!-- Navigation Items -->
                    <nav class="px-3 space-y-1">
                        @foreach($navItems as $item)
                            @php
                                $isActive = Route::currentRouteName() === $item['route'] || ($item['route'] === 'dashboard' && Route::currentRouteName() === 'dashboard.lapor');
                            @endphp
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition-all {{ $isActive ? 'bg-[#fcf4ec] text-[#b26d27]' : 'text-gray-500 hover:bg-slate-50 hover:text-gray-800' }}">
                                <i data-lucide="{{ $item['icon'] }}" class="w-4.5 h-4.5"></i>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </nav>

                    <!-- Sidebar Footer / Logout -->
                    <div class="px-3">
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 pt-3">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-xs font-bold text-gray-400 hover:text-red-600 rounded-xl transition-all cursor-pointer text-left">
                                <i data-lucide="log-out" class="w-4.5 h-4.5"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- MOBILE DRAWER -->
            <div x-show="mobileMenuOpen" class="fixed inset-0 z-40 flex md:hidden" style="display: none;">
                <!-- Backdrop -->
                <div @click="mobileMenuOpen = false" class="fixed inset-0 bg-black/50 transition-opacity"></div>
                
                <!-- Drawer Container -->
                <div class="relative flex flex-col w-56 bg-white border-r border-slate-100 h-full p-4 justify-between z-50">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-extrabold text-[#b26d27]">MENU</span>
                            <button @click="mobileMenuOpen = false" class="p-1 hover:bg-slate-50 rounded">
                                <i data-lucide="x" class="w-4.5 h-4.5"></i>
                            </button>
                        </div>
                        <nav class="space-y-1">
                            @foreach($navItems as $item)
                                @php
                                    $isActive = Route::currentRouteName() === $item['route'] || ($item['route'] === 'dashboard' && Route::currentRouteName() === 'dashboard.lapor');
                                @endphp
                                <a href="{{ route($item['route']) }}" @click="mobileMenuOpen = false"
                                   class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition-all {{ $isActive ? 'bg-[#fcf4ec] text-[#b26d27]' : 'text-gray-500 hover:bg-slate-50 hover:text-gray-800' }}">
                                    <i data-lucide="{{ $item['icon'] }}" class="w-4.5 h-4.5"></i>
                                    <span>{{ $item['label'] }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    <div>
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 pt-3">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-xs font-bold text-gray-400 hover:text-red-600 rounded-xl transition-all cursor-pointer text-left">
                                <i data-lucide="log-out" class="w-4.5 h-4.5"></i>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT AREA -->
            <main class="flex-1 p-6 overflow-y-auto h-[calc(100vh-4rem)] bg-[#FAF4EE]">
                <div class="max-w-7xl mx-auto h-full">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
