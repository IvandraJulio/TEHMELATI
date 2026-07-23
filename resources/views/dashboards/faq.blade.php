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
        transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), 
                    box-shadow 0.45s cubic-bezier(0.16, 1, 0.3, 1), 
                    border-color 0.3s ease, 
                    background-color 0.3s ease;
        will-change: transform, box-shadow;
    }
    .quick-link-card:hover {
        transform: translateY(-6px) scale(1.015) !important;
        border-color: rgba(178, 109, 39, 0.45) !important;
        background-color: #fdf8f3 !important;
        box-shadow: 0 22px 35px -12px rgba(178, 109, 39, 0.16) !important;
    }
    .article-card {
        background-color: transparent !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
        border-bottom: 1px solid rgba(178, 109, 39, 0.15) !important;
        border-radius: 0px !important;
        box-shadow: none !important;
        padding-left: 0.5rem !important;
        padding-right: 0.5rem !important;
        padding-top: 1.125rem !important;
        padding-bottom: 1.125rem !important;
        transition: all 0.2s ease;
    }
    .article-card:last-child {
        border-bottom: none !important;
    }
    .article-card:hover {
        background-color: rgba(255, 255, 255, 0.4) !important;
        border-bottom-color: transparent !important;
        border-radius: 0.75rem !important;
        transform: none !important;
        box-shadow: none !important;
    }
</style>

<div class="faq-container relative min-h-full pb-16 rounded-3xl bg-[#faf6f0] p-6 sm:p-10" x-data="faqPage()">

    <!-- Decorative Background Flower Patterns (Cream Flowers with 50% blur) -->
    <!-- Top-Left Flower -->
    <img src="/bunga-cream.png" alt="Decorative Flower" class="absolute -top-32 left-[10%] w-[420px] opacity-[0.45] blur-[24px] pointer-events-none z-0 select-none">

    <!-- Bottom-Right Flower -->
    <img src="/bunga-cream.png" alt="Decorative Flower" class="absolute -bottom-40 right-[10%] w-[500px] opacity-[0.45] blur-[24px] pointer-events-none z-0 select-none">

    <!-- Middle-Left Flower -->
    <img src="/bunga-cream.png" alt="Decorative Flower" class="absolute top-[30%] -left-44 w-[460px] opacity-[0.45] blur-[24px] pointer-events-none z-0 select-none">

    <!-- Middle-Right Flower -->
    <img src="/bunga-cream.png" alt="Decorative Flower" class="absolute top-[60%] -right-44 w-[460px] opacity-[0.45] blur-[24px] pointer-events-none z-0 select-none">



    <!-- MAIN CONTAINER -->
    <div class="max-w-5xl mx-auto space-y-12 relative z-10">

        <!-- MAIN SEARCH / LIST VIEW -->
        <div x-show="!selectedArticle" x-transition class="space-y-12">

            <!-- HEADER SECTION -->
        <div class="text-center space-y-6 pt-4">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-[#111827] tracking-tight font-display">
                Halo! Melati di sini
            </h1>

            <!-- Search Input Bar -->
            <div class="max-w-lg mx-auto relative" @keydown.window.cmd.k.prevent="openSearch()" @keydown.window.ctrl.k.prevent="openSearch()">
                <div class="relative flex items-center cursor-pointer" @click="openSearch()">
                    <div class="absolute left-4.5 text-slate-400 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <input type="text" 
                           placeholder="Apa yang mau dicari?"
                           :value="searchQuery"
                           readonly
                           class="w-full pl-12 pr-24 py-4 bg-white border border-slate-200/90 rounded-full shadow-sm text-sm text-slate-800 placeholder-slate-400/80 focus:outline-none focus:ring-2 focus:ring-[#b26d27]/20 focus:border-[#b26d27] transition-all cursor-pointer">
                    <div class="absolute right-4.5 flex items-center gap-1.5 pointer-events-none text-slate-400 font-medium">
                        <kbd class="flex items-center justify-center min-w-[28px] h-7 px-1.5 text-[11px] bg-slate-50 border border-slate-200/80 rounded-md font-sans">⌘</kbd>
                        <kbd class="flex items-center justify-center min-w-[28px] h-7 px-1.5 text-[11px] bg-slate-50 border border-slate-200/80 rounded-md font-sans">K</kbd>
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
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group" @click="searchQuery = 'akun'; modalQuery = 'akun';">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Aktivasi Akun Baru
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group" @click="searchQuery = 'password'; modalQuery = 'password';">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Reset Password
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group" @click="searchQuery = 'vpn'; modalQuery = 'vpn';">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Pemasangan VPN BPK
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group" @click="searchQuery = 'mfa'; modalQuery = 'mfa';">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Registrasi Token MFA
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
                    </div>
                </div>
            </div>

            <!-- Row 2: 3 Cards (Centered) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:w-3/4 mx-auto">
                <!-- Card 5 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group" @click="searchQuery = 'ktp'; modalQuery = 'ktp';">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Panduan e-KTP Digital
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 21v-4a4 4 0 0 1 8 0v4"/><circle cx="11" cy="9" r="3"/></svg>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group" @click="searchQuery = 'tte'; modalQuery = 'tte';">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Sertifikat TTE Dinas
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="m9 12 2 2 4-4"/></svg>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="quick-link-card bg-white border border-slate-100 rounded-2xl p-5 shadow-xs flex flex-col justify-between h-28 cursor-pointer group" @click="searchQuery = 'perangkat'; modalQuery = 'perangkat';">
                    <span class="text-[13px] font-bold text-slate-800 group-hover:text-[#b26d27] transition-colors leading-snug">
                        Peminjaman Perangkat
                    </span>
                    <div class="self-end text-[#b26d27]/90 group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="12" x="3" y="4" rx="2" ry="2"/><line x1="2" x2="22" y1="20" y2="20"/><line x1="5" x2="19" y1="16" y2="16"/></svg>
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
                                        <div class="pl-4 border-l border-slate-200 mt-1 space-y-1 text-left">
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
                                        <div class="pl-4 border-l border-slate-200 mt-1 space-y-1 text-left">
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
                                        <div class="pl-4 border-l border-slate-200 mt-1 space-y-1 text-left">
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
                                        <div class="pl-4 border-l border-slate-200 mt-1 space-y-1 text-left">
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
                                        <div class="pl-4 border-l border-slate-200 mt-1 space-y-1 text-left">
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
                                        <div class="pl-4 border-l border-slate-200 mt-1 space-y-1 text-left">
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
                


                <!-- Search Filter Badge Header -->
                <div class="flex items-center gap-2 mb-2 text-xs flex-wrap" x-show="searchQuery" style="display: none;">
                    <span class="text-slate-500 font-semibold">Hasil pencarian untuk:</span>
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#FFF4E5] border border-[#FCDDB5] text-[#b26d27] font-semibold text-[11px] rounded-full shadow-3xs">
                        <span x-text="'&ldquo;' + searchQuery + '&rdquo;'"></span>
                        <span class="text-[10px] font-bold leading-none cursor-pointer" @click="searchQuery = ''; modalQuery = '';">✕</span>
                    </span>
                </div>

                <!-- Articles Stack -->
                <div class="space-y-1">
                    
                    <!-- Article 1 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Bagaimana cara mendaftarkan identitas digital saya?')" @click="selectArticle(1)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Bagaimana cara mendaftarkan identitas digital saya?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 10mo ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 2 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Siapa saja yang berhak menggunakan layanan identitas ini?')" @click="selectArticle(2)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Siapa saja yang berhak menggunakan layanan identitas ini?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 4mo ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 3 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Bagaimana cara memeriksa status pendaftaran akun saya?')" @click="selectArticle(3)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Bagaimana cara memeriksa status pendaftaran akun saya?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 2y ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 4 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Apa yang harus dilakukan jika verifikasi identitas gagal?')" @click="selectArticle(4)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Apa yang harus dilakukan jika verifikasi identitas gagal?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 3mo ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 5 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Cara mengubah data profil dan informasi pribadi')" @click="selectArticle(5)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Cara mengubah data profil dan informasi pribadi
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 1mo ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 6 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Panduan lengkap penggunaan KTP digital')" @click="selectArticle(6)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Panduan lengkap penggunaan KTP digital
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 6mo ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 7 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Cara mendaftarkan perangkat baru ke akun saya')" @click="selectArticle(7)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Cara mendaftarkan perangkat baru ke akun saya
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 2mo ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 8 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Mengapa saya diminta verifikasi ulang setiap login?')" @click="selectArticle(8)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Mengapa saya diminta verifikasi ulang setiap login?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 5mo ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 9 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Cara menghapus perangkat yang tidak dikenal dari akun')" @click="selectArticle(9)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Cara menghapus perangkat yang tidak dikenal dari akun
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 1y ago</span>

                                </div>
                            </div>
                        </div>
                        <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </div>
                    </div>

                    <!-- Article 10 -->
                    <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" x-show="matchesSearch('Apa perbedaan antara passkey dan password biasa?')" @click="selectArticle(10)">
                        <div class="flex items-center min-w-0">
                            <div class="min-w-0">
                                <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug">
                                    Apa perbedaan antara passkey dan password biasa?
                                </h4>
                                <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                    <span>Updated 3mo ago</span>

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

    </div> <!-- Close x-show="!selectedArticle" -->

    <!-- ARTICLE DETAIL VIEW -->
    <div x-show="selectedArticle" x-transition class="max-w-3xl mx-auto py-8 space-y-8 text-left" style="display: none;">
        <!-- Back button -->
        <button @click="selectedArticle = null" class="flex items-center gap-2 text-slate-500 hover:text-[#b26d27] font-semibold text-sm transition-colors cursor-pointer focus:outline-none mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            <span>Kembali</span>
        </button>

        <!-- Category -->
        <div class="inline-flex items-center px-3.5 py-1 bg-[#FFF4E5] border border-[#FCDDB5] text-[#b26d27] font-bold text-[11px] rounded-full shadow-3xs" x-text="selectedArticle?.category">
        </div>

        <!-- Title -->
        <h1 class="text-3xl sm:text-4xl font-extrabold text-[#111827] tracking-tight leading-tight" x-text="selectedArticle?.title">
        </h1>

        <!-- Meta Data (Avatar + Time + Likes) -->
        <div class="flex items-center gap-4 py-2">
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs sm:text-sm text-slate-400 font-semibold">
                <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span x-text="selectedArticle?.updated_at"></span>
                </span>
            </div>
        </div>

        <!-- Divider -->
        <hr class="border-slate-200/80 my-4" />

        <!-- Content Area -->
        <div class="prose max-w-none text-slate-800 text-[14.5px] sm:text-base leading-relaxed font-medium mt-6 space-y-4" x-html="selectedArticle?.content">
        </div>

        <!-- CALLOUT BOX ("Need more help?") -->
        <div class="bg-[#f2e6d6] border border-[#e5d4be] rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mt-12">
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

    <!-- Quick search modal overlay -->
    <div x-show="searchOpen" 
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-start justify-center pt-28 px-4" 
         style="display: none;" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.window.escape="searchOpen = false">
         
        <!-- Backdrop Click to close -->
        <div class="absolute inset-0 bg-transparent" @click="searchOpen = false"></div>
        
        <!-- Modal Card Content -->
        <div class="relative bg-white w-full max-w-xl rounded-3xl shadow-2xl border border-slate-100 overflow-hidden p-6 space-y-6 flex flex-col z-10"
             @click.stop
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
             
            <!-- Modal Header / Search Bar -->
            <form @submit.prevent="runSearch()" class="relative flex items-center bg-white border border-slate-200/90 rounded-2xl p-1 px-1.5 focus-within:ring-2 focus-within:ring-[#b26d27]/20 focus-within:border-[#b26d27] transition-all">
                <div class="pl-3 text-[#b26d27]/80">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <input type="text" 
                       x-model="modalQuery"
                       placeholder="Search a question" 
                       class="flex-1 pl-3 pr-4 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none bg-transparent font-medium"
                       x-ref="modalSearchInput">
                <button type="submit" class="bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-500 font-semibold text-[11px] px-3.5 py-2 rounded-xl flex items-center gap-1.5 transition-colors cursor-pointer">
                    <span>Search</span>
                    <span class="text-[10px] text-slate-400 leading-none">↵</span>
                </button>
            </form>
            
            <!-- Trending Searches -->
            <div class="space-y-3">
                <h5 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Trending searches</h5>
                <div class="flex flex-wrap gap-2">
                    <button type="button" @click="modalQuery = 'lupa password'; runSearch();" class="flex items-center gap-1.5 px-3.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-100 rounded-full text-xs font-semibold text-slate-600 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <span>lupa password</span>
                    </button>
                    <button type="button" @click="modalQuery = 'cara daftar akun'; runSearch();" class="flex items-center gap-1.5 px-3.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-100 rounded-full text-xs font-semibold text-slate-600 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <span>cara daftar akun</span>
                    </button>
                    <button type="button" @click="modalQuery = 'verifikasi identitas'; runSearch();" class="flex items-center gap-1.5 px-3.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-100 rounded-full text-xs font-semibold text-slate-600 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <span>verifikasi identitas</span>
                    </button>
                    <button type="button" @click="modalQuery = 'layanan TTE'; runSearch();" class="flex items-center gap-1.5 px-3.5 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-100 rounded-full text-xs font-semibold text-slate-600 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <span>layanan TTE</span>
                    </button>
                </div>
            </div>
            
            <!-- Popular Questions Asked -->
            <div class="space-y-3">
                <h5 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Popular questions asked</h5>
                <div class="divide-y divide-slate-100">
                    <button type="button" @click="modalQuery = 'Bagaimana cara mereset password akun saya?'; runSearch();" class="w-full text-left py-3 flex items-center gap-3.5 group hover:bg-slate-50/50 rounded-xl px-2 -mx-2 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-[#b26d27] transition-colors shrink-0"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#b26d27] transition-colors leading-relaxed font-sans">Bagaimana cara mereset password akun saya?</span>
                    </button>
                    <button type="button" @click="modalQuery = 'Bagaimana cara mengunduh dan mengatur aplikasi layanan?'; runSearch();" class="w-full text-left py-3 flex items-center gap-3.5 group hover:bg-slate-50/50 rounded-xl px-2 -mx-2 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-[#b26d27] transition-colors shrink-0"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#b26d27] transition-colors leading-relaxed font-sans">Bagaimana cara mengunduh dan mengatur aplikasi layanan?</span>
                    </button>
                    <button type="button" @click="modalQuery = 'Cara mengatur ulang aplikasi di perangkat baru?'; runSearch();" class="w-full text-left py-3 flex items-center gap-3.5 group hover:bg-slate-50/50 rounded-xl px-2 -mx-2 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-[#b26d27] transition-colors shrink-0"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#b26d27] transition-colors leading-relaxed font-sans">Cara mengatur ulang aplikasi di perangkat baru?</span>
                    </button>
                    <button type="button" @click="modalQuery = 'Apa itu layanan MFA dan bagaimana cara menggunakannya?'; runSearch();" class="w-full text-left py-3 flex items-center gap-3.5 group hover:bg-slate-50/50 rounded-xl px-2 -mx-2 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-[#b26d27] transition-colors shrink-0"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                        <span class="text-xs font-semibold text-slate-700 group-hover:text-[#b26d27] transition-colors leading-relaxed font-sans">Apa itu layanan MFA dan bagaimana cara menggunakannya?</span>
                    </button>
                </div>
            </div>
            
        </div>
    </div>

</div>

@push('scripts')
<script>
    function faqPage() {
        return {
            selectedArticle: null,
            selectArticle(id) {
                this.selectedArticle = this.articles.find(a => a.id === id);
            },
            activeTopic: 'identitas', // default open topic
            activeSub: '', // default open sub
            searchOpen: false,
            searchQuery: '',
            modalQuery: '',
            init() {
                const urlParams = new URLSearchParams(window.location.search);
                const topic = urlParams.get('topic');
                const search = urlParams.get('search');
                
                if (topic) {
                    this.activeTopic = topic;
                }
                if (search) {
                    this.searchQuery = search;
                    this.modalQuery = search;
                }
            },
            openSearch() {
                this.searchOpen = true;
                this.$nextTick(() => {
                    this.$refs.modalSearchInput.focus();
                });
            },
            runSearch() {
                this.searchQuery = this.modalQuery;
                this.searchOpen = false;
            },
            matchesSearch(title) {
                if (!this.searchQuery) return true;
                return title.toLowerCase().includes(this.searchQuery.toLowerCase());
            },
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
            },
            articles: [
                {
                    id: 1,
                    title: 'Bagaimana cara mendaftarkan identitas digital saya?',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 10mo ago',
                    likes: '22,224',
                    content: `
                        <p>Untuk mendaftarkan identitas digital Anda pada sistem Melati, ikuti petunjuk berikut:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Persiapan Dokumen:</strong> Pastikan Anda telah memiliki e-KTP dan email resmi BPK RI aktif.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Akses Portal:</strong> Kunjungi halaman registrasi mandiri melalui menu utama.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Verifikasi Wajah:</strong> Lakukan verifikasi e-KTP dan foto wajah secara langsung menggunakan kamera.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Aktivasi:</strong> Klik tautan aktivasi yang dikirimkan ke email Anda untuk menyelesaikan pendaftaran.</span></li>
                        </ul>
                    `
                },
                {
                    id: 2,
                    title: 'Siapa saja yang berhak menggunakan layanan identitas ini?',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 4mo ago',
                    likes: '763',
                    content: `
                        <p>Layanan identitas digital Melati ditujukan khusus untuk kalangan internal BPK RI:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Seluruh Pegawai Negeri Sipil (PNS) di lingkungan BPK RI.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) BPK RI.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Tenaga Kontrak / Solver internal yang terdaftar resmi di Biro TIK.</span></li>
                        </ul>
                    `
                },
                {
                    id: 3,
                    title: 'Bagaimana cara memeriksa status pendaftaran akun saya?',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 2y ago',
                    likes: '457',
                    content: `
                        <p>Untuk mengetahui status pengajuan akun atau pendaftaran layanan Anda:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Silakan masuk ke halaman utama Portal Melati.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Periksa tab <strong>Notifikasi</strong> pada pojok kanan atas untuk melihat update persetujuan admin.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Hubungi operator helpdesk melalui fitur chat jika status tetap menggantung lebih dari 1x24 jam.</span></li>
                        </ul>
                    `
                },
                {
                    id: 4,
                    title: 'Apa yang harus dilakukan jika verifikasi identitas gagal?',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 3mo ago',
                    likes: '1,284',
                    content: `
                        <p>Jika verifikasi identitas Anda gagal, berikut langkah yang perlu dilakukan:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Periksa penyebab kegagalan:</strong></span></li>
                            <li class="flex items-start gap-2.5 pl-6"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Foto dokumen buram atau terpotong</span></li>
                            <li class="flex items-start gap-2.5 pl-6"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Data tidak sesuai dengan dokumen resmi</span></li>
                            <li class="flex items-start gap-2.5 pl-6"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Koneksi internet tidak stabil saat proses verifikasi</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Langkah perbaikan:</strong></span></li>
                            <li class="flex items-start gap-2.5 pl-6"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Ulangi proses verifikasi dengan foto dokumen yang lebih jelas.</span></li>
                            <li class="flex items-start gap-2.5 pl-6"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pastikan pencahayaan cukup saat melakukan verifikasi biometrik.</span></li>
                            <li class="flex items-start gap-2.5 pl-6"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Gunakan koneksi internet yang stabil.</span></li>
                            <li class="flex items-start gap-2.5 pl-6"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Jika masih gagal setelah 3 percobaan, hubungi tim dukungan TI.</span></li>
                        </ul>
                        <p class="mt-4">Anda dapat menghubungi helpdesk melalui email atau datang langsung ke kantor layanan terdekat.</p>
                    `
                },
                {
                    id: 5,
                    title: 'Cara mengubah data profil dan informasi pribadi',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 1mo ago',
                    likes: '589',
                    content: `
                        <p>Untuk mengubah informasi kontak atau profil terdaftar Anda:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Buka menu <strong>Pengaturan Profil</strong> dari ikon avatar Anda di pojok kanan atas.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Ubah nomor telepon atau informasi pelengkap lainnya.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Simpan perubahan dengan memasukkan password atau konfirmasi PIN sekali pakai (OTP).</span></li>
                        </ul>
                    `
                },
                {
                    id: 6,
                    title: 'Panduan lengkap penggunaan KTP digital',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 6mo ago',
                    likes: '3,102',
                    content: `
                        <p>Panduan penggunaan Identitas Kependudukan Digital (IKD/e-KTP) untuk verifikasi akses:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pastikan aplikasi IKD Kemendagri sudah terinstal dan terverifikasi di ponsel Anda.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pilih metode login "IKD / KTP Digital" saat melakukan otentikasi portal BPK RI.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Scan kode QR yang tampil di layar desktop menggunakan pemindai aplikasi IKD Anda.</span></li>
                        </ul>
                    `
                },
                {
                    id: 7,
                    title: 'Cara mendaftarkan perangkat baru ke akun saya',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 2mo ago',
                    likes: '876',
                    content: `
                        <p>Untuk otorisasi perangkat (laptop/handphone) baru untuk bekerja:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Login ke Portal Melati di perangkat baru Anda menggunakan kredensial BPK.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Sistem akan mengirimkan permintaan konfirmasi ke perangkat utama yang telah terdaftar.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Setujui permintaan masuk di perangkat utama untuk mengotorisasi perangkat baru tersebut.</span></li>
                        </ul>
                    `
                },
                {
                    id: 8,
                    title: 'Mengapa saya diminta verifikasi ulang setiap login?',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 5mo ago',
                    likes: '2,341',
                    content: `
                        <p>MFA (Multi-Factor Authentication) diwajibkan demi menjaga keamanan data pemeriksaan penting:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Kebijakan keamanan TI BPK RI mewajibkan otentikasi ganda untuk mencegah kebocoran password.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Jika Anda menggunakan browser privat atau menghapus cookies, sistem akan mendeteksi sebagai login baru.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Anda dapat mencentang "Ingat perangkat ini selama 30 hari" untuk mengurangi frekuensi verifikasi.</span></li>
                        </ul>
                    `
                },
                {
                    id: 9,
                    title: 'Cara menghapus perangkat yang tidak dikenal dari akun',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 1y ago',
                    likes: '198',
                    content: `
                        <p>Jika Anda melihat perangkat yang tidak Anda kenali terhubung ke akun Anda:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Segera buka menu <strong>Keamanan Akun > Manajemen Perangkat</strong>.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Klik ikon tempat sampah atau tombol "Logout/Hapus" di sebelah nama perangkat asing tersebut.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Lakukan perubahan password akun Anda secepatnya untuk keamanan ekstra.</span></li>
                        </ul>
                    `
                },
                {
                    id: 10,
                    title: 'Apa perbedaan antara passkey dan password biasa?',
                    category: 'Layanan Identitas',
                    updated_at: 'Diperbarui 3mo ago',
                    likes: '4,510',
                    content: `
                        <p>Perbedaan keamanan antara metode passkey dan password tradisional:</p>
                        <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Password:</strong> String teks yang rentan ditebak, dicuri via phishing, atau dibobol saat server bocor.</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Passkey:</strong> Kunci kriptografi unik yang terikat pada perangkat fisik Anda (biometrik sidik jari/wajah).</span></li>
                            <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Passkey jauh lebih aman karena tidak bisa dicuri dengan phishing biasa dan tidak memerlukan hafalan password.</span></li>
                        </ul>
                    `
                }
            ]
        }
    }
</script>
@endpush
@endsection
