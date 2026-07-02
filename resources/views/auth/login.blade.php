<!DOCTYPE html>
<html lang="id" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Portal Pelayanan Teknologi Informasi</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        .writing-mode-vertical {
            writing-mode: vertical-lr;
            text-orientation: mixed;
        }
    </style>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="h-full antialiased selection:bg-[#fcf4ec] selection:text-[#b26d27]" 
      x-data="loginPage()">

    <div class="min-h-screen bg-white flex w-full relative overflow-hidden">
        <!-- LEFT PANEL: Form Section -->
        <div class="w-full lg:w-[45%] xl:w-[40%] bg-white p-8 md:p-16 flex flex-col justify-between relative z-10 min-h-screen shrink-0 shadow-xl lg:shadow-none">
            <div class="my-auto max-w-sm w-full mx-auto space-y-8">
                <!-- Logo Header -->
                <div class="flex items-center gap-2 mb-2">
                    <img src="/logo-melati.png" alt="Logo Melati" class="w-8 h-8 object-contain" @click="clickFlower()" />
                    <span class="text-xl font-extrabold text-[#b26d27] tracking-tight">
                        Melati V2
                    </span>
                </div>

                <!-- Title & Description -->
                <div class="space-y-3">
                    <h1 class="text-3xl md:text-[34px] font-black text-[#b26d27] tracking-tight leading-[1.15]">
                        Portal Pelayanan <br />
                        Teknologi Informasi
                    </h1>
                    <p class="text-xs text-gray-500 font-medium tracking-wide">
                        Silahkan masuk dengan akun email Anda
                    </p>
                </div>

                <!-- Form Card -->
                <div class="space-y-6">
                    <div x-show="error" class="p-3.5 rounded-xl bg-rose-50 border border-rose-100 text-rose-800 text-xs font-semibold flex items-center gap-2.5" style="display: none;">
                        <i data-lucide="shield-alert" class="w-4 h-4 shrink-0 text-rose-600"></i>
                        <span x-text="error"></span>
                    </div>

                    <form @submit.prevent="submitLogin()" class="space-y-4">
                        <!-- Username Input -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-1.5 uppercase tracking-wider">
                                Email
                            </label>
                            <input
                                type="text"
                                x-model="username"
                                placeholder="Admin123@bpk.go.id"
                                class="w-full bg-white border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-xl px-4 py-3 text-sm outline-none transition-all placeholder:text-gray-300 font-medium"
                            />
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label class="block text-xs font-bold text-gray-400 mb-1.5 uppercase tracking-wider">
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    x-model="password"
                                    placeholder="••••••••"
                                    class="w-full bg-white border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-xl pl-4 pr-11 py-3 text-sm outline-none transition-all placeholder:text-gray-300 font-medium"
                                />
                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 cursor-pointer"
                                >
                                    <i :data-lucide="showPassword ? 'eye-off' : 'eye'" class="w-4.5 h-4.5"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between text-xs text-gray-400 font-medium pt-1">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input
                                    type="checkbox"
                                    x-model="remember"
                                    class="rounded border-slate-300 text-[#b26d27] focus:ring-[#b26d27] w-3.5 h-3.5"
                                />
                                <span>Remember me</span>
                            </label>
                            <a
                                href="#forgot"
                                @click.prevent="alert('Silakan hubungi Administrator Biro TI untuk mereset kata sandi Anda.')"
                                class="hover:underline hover:text-[#b26d27] transition-colors"
                            >
                                Forgot password?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full bg-[#b26d27] hover:bg-[#9b5a1b] text-white font-bold text-sm py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer mt-5 disabled:opacity-55"
                        >
                            <span x-text="loading ? 'Memuat...' : 'Login'"></span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <div
                @click="triggerRickroll()"
                class="text-center text-[10px] text-gray-400 font-mono tracking-widest mt-8 cursor-pointer hover:text-[#b26d27] transition-all hover:scale-105 select-none"
            >
                © Biro TI 2026
            </div>
        </div>

        <!-- RIGHT PANEL: Jasmine Backdrop with real PNG assets -->
        <div
            class="hidden lg:flex flex-1 items-center justify-center relative overflow-hidden border-l border-[#fde68a]/30"
            style="background: radial-gradient(ellipse at 50% 55%, #f5c58a 0%, #fae0b0 28%, #fdf3e0 58%, #fffcf7 82%, #ffffff 100%)"
        >
            <!-- Sparkles -->
            <svg class="absolute top-[18%] left-[12%] w-9 h-9 animate-pulse z-20" style="animation-duration: 3s" viewBox="0 0 32 32" fill="white">
                <path d="M16 2 L17.2 14.8 L30 16 L17.2 17.2 L16 30 L14.8 17.2 L2 16 L14.8 14.8 Z" />
            </svg>
            <svg class="absolute top-[14%] right-[14%] w-7 h-7 animate-pulse z-20" style="animation-duration: 4s; animation-delay: 1.2s" viewBox="0 0 32 32" fill="white">
                <path d="M16 2 L17.2 14.8 L30 16 L17.2 17.2 L16 30 L14.8 17.2 L2 16 L14.8 14.8 Z" />
            </svg>

            <!-- tangkai-melati Left -->
            <div class="absolute z-10" style="width: 80px; height: 55%; bottom: -10px; left: calc(32% - 40px); transform-origin: bottom center; transform: rotate(-7deg);">
                <img src="/tangkai-melati.png" alt="" class="w-full h-full object-fill" />
            </div>

            <!-- bunga-melati Left -->
            <div class="absolute z-20 cursor-pointer" style="width: 800px; height: 800px; top: 8%; left: -17%; filter: drop-shadow(6px 10px 28px rgba(0,0,0,0.14)); transform: rotate(-12deg);" @click="clickFlower()">
                <img src="/bunga-melati.png" alt="Bunga Melati Kiri" class="w-full h-full object-contain" />
            </div>

            <!-- tangkai-melati Right -->
            <div class="absolute z-10" style="width: 72px; height: 52%; bottom: -10px; left: calc(62% - 36px); transform-origin: bottom center; transform: rotate(5deg);">
                <img src="/tangkai-melati.png" alt="" class="w-full h-full object-fill" />
            </div>

            <!-- bunga-melati Right -->
            <div class="absolute z-30 cursor-pointer" style="width: 800px; height: 800px; top: 12%; right: 0%; filter: drop-shadow(6px 10px 24px rgba(0,0,0,0.12)); transform: rotate(10deg);" @click="clickFlower()">
                <img src="/bunga-melati.png" alt="Bunga Melati Kanan" class="w-full h-full object-contain" />
            </div>
        </div>

        <!-- FLOATING TRIGGER BUTTON FOR COLLAPSIBLE DEMO PANEL -->
        <button
            @click="isDemoOpen = true"
            class="fixed right-0 top-1/2 -translate-y-1/2 bg-[#fcf4ec] border border-[#f7e3ce] text-[#b26d27] py-5 px-3 rounded-l-2xl shadow-xl flex flex-col items-center gap-2 cursor-pointer hover:bg-white transition-all duration-200 border-r-0 z-40 group hover:pl-4"
        >
            <i data-lucide="key-round" class="w-5 h-5 text-[#b26d27] group-hover:scale-110 transition-transform"></i>
            <span class="writing-mode-vertical uppercase text-[9px] font-black tracking-widest text-[#b26d27]">
                UJI COBA
            </span>
        </button>

        <!-- COLLAPSIBLE SIDEBAR DRAWER: Demo Accounts -->
        <div
            class="fixed top-0 right-0 h-full w-80 sm:w-96 bg-white shadow-2xl z-50 border-l border-slate-200 flex flex-col transition-all duration-300 transform"
            :class="isDemoOpen ? 'translate-x-0' : 'translate-x-full'"
        >
            <!-- Header -->
            <div class="p-4.5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="key-round" class="w-5 h-5 text-[#b26d27]"></i>
                    <div>
                        <h3 class="text-xs font-black text-gray-800 uppercase tracking-wider">
                            Akun Uji Coba (Demo)
                        </h3>
                        <p class="text-[10px] text-gray-400 font-medium">
                            Klik profil untuk login otomatis
                        </p>
                    </div>
                </div>
                <button
                    @click="isDemoOpen = false"
                    class="text-gray-400 hover:text-gray-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors cursor-pointer"
                >
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Tab Filters -->
            <div class="p-3 bg-slate-50/30 border-b border-slate-100 flex flex-wrap gap-1.5">
                <template x-for="tab in ['all', 'pengguna', 'kasubbag', 'solver', 'operator']">
                    <button
                        @click="demoTab = tab"
                        class="px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider transition-all cursor-pointer"
                        :class="demoTab === tab ? 'bg-[#b26d27] text-white' : 'bg-white border border-slate-200 text-gray-500 hover:bg-slate-50'"
                    >
                        <span x-text="tab === 'all' ? 'Semua' : (tab === 'pengguna' ? 'Pelapor' : tab)"></span>
                    </button>
                </template>
            </div>

            <!-- Accounts List Grid -->
            <div class="flex-1 overflow-y-auto p-4.5 space-y-3.5 scroll-thin">
                @php
                    $rawDemoUsers = [
                        ['id' => 'u1', 'name' => 'Budi Santoso', 'username' => 'budi', 'password' => 'budi123', 'role' => 'pengguna', 'subbagId' => null],
                        ['id' => 'u2', 'name' => 'Siti Rahayu', 'username' => 'siti', 'password' => 'siti123', 'role' => 'pengguna', 'subbagId' => null],
                        ['id' => 'u3', 'name' => 'Ahmad Fauzi', 'username' => 'ahmad', 'password' => 'ahmad123', 'role' => 'pengguna', 'subbagId' => null],
                        ['id' => 'u4', 'name' => 'Dewi Kusuma', 'username' => 'dewi', 'password' => 'dewi123', 'role' => 'pengguna', 'subbagId' => null],
                        ['id' => 'k1', 'name' => 'Ir. Hartono, M.T.', 'username' => 'kasubbag.infrastruktur', 'password' => 'pass123', 'role' => 'kasubbag', 'subbagId' => 'k1'],
                        ['id' => 'k2', 'name' => 'Dra. Wulandari, M.Si.', 'username' => 'kasubbag.pelayanan', 'password' => 'pass123', 'role' => 'kasubbag', 'subbagId' => 'k2'],
                        ['id' => 'k3', 'name' => 'Rizal Pratama, S.T.', 'username' => 'kasubbag.si.pemeriksaan', 'password' => 'pass123', 'role' => 'kasubbag', 'subbagId: k3'],
                        ['id' => 'op1', 'name' => 'Operator TI Utama BPK', 'username' => 'admin', 'password' => 'admin123', 'role' => 'operator', 'subbagId' => null],
                    ];
                @endphp
                <template x-for="user in demoUsers" :key="user.username">
                    <div x-show="demoTab === 'all' || user.role === demoTab">
                        <button
                            @click="autofill(user)"
                            class="w-full p-4 text-left rounded-xl transition-all border flex flex-col justify-between cursor-pointer"
                            :class="username === user.username ? 'border-[#b26d27] bg-[#fcf4ec] ring-1 ring-[#b26d27]/50 shadow-sm' : 'border-slate-100 bg-slate-50/70 hover:bg-white hover:border-slate-200 hover:shadow-xs'"
                        >
                            <div class="flex items-center justify-between gap-2 w-full">
                                <span class="text-xs font-bold text-gray-900 truncate" x-text="user.name"></span>
                                <span class="text-[9px] font-extrabold px-2 py-0.5 rounded border uppercase tracking-tight"
                                      :class="getRoleBadgeClass(user.role)"
                                      x-text="user.role === 'pengguna' ? 'Pelapor' : user.role"></span>
                            </div>

                            <div class="mt-3 flex items-center justify-between text-[10px] text-gray-500 font-mono w-full bg-white/60 p-2 rounded-lg border border-slate-100">
                                <span class="truncate">id: <strong class="text-gray-700" x-text="user.username"></strong></span>
                                <span class="shrink-0 bg-slate-100 px-1 py-0.5 rounded text-gray-600 font-semibold" x-text="'pwd: ' + user.password"></span>
                            </div>
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <!-- RICKROLL MODAL -->
        <div x-show="isRickrolled" class="fixed inset-0 bg-black/95 flex flex-col items-center justify-center z-[100] p-4 backdrop-blur-lg" style="display: none;">
            <div class="bg-slate-900 border border-slate-700 w-full max-w-2xl rounded-3xl overflow-hidden shadow-2xl flex flex-col relative text-white">
                <div class="p-4 border-b border-slate-800 flex items-center justify-between bg-slate-950">
                    <span class="font-bold text-xs uppercase tracking-wider text-slate-100">
                        😎 YOU GOT RICKROLLED! 🎵
                    </span>
                    <button @click="isRickrolled = false" class="text-slate-400 hover:text-white p-1.5 hover:bg-slate-800 rounded-lg cursor-pointer">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <div class="relative w-full aspect-video bg-black">
                    <iframe x-if="isRickrolled" class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=0" title="Rick Astley" frameBorder="0" allow="autoplay; encrypted-media" allowFullScreen></iframe>
                </div>
                <div class="p-4 bg-slate-950 text-center text-xs text-slate-400 font-medium">
                    Never gonna give you up, never gonna let you down... 😉
                </div>
            </div>
        </div>

        <!-- MINIGAME MODAL -->
        <div x-show="isMinigameOpen" class="fixed inset-0 bg-black/85 flex items-center justify-center z-50 p-4 backdrop-blur-md" style="display: none;">
            <div class="bg-slate-900 border border-slate-700 w-full max-w-md rounded-3xl overflow-hidden shadow-2xl flex flex-col relative text-white">
                <div class="p-4 border-b border-slate-800 flex items-center justify-between bg-slate-950">
                    <div class="flex items-center gap-2">
                        <i data-lucide="trophy" class="w-5 h-5 text-yellow-500 animate-bounce"></i>
                        <span class="font-bold text-xs uppercase tracking-wider text-slate-100">
                            Adu Penalti BPK 🇮🇩
                        </span>
                    </div>
                    <button @click="isMinigameOpen = false" class="text-slate-400 hover:text-white p-1.5 hover:bg-slate-800 rounded-lg cursor-pointer">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Select Player State -->
                <div x-show="gameStage === 'select'" class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
                    <div class="text-center space-y-1">
                        <h2 class="text-sm font-extrabold text-[#b26d27] uppercase tracking-wider">Pilih Eksekutor</h2>
                        <p class="text-[11px] text-slate-400">Pilih salah satu pemain bintang Timnas Indonesia!</p>
                    </div>
                    <div class="grid grid-cols-1 gap-3">
                        <template x-for="p in players">
                            <button @click="startGame(p)" class="bg-slate-800 hover:bg-[#b26d27]/20 border border-slate-700 hover:border-[#b26d27] text-left p-3.5 rounded-2xl transition-all cursor-pointer flex gap-3.5 items-start group">
                                <div class="w-10 h-10 rounded-full bg-[#fcf4ec] text-xl flex items-center justify-center shrink-0" x-text="p.flag"></div>
                                <div>
                                    <h3 class="text-xs font-bold text-white group-hover:text-[#b26d27] flex items-center gap-1.5">
                                        <span x-text="p.name"></span>
                                        <span class="text-[9px] bg-[#b26d27]/30 text-amber-200 px-2 py-0.5 rounded-full" x-text="p.specialty"></span>
                                    </h3>
                                    <p class="text-[10px] text-slate-400 mt-1" x-text="p.desc"></p>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Playing State -->
                <div x-show="gameStage === 'playing' || gameStage === 'over'" class="flex flex-col">
                    <div class="bg-slate-950/80 px-4 py-3 flex justify-between items-center border-b border-slate-800/60 font-mono text-center">
                        <div class="flex-1 min-w-0">
                            <span class="text-[9px] text-[#b26d27] font-bold block truncate" x-text="selectedPlayer ? selectedPlayer.name : ''"></span>
                            <span class="text-2xl font-black text-emerald-400" x-text="playerScore"></span>
                        </div>
                        <div class="px-3 py-1 bg-slate-800 rounded-lg text-[9px] font-bold text-slate-300">
                            Tendangan: <span x-text="attempts"></span>/5
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="text-[9px] text-rose-400 font-bold block truncate" x-text="selectedKeeper ? selectedKeeper.name + ' (' + selectedKeeper.flag + ')' : ''"></span>
                            <span class="text-2xl font-black text-rose-400" x-text="keeperScore"></span>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col items-center justify-center min-h-[280px] bg-gradient-to-b from-slate-900 via-emerald-950/20 to-slate-950 relative overflow-hidden">
                        <!-- Goal Post -->
                        <div class="w-full h-36 border-4 border-t-4 border-white/80 rounded-t-lg relative bg-emerald-900/30 flex items-center justify-center shadow-inner mt-6">
                            <!-- Goalkeeper (Simplified) -->
                            <div class="absolute bottom-2 transition-all duration-500"
                                 :style="getKeeperStyle()">
                                <div class="w-12 h-16 bg-emerald-500 rounded-lg flex flex-col items-center justify-center border-2 border-white">
                                    <div class="w-6 h-6 bg-pink-200 rounded-full border border-black -mt-4"></div>
                                    <span class="text-[10px] font-black text-white">GK</span>
                                </div>
                            </div>
                        </div>

                        <!-- Penalty Spot & Ball -->
                        <div class="mt-6 flex flex-col items-center">
                            <div class="w-6 h-6 bg-white rounded-full flex items-center justify-center border-2 border-black animate-bounce cursor-pointer shadow-md"
                                 x-show="!isShooting && outcome === null"
                                 @click="showDirectionSelector = true">
                                ⚽
                            </div>
                        </div>

                        <!-- Direction Selector Overlay -->
                        <div x-show="showDirectionSelector && !isShooting" class="absolute inset-0 bg-black/60 flex items-center justify-center gap-3">
                            <button @click="shoot('left')" class="px-4 py-2 bg-[#b26d27] rounded-xl font-bold hover:bg-[#9b5a1b]">Kiri</button>
                            <button @click="shoot('center')" class="px-4 py-2 bg-[#b26d27] rounded-xl font-bold hover:bg-[#9b5a1b]">Tengah</button>
                            <button @click="shoot('right')" class="px-4 py-2 bg-[#b26d27] rounded-xl font-bold hover:bg-[#9b5a1b]">Kanan</button>
                        </div>

                        <!-- Outcome Message -->
                        <div x-show="outcome !== null" class="mt-4 text-center">
                            <h3 class="text-lg font-black tracking-widest"
                                :class="outcome === 'GOAL' ? 'text-emerald-400' : 'text-rose-500'"
                                x-text="outcome"></h3>
                            <p class="text-xs mt-1 text-slate-300" x-text="gameMessage"></p>
                            <button @click="nextTurn()" class="mt-3 px-4 py-1.5 bg-slate-700 hover:bg-slate-600 rounded-lg text-xs font-bold">
                                Lanjut
                            </button>
                        </div>
                    </div>

                    <!-- Reset button when over -->
                    <div x-show="gameStage === 'over'" class="p-4 border-t border-slate-800 bg-slate-950 text-center">
                        <button @click="resetGame()" class="px-6 py-2 bg-[#b26d27] hover:bg-[#9b5a1b] rounded-xl font-bold text-xs uppercase tracking-wider">
                            Main Lagi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loginPage() {
            return {
                username: '',
                password: '',
                remember: false,
                showPassword: false,
                loading: false,
                error: '',
                isDemoOpen: false,
                demoTab: 'all',
                flowerClicks: 0,
                isMinigameOpen: false,
                isRickrolled: false,
                
                // Demo Users matching the PHP array
                demoUsers: [
                    { name: 'Budi Santoso (Pelapor)', username: 'budi', password: 'budi123', role: 'pengguna' },
                    { name: 'Siti Rahayu (Pelapor)', username: 'siti', password: 'siti123', role: 'pengguna' },
                    { name: 'Ahmad Fauzi (Pelapor)', username: 'ahmad', password: 'ahmad123', role: 'pengguna' },
                    { name: 'Dewi Kusuma (Pelapor)', username: 'dewi', password: 'dewi123', role: 'pengguna' },
                    { name: 'Ir. Hartono, M.T. (Kasubbag)', username: 'kasubbag.infrastruktur', password: 'pass123', role: 'kasubbag' },
                    { name: 'Dra. Wulandari, M.Si. (Kasubbag)', username: 'kasubbag.pelayanan', password: 'pass123', role: 'kasubbag' },
                    { name: 'Supriyadi (Solver)', username: 'solver.infra.1', password: 'solver123', role: 'solver' },
                    { name: 'Operator TI Utama BPK', username: 'admin', password: 'admin123', role: 'operator' }
                ],

                // Minigame Data
                gameStage: 'select',
                selectedPlayer: null,
                selectedKeeper: null,
                playerScore: 0,
                keeperScore: 0,
                attempts: 0,
                isShooting: false,
                showDirectionSelector: false,
                keeperDir: 'center',
                outcome: null,
                gameMessage: '',
                
                players: [
                    { id: 'arhan', name: 'Pratama Arhan', specialty: 'Curve Shot', desc: 'Spesialis pojok kanan. Mengurangi peluang penyelamatan kiper di arah Kanan.', flag: '🇮🇩' },
                    { id: 'marselino', name: 'Marselino Ferdinan', specialty: 'Power Shot', desc: 'Tembakan super keras. Tingkat akurasi dasar yang stabil.', flag: '🇮🇩' },
                    { id: 'ragnar', name: 'Ragnar Oratmangoen', specialty: 'Precision Placement', desc: 'Penempatan bola presisi. Mengurangi peluang penyelamatan kiper.', flag: '🇮🇩' }
                ],

                keepers: [
                    { id: 'martinez', name: 'Emiliano Martínez', team: 'Argentina', flag: '🇦🇷' },
                    { id: 'neuer', name: 'Manuel Neuer', team: 'Jerman', flag: '🇩🇪' }
                ],

                clickFlower() {
                    this.flowerClicks++;
                    if (this.flowerClicks >= 10) {
                        this.isMinigameOpen = true;
                        this.flowerClicks = 0;
                        this.resetGame();
                    }
                },

                autofill(user) {
                    this.username = user.username;
                    this.password = user.password;
                    this.isDemoOpen = false;
                },

                getRoleBadgeClass(role) {
                    if (role === 'pengguna') return 'bg-[#fcf4ec] text-[#b26d27] border-[#f7e3ce]';
                    if (role === 'kasubbag') return 'bg-blue-50 text-blue-700 border-blue-100';
                    if (role === 'solver') return 'bg-purple-50 text-purple-700 border-purple-100';
                    return 'bg-slate-100 text-slate-700 border-slate-200';
                },

                triggerRickroll() {
                    this.isRickrolled = true;
                },

                async submitLogin() {
                    this.loading = true;
                    this.error = '';

                    try {
                        const response = await fetch('{{ route("login.post") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                username: this.username,
                                password: this.password,
                                remember: this.remember
                            })
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            window.location.href = data.redirect;
                        } else {
                            this.error = data.message || 'Login gagal. Periksa kembali kredensial Anda.';
                        }
                    } catch (err) {
                        this.error = 'Koneksi gagal. Silakan coba lagi.';
                    } finally {
                        this.loading = false;
                    }
                },

                // Minigame Functions
                resetGame() {
                    this.gameStage = 'select';
                    this.selectedPlayer = null;
                    this.selectedKeeper = null;
                    this.playerScore = 0;
                    this.keeperScore = 0;
                    this.attempts = 0;
                    this.isShooting = false;
                    this.showDirectionSelector = false;
                    this.keeperDir = 'center';
                    this.outcome = null;
                    this.gameMessage = '';
                },

                startGame(player) {
                    this.selectedPlayer = player;
                    this.selectedKeeper = this.keepers[Math.floor(Math.random() * this.keepers.length)];
                    this.gameStage = 'playing';
                },

                shoot(direction) {
                    this.isShooting = true;
                    this.showDirectionSelector = false;
                    
                    const dirs = ['left', 'center', 'right'];
                    this.keeperDir = dirs[Math.floor(Math.random() * dirs.length)];
                    
                    setTimeout(() => {
                        this.attempts++;
                        if (direction === this.keeperDir) {
                            this.keeperScore++;
                            this.outcome = 'SAVED';
                            this.gameMessage = `Diselamatkan! ${this.selectedKeeper.name} menebak arah dengan tepat.`;
                        } else {
                            this.playerScore++;
                            this.outcome = 'GOAL';
                            this.gameMessage = `Gol! Tembakan ke arah ${direction} bersarang di gawang!`;
                        }
                        this.isShooting = false;
                    }, 800);
                },

                getKeeperStyle() {
                    if (this.keeperDir === 'left') return 'transform: translateX(-70px) rotate(-15deg)';
                    if (this.keeperDir === 'right') return 'transform: translateX(70px) rotate(15deg)';
                    return 'transform: translateX(0px)';
                },

                nextTurn() {
                    this.outcome = null;
                    this.keeperDir = 'center';
                    if (this.attempts >= 5) {
                        this.gameStage = 'over';
                    }
                }
            }
        }
    </script>
</body>
</html>
