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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .font-mono {
            font-family: 'Poppins', sans-serif;
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
                    <img src="/logo-melati.png" alt="Logo Melati" class="w-8 h-8 object-contain" />
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
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#b26d27] transition-colors cursor-pointer flex items-center justify-center"
                                    aria-label="Toggle password visibility"
                                >
                                    <!-- Eye Icon (when password is hidden) -->
                                    <template x-if="!showPassword">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5 transition-all"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </template>
                                    <!-- Eye-Off Icon (when password is visible) -->
                                    <template x-if="showPassword">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5 transition-all"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                    </template>
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
            <div class="text-center text-[10px] text-gray-400 font-mono tracking-widest mt-8 select-none">
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
            
            <!-- Centered Wrapper for Jasmine Flowers -->
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
                <div class="relative w-[800px] h-full">
                    <!-- Jasmine Left Group -->
                    <div class="absolute" style="width: 800px; height: 1000px; bottom: -10px; left: -136px; transform: rotate(-12deg); transform-origin: bottom center;">
                        <!-- tangkai-melati Left -->
                        <div class="absolute z-10" style="width: 80px; height: 600px; bottom: 0; left: calc(50% - 48px); transform-origin: bottom center; transform: rotate(5deg);">
                            <img src="/tangkai-melati.png" alt="" class="w-full h-full object-fill" />
                        </div>
                        <!-- bunga-melati Left -->
                        <div class="absolute z-20 w-full h-full" style="top: 0; left: 0; filter: drop-shadow(6px 10px 28px rgba(0,0,0,0.14));">
                            <img src="/bunga-melati.png" alt="Bunga Melati Kiri" class="w-full h-full object-contain" />
                        </div>
                    </div>

                    <!-- Jasmine Right Group -->
                    <div class="absolute" style="width: 800px; height: 1000px; bottom: -10px; left: 0px; transform: rotate(10deg); transform-origin: bottom center;">
                        <!-- tangkai-melati Right -->
                        <div class="absolute z-10" style="width: 72px; height: 580px; bottom: 0; left: calc(50% + 60px); transform-origin: bottom center; transform: rotate(-5deg);">
                            <img src="/tangkai-melati.png" alt="" class="w-full h-full object-fill" />
                        </div>
                        <!-- bunga-melati Right -->
                        <div class="absolute z-30 w-full h-full" style="top: 40px; right: 0; filter: drop-shadow(6px 10px 24px rgba(0,0,0,0.12));">
                            <img src="/bunga-melati.png" alt="Bunga Melati Kanan" class="w-full h-full object-contain" />
                        </div>
                    </div>
                </div>
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

        <!-- RICKROLL MODAL REMOVED -->

        <!-- MINIGAME MODAL REMOVED -->
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



                async submitLogin() {
                    if (!this.username.trim() && !this.password.trim()) {
                        this.error = 'Email dan password harus diisi.';
                        return;
                    }
                    if (!this.username.trim()) {
                        this.error = 'Email harus diisi.';
                        return;
                    }
                    if (!this.password.trim()) {
                        this.error = 'Password harus diisi.';
                        return;
                    }

                    this.loading = true;
                    this.error = '';

                    try {
                        const response = await fetch('{{ route("login.post") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
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


            }
        }
    </script>
</body>
</html>
