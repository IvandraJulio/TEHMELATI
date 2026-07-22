@extends('layouts.app')

@section('title', 'FAQ - Portal Layanan TI BPK')

@section('content')
<!-- Google Fonts & Custom CSS for premium typography and aesthetics -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .faq-container {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .quick-link-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .quick-link-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px -10px rgba(178, 109, 39, 0.12);
    }
    .article-card {
        transition: all 0.25s ease;
    }
    .article-card:hover {
        border-color: rgba(178, 109, 39, 0.3);
        transform: translateY(-1px);
        box-shadow: 0 8px 16px -6px rgba(0, 0, 0, 0.04);
    }
</style>

<div class="faq-container relative min-h-full pb-16 overflow-hidden rounded-3xl bg-[#faf6f0] p-6 sm:p-10" x-data="faqPage()">

    <!-- Decorative Background Glows (1:1 with reference design) -->
    <!-- Top Center Soft Radial Light Glow -->
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[900px] h-[450px] bg-gradient-to-b from-[#f7e3ce]/50 via-[#faf6f0]/40 to-transparent rounded-full blur-[110px] -z-10 pointer-events-none"></div>

    <!-- Bottom Left Large Organic Star/Flower Soft Warm Glow -->
    <div class="absolute -bottom-36 -left-36 w-[650px] h-[650px] bg-[#f5dfc8]/60 rounded-full blur-[100px] -z-10 pointer-events-none"></div>

    <!-- Right Side Warm Glow -->
    <div class="absolute top-1/3 -right-28 w-[600px] h-[600px] bg-[#f7e6d7]/40 rounded-full blur-[110px] -z-10 pointer-events-none"></div>

    <!-- MAIN CONTAINER -->
    <div class="max-w-5xl mx-auto space-y-12 relative z-10">

        <!-- HEADER SECTION -->
        <div class="text-center space-y-6 pt-4">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#111827] tracking-tight font-display">
                Halo! Melati di sini
            </h1>

            <!-- Search Input Bar -->
            <div class="max-w-lg mx-auto relative">
                <div class="relative flex items-center">
                    <div class="absolute left-4.5 text-slate-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <input type="text" 
                           placeholder="Apa yang mau dicari?"
                           class="w-full pl-12 pr-16 py-4 bg-white border border-slate-200/90 rounded-2xl shadow-sm text-sm text-slate-800 placeholder-slate-400/80 focus:outline-none focus:ring-2 focus:ring-[#b26d27]/20 focus:border-[#b26d27] transition-all">
                    <div class="absolute right-4 flex items-center gap-0.5 pointer-events-none text-[11px] font-semibold text-slate-400 border border-slate-200/80 bg-slate-50/80 px-2 py-0.5 rounded-lg shadow-3xs">
                        <span>⌘</span>
                        <span>K</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- QUICK LINKS SECTION -->
        <div class="space-y-4">
            <h2 class="text-[13px] font-bold text-slate-500 tracking-wider uppercase">
                Quick links
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <!-- Card 1 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Set up Singpass app
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Create passkey
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Reset password
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/></svg>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Register an account
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    </div>
                </div>
            </div>

            <!-- Row 2: 3 Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-4xl">
                <!-- Card 5 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Update mobile number
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Update address
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Suspend account
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.343 3.051A6 6 0 0 1 18 8v4l2 2v1H4v-1l2-2V8a6 6 0 0 1 4.343-5.949"/><path d="M9 17a3 3 0 0 0 6 0"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- DIVIDER LINE -->
        <hr class="border-slate-200/80 my-8" />

        <!-- MAIN LAYOUT: TOPICS & ARTICLES -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT COLUMN: NESTED COLLAPSIBLE TOPICS (1:1 with reference design, accordion behavior) -->
            <div class="lg:col-span-4 bg-white border border-slate-200/85 rounded-3xl p-5 shadow-xs space-y-4">
                <h3 class="text-[17px] font-extrabold text-slate-900 px-1">
                    Topics
                </h3>

                <div class="space-y-2">
                    
                    <!-- 1. Layanan Identitas (2 Levels - Sub-Layanan flat list) -->
                    <div>
                        <button @click="toggleTopic('identitas')" 
                                class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none"
                                :class="isOpenTopic('identitas') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-semibold'">
                            <span>Layanan Identitas</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="transition-transform" :class="isOpenTopic('identitas') ? 'rotate-180 text-[#a75d1b]' : 'text-slate-400'"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        
                        <div x-show="isOpenTopic('identitas')" x-collapse>
                            <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Layanan Akun</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Layanan TTE (Tanda Tangan Elektronik)</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Layanan Segel Elektronik</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Layanan Email</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Layanan MFA (Multi-Factor Authentication)</button>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Layanan Data (3 Levels - Sub-Layanan is collapsible) -->
                    <div>
                        <button @click="toggleTopic('data')" 
                                class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900"
                                :class="isOpenTopic('data') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : ''">
                            <span>Layanan Data</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('data') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        
                        <div x-show="isOpenTopic('data')" x-collapse>
                            <div class="pl-4 border-l border-slate-200 mt-2.5 pb-2 space-y-2.5">
                                <!-- Level 2: Pengelolaan Data (Collapsible) -->
                                <div>
                                    <button @click="toggleSub('data-pengelolaan')" 
                                            class="w-full flex items-center justify-between py-2 px-3 text-[11px] font-extrabold text-[#b26d27] uppercase tracking-wider hover:bg-slate-50/70 rounded-lg text-left outline-none">
                                        <span>Pengelolaan Data</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenSub('data-pengelolaan') ? 'rotate-180 text-[#b26d27]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    <div x-show="isOpenSub('data-pengelolaan')" x-collapse>
                                        <div class="pl-4 mt-1 space-y-1 text-left">
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Perencanaan Data</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pengumpulan Data</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pengolahan Data</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Penyimpanan Data</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Penyebarluasan Data</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Analisis Data</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pengamanan Data</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pemusnahan Data</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Level 2: Sistem Layanan Data (Collapsible) -->
                                <div>
                                    <button @click="toggleSub('data-sistem')" 
                                            class="w-full flex items-center justify-between py-2 px-3 text-[11px] font-extrabold text-[#b26d27] uppercase tracking-wider hover:bg-slate-50/70 rounded-lg text-left outline-none">
                                        <span>Sistem Layanan Data</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenSub('data-sistem') ? 'rotate-180 text-[#b26d27]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    <div x-show="isOpenSub('data-sistem')" x-collapse>
                                        <div class="pl-4 mt-1 space-y-1 text-left">
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">BIDICS Dashboard</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">BIDICS-SSA</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Layanan Aplikasi (2 Levels - Sub-Layanan flat list) -->
                    <div>
                        <button @click="toggleTopic('aplikasi')" 
                                class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900"
                                :class="isOpenTopic('aplikasi') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : ''">
                            <span>Layanan Aplikasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('aplikasi') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        
                        <div x-show="isOpenTopic('aplikasi')" x-collapse>
                            <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Pengembangan Aplikasi</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Aplikasi Pemeriksaan</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Aplikasi Kelembagaan</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Aplikasi Pendukung</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Aplikasi Kolaborasi</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Layanan Survei</button>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Layanan Teknologi (3 Levels - Sub-Layanan is collapsible) -->
                    <div>
                        <button @click="toggleTopic('teknologi')" 
                                class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900"
                                :class="isOpenTopic('teknologi') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : ''">
                            <span>Layanan Teknologi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('teknologi') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        
                        <div x-show="isOpenTopic('teknologi')" x-collapse>
                            <div class="pl-4 border-l border-slate-200 mt-2.5 pb-2 space-y-2.5">
                                <!-- Layanan Intranet -->
                                <div>
                                    <button @click="toggleSub('teknologi-intranet')" 
                                            class="w-full flex items-center justify-between py-2 px-3 text-[11px] font-extrabold text-[#b26d27] uppercase tracking-wider hover:bg-slate-50/70 rounded-lg text-left outline-none">
                                        <span>Layanan Intranet</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenSub('teknologi-intranet') ? 'rotate-180 text-[#b26d27]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    <div x-show="isOpenSub('teknologi-intranet')" x-collapse>
                                        <div class="pl-4 mt-1 space-y-1 text-left">
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pembuatan LAN</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pengaturan Konfigurasi LAN</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Penonaktifan LAN</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Penyediaan Kabel LAN</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pemasangan Wi-Fi</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pengaturan Konfigurasi Wi-Fi</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Penonaktifan Wi-Fi</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Layanan Internet -->
                                <div>
                                    <button @click="toggleSub('teknologi-internet')" 
                                            class="w-full flex items-center justify-between py-2 px-3 text-[11px] font-extrabold text-[#b26d27] uppercase tracking-wider hover:bg-slate-50/70 rounded-lg text-left outline-none">
                                        <span>Layanan Internet</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenSub('teknologi-internet') ? 'rotate-180 text-[#b26d27]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    <div x-show="isOpenSub('teknologi-internet')" x-collapse>
                                        <div class="pl-4 mt-1 space-y-1 text-left">
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pemasangan Internet</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pengaturan Konfigurasi Internet</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Penonaktifan Internet</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Layanan VPN -->
                                <div>
                                    <button @click="toggleSub('teknologi-vpn')" 
                                            class="w-full flex items-center justify-between py-2 px-3 text-[11px] font-extrabold text-[#b26d27] uppercase tracking-wider hover:bg-slate-50/70 rounded-lg text-left outline-none">
                                        <span>Layanan VPN</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenSub('teknologi-vpn') ? 'rotate-180 text-[#b26d27]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    <div x-show="isOpenSub('teknologi-vpn')" x-collapse>
                                        <div class="pl-4 mt-1 space-y-1 text-left">
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pemasangan VPN</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pengaturan Konfigurasi VPN</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Penonaktifan VPN</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Layanan Hosting -->
                                <div>
                                    <button @click="toggleSub('teknologi-hosting')" 
                                            class="w-full flex items-center justify-between py-2 px-3 text-[11px] font-extrabold text-[#b26d27] uppercase tracking-wider hover:bg-slate-50/70 rounded-lg text-left outline-none">
                                        <span>Layanan Hosting</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenSub('teknologi-hosting') ? 'rotate-180 text-[#b26d27]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    <div x-show="isOpenSub('teknologi-hosting')" x-collapse>
                                        <div class="pl-4 mt-1 space-y-1 text-left">
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pendaftaran Hosting Subdomain</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Pengaturan Konfigurasi Hosting</button>
                                            <button class="w-full text-left py-1 text-[12.5px] font-medium text-slate-500 hover:text-slate-950 leading-relaxed">Penonaktifan Hosting</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Layanan Perangkat (2 Levels - Sub-Layanan flat list) -->
                    <div>
                        <button @click="toggleTopic('perangkat')" 
                                class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900"
                                :class="isOpenTopic('perangkat') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : ''">
                            <span>Layanan Perangkat</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('perangkat') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        
                        <div x-show="isOpenTopic('perangkat')" x-collapse>
                            <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Standarisasi Perangkat Komputer</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Pemeliharaan Perangkat</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Peminjaman Perangkat</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Penyediaan Barang Persediaan</button>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Layanan Dukungan TI (2 Levels - Sub-Layanan flat list) -->
                    <div>
                        <button @click="toggleTopic('dukungan')" 
                                class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900"
                                :class="isOpenTopic('dukungan') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : ''">
                            <span>Layanan Dukungan TI</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('dukungan') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        
                        <div x-show="isOpenTopic('dukungan')" x-collapse>
                            <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Pendampingan Personel TI</button>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Layanan Informasi (2 Levels - Sub-Layanan flat list) -->
                    <div>
                        <button @click="toggleTopic('informasi')" 
                                class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900"
                                :class="isOpenTopic('informasi') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : ''">
                            <span>Layanan Informasi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('informasi') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                        </button>
                        
                        <div x-show="isOpenTopic('informasi')" x-collapse>
                            <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Knowledge Base Produk TI</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Informasi Produk TI</button>
                                <button class="w-full text-left py-2 px-3 text-[13px] font-medium text-slate-500 hover:text-slate-950 rounded-lg hover:bg-slate-50/70 leading-relaxed">Tugas dan Fungsi Biro TI</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN: ARTICLES LIST -->
            <div class="lg:col-span-8 space-y-4">
                
                <!-- Filter Badge Header -->
                <div class="flex items-center gap-2 mb-2 text-xs flex-wrap">
                    <span class="text-slate-500 font-semibold">10 articles in</span>
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#FFF4E5] border border-[#FCDDB5] text-[#b26d27] font-semibold text-[11px] rounded-full shadow-3xs">
                        <span>Account Activation / Registering for Singpass</span>
                        <span class="text-[10px] font-bold leading-none cursor-pointer">✕</span>
                    </span>
                </div>

                <!-- Articles Stack -->
                <div class="space-y-3">
                    
                    <!-- Article 1 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#0e9488] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#ffffff"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#ffffff"/>
                                    <path d="M8 15C8.5 17 15.5 17 16 15" stroke="#ffffff" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Bagaimana cara mendaftarkan identitas digital saya?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 10mo ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>22,224</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 2 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#1e4a58] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#ffffff"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#ffffff"/>
                                    <path d="M9 15.5C10 16 14 16 15 15.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Siapa saja yang berhak menggunakan layanan identitas ini?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 4mo ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>763</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 3 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#e2f3e8] border border-[#c1e2cd] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#1e5235"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#1e5235"/>
                                    <path d="M10 15H14" stroke="#1e5235" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Bagaimana cara memeriksa status pendaftaran akun saya?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 2y ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>457</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 4 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#1f2d3a] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#ffffff"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#ffffff"/>
                                    <path d="M9 15.5C10.5 14.5 13.5 14.5 15 15.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Apa yang harus dilakukan jika verifikasi identitas gagal?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 3mo ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>1,284</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 5 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#1b4e5a] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#ffffff"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#ffffff"/>
                                    <path d="M9 15C10 16.5 14 16.5 15 15" stroke="#ffffff" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Cara mengubah data profil dan informasi pribadi
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 1mo ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>588</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 6 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#0d9488] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#ffffff"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#ffffff"/>
                                    <path d="M8 15.5C9 17 15 17 16 15.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Panduan lengkap penggunaan KTP digital
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 6mo ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>3,102</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 7 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#e5f5e0] border border-[#c2e5b7] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#2b5f25"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#2b5f25"/>
                                    <path d="M9 15C10 16 14 16 15 15" stroke="#2b5f25" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Cara mendaftarkan perangkat baru ke akun saya
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 2mo ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>876</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 8 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#1d4ed8] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#ffffff"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#ffffff"/>
                                    <path d="M8 15C9 17 15 17 16 15" stroke="#ffffff" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Mengapa saya diminta verifikasi ulang setiap login?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 5mo ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>2,341</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 9 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#f97316] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#ffffff"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#ffffff"/>
                                    <path d="M9 15.5C10.5 16.5 13.5 16.5 15 15.5" stroke="#ffffff" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Cara menghapus perangkat yang tidak dikenal dari akun
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 1y ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>198</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 10 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs">
                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-11 h-11 rounded-full shrink-0 flex items-center justify-center bg-[#dcfce7] border border-[#bbf7d0] transition-transform group-hover:scale-105">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="opacity-95">
                                    <circle cx="8" cy="10" r="1.5" fill="#14532d"/>
                                    <circle cx="16" cy="10" r="1.5" fill="#14532d"/>
                                    <path d="M10 15.5H14" stroke="#14532d" stroke-width="2" stroke-linecap="round" fill="none"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Apa perbedaan antara passkey dan password biasa?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 3mo ago</span>
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>
                                        <span>4,510</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                </div>

                <!-- CALLOUT BOX ("Need more help?") -->
                <div class="bg-[#f2e6d6] border border-[#e5d4be] rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mt-6">
                    <div>
                        <h4 class="text-[15px] font-bold text-slate-900">Need more help?</h4>
                        <p class="text-xs sm:text-sm text-slate-600 font-medium mt-0.5">Describe your issues to us.</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-white hover:bg-slate-50 text-slate-800 text-xs sm:text-sm font-bold rounded-xl shadow-xs transition-all border border-slate-200/80 cursor-pointer shrink-0">
                        Contact us
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>

@push('scripts')
<script>
    function faqPage() {
        return {
            activeTopic: 'identitas', // default open topic
            activeSub: '', // default open sub
            toggleTopic(id) {
                if (this.isOpenTopic(id)) {
                    this.activeTopic = '';
                } else {
                    this.activeTopic = id;
                    this.activeSub = ''; // Reset active sub so the new category starts fresh
                }
            },
            isOpenTopic(id) {
                return this.activeTopic === id;
            },
            toggleSub(id) {
                if (this.isOpenSub(id)) {
                    this.activeSub = '';
                } else {
                    this.activeSub = id;
                }
            },
            isOpenSub(id) {
                return this.activeSub === id;
            }
        }
    }
</script>
@endpush
@endsection
