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

                <!-- LEFT COLUMN: NESTED COLLAPSIBLE TOPICS -->
                <div class="lg:col-span-4 bg-white border border-slate-200/85 rounded-3xl p-5 shadow-xs space-y-4">
                    <div class="flex items-center justify-between px-1">
                        <h3 class="text-[17px] font-extrabold text-slate-900">
                            Topics
                        </h3>
                        <button @click="clearFilters()" 
                                x-show="activeTopic || selectedSubcategory || searchQuery" 
                                class="text-xs text-[#b26d27] hover:underline font-bold transition-all focus:outline-none">
                            Reset Filter
                        </button>
                    </div>

                    <div class="space-y-2">
                        
                        <!-- 1. Layanan Identitas (2 Levels - Sub-Layanan flat list) -->
                        <div>
                            <button @click="toggleTopic('identitas')" 
                                    class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold"
                                    :class="isOpenTopic('identitas') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
                                <span>Layanan Identitas</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="transition-transform" :class="isOpenTopic('identitas') ? 'rotate-180 text-[#a75d1b]' : 'text-slate-400'"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            
                            <div x-show="isOpenTopic('identitas')" x-collapse>
                                <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                    <button @click="selectSubcategory('Layanan Akun', 'identitas')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Layanan Akun' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Layanan Akun</button>
                                    <button @click="selectSubcategory('Layanan TTE (Tanda Tangan Elektronik)', 'identitas')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Layanan TTE (Tanda Tangan Elektronik)' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Layanan TTE (Tanda Tangan Elektronik)</button>
                                    <button @click="selectSubcategory('Layanan Segel Elektronik', 'identitas')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Layanan Segel Elektronik' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Layanan Segel Elektronik</button>
                                    <button @click="selectSubcategory('Layanan Email', 'identitas')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Layanan Email' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Layanan Email</button>
                                    <button @click="selectSubcategory('Layanan MFA (Multi-Factor Authentication)', 'identitas')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Layanan MFA (Multi-Factor Authentication)' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Layanan MFA (Multi-Factor Authentication)</button>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Layanan Data (3 Levels - Sub-Layanan is collapsible) -->
                        <div>
                            <button @click="toggleTopic('data')" 
                                    class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold"
                                    :class="isOpenTopic('data') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
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
                                                <button @click="selectSubcategory('Perencanaan Data', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Perencanaan Data' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Perencanaan Data</button>
                                                <button @click="selectSubcategory('Pengumpulan Data', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pengumpulan Data' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengumpulan Data</button>
                                                <button @click="selectSubcategory('Pengolahan Data', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pengolahan Data' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengolahan Data</button>
                                                <button @click="selectSubcategory('Penyimpanan Data', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Penyimpanan Data' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penyimpanan Data</button>
                                                <button @click="selectSubcategory('Penyebarluasan Data', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Penyebarluasan Data' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penyebarluasan Data</button>
                                                <button @click="selectSubcategory('Analisis Data', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Analisis Data' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Analisis Data</button>
                                                <button @click="selectSubcategory('Pengamanan Data', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pengamanan Data' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengamanan Data</button>
                                                <button @click="selectSubcategory('Pemusnahan Data', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pemusnahan Data' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pemusnahan Data</button>
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
                                                <button @click="selectSubcategory('BIDICS Dashboard', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'BIDICS Dashboard' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">BIDICS Dashboard</button>
                                                <button @click="selectSubcategory('BIDICS-SSA', 'data')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'BIDICS-SSA' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">BIDICS-SSA</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Layanan Aplikasi (2 Levels - Sub-Layanan flat list) -->
                        <div>
                            <button @click="toggleTopic('aplikasi')" 
                                    class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold"
                                    :class="isOpenTopic('aplikasi') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
                                <span>Layanan Aplikasi</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('aplikasi') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            
                            <div x-show="isOpenTopic('aplikasi')" x-collapse>
                                <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                    <button @click="selectSubcategory('Pengembangan Aplikasi', 'aplikasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Pengembangan Aplikasi' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengembangan Aplikasi</button>
                                    <button @click="selectSubcategory('Aplikasi Pemeriksaan', 'aplikasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Aplikasi Pemeriksaan' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Aplikasi Pemeriksaan</button>
                                    <button @click="selectSubcategory('Aplikasi Kelembagaan', 'aplikasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Aplikasi Kelembagaan' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Aplikasi Kelembagaan</button>
                                    <button @click="selectSubcategory('Aplikasi Pendukung', 'aplikasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Aplikasi Pendukung' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Aplikasi Pendukung</button>
                                    <button @click="selectSubcategory('Aplikasi Kolaborasi', 'aplikasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Aplikasi Kolaborasi' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Aplikasi Kolaborasi</button>
                                    <button @click="selectSubcategory('Layanan Survei', 'aplikasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Layanan Survei' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Layanan Survei</button>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Layanan Teknologi (3 Levels - Sub-Layanan is collapsible) -->
                        <div>
                            <button @click="toggleTopic('teknologi')" 
                                    class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold"
                                    :class="isOpenTopic('teknologi') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
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
                                                <button @click="selectSubcategory('Pembuatan LAN', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pembuatan LAN' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pembuatan LAN</button>
                                                <button @click="selectSubcategory('Pengaturan Konfigurasi LAN', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pengaturan Konfigurasi LAN' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengaturan Konfigurasi LAN</button>
                                                <button @click="selectSubcategory('Penonaktifan LAN', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Penonaktifan LAN' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penonaktifan LAN</button>
                                                <button @click="selectSubcategory('Penyediaan Kabel LAN', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Penyediaan Kabel LAN' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penyediaan Kabel LAN</button>
                                                <button @click="selectSubcategory('Pemasangan Wi-Fi', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pemasangan Wi-Fi' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pemasangan Wi-Fi</button>
                                                <button @click="selectSubcategory('Pengaturan Konfigurasi Wi-Fi', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pengaturan Konfigurasi Wi-Fi' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengaturan Konfigurasi Wi-Fi</button>
                                                <button @click="selectSubcategory('Penonaktifan Wi-Fi', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Penonaktifan Wi-Fi' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penonaktifan Wi-Fi</button>
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
                                                <button @click="selectSubcategory('Pemasangan Internet', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pemasangan Internet' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pemasangan Internet</button>
                                                <button @click="selectSubcategory('Pengaturan Konfigurasi Internet', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pengaturan Konfigurasi Internet' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengaturan Konfigurasi Internet</button>
                                                <button @click="selectSubcategory('Penonaktifan Internet', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Penonaktifan Internet' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penonaktifan Internet</button>
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
                                                <button @click="selectSubcategory('Pemasangan VPN', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pemasangan VPN' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pemasangan VPN</button>
                                                <button @click="selectSubcategory('Pengaturan Konfigurasi VPN', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pengaturan Konfigurasi VPN' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengaturan Konfigurasi VPN</button>
                                                <button @click="selectSubcategory('Penonaktifan VPN', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Penonaktifan VPN' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penonaktifan VPN</button>
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
                                                <button @click="selectSubcategory('Pendaftaran Hosting Subdomain', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pendaftaran Hosting Subdomain' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pendaftaran Hosting Subdomain</button>
                                                <button @click="selectSubcategory('Pengaturan Konfigurasi Hosting', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Pengaturan Konfigurasi Hosting' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pengaturan Konfigurasi Hosting</button>
                                                <button @click="selectSubcategory('Penonaktifan Hosting', 'teknologi')" class="w-full text-left py-1.5 px-2 text-[12.5px] font-medium rounded transition-all" :class="selectedSubcategory === 'Penonaktifan Hosting' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-3' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penonaktifan Hosting</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Layanan Perangkat (2 Levels - Sub-Layanan flat list) -->
                        <div>
                            <button @click="toggleTopic('perangkat')" 
                                    class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold"
                                    :class="isOpenTopic('perangkat') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
                                <span>Layanan Perangkat</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('perangkat') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            
                            <div x-show="isOpenTopic('perangkat')" x-collapse>
                                <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                    <button @click="selectSubcategory('Standarisasi Perangkat Komputer', 'perangkat')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Standarisasi Perangkat Komputer' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Standarisasi Perangkat Komputer</button>
                                    <button @click="selectSubcategory('Pemeliharaan Perangkat', 'perangkat')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Pemeliharaan Perangkat' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pemeliharaan Perangkat</button>
                                    <button @click="selectSubcategory('Peminjaman Perangkat', 'perangkat')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Peminjaman Perangkat' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Peminjaman Perangkat</button>
                                    <button @click="selectSubcategory('Penyediaan Barang Persediaan', 'perangkat')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Penyediaan Barang Persediaan' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Penyediaan Barang Persediaan</button>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Layanan Dukungan TI (2 Levels - Sub-Layanan flat list) -->
                        <div>
                            <button @click="toggleTopic('dukungan')" 
                                    class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold"
                                    :class="isOpenTopic('dukungan') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
                                <span>Layanan Dukungan TI</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('dukungan') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            
                            <div x-show="isOpenTopic('dukungan')" x-collapse>
                                <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                    <button @click="selectSubcategory('Pendampingan Personel TI', 'dukungan')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Pendampingan Personel TI' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Pendampingan Personel TI</button>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Layanan Informasi (2 Levels - Sub-Layanan flat list) -->
                        <div>
                            <button @click="toggleTopic('informasi')" 
                                    class="w-full flex items-center justify-between py-3.5 px-4 rounded-xl text-[13.5px] transition-all text-left outline-none font-semibold"
                                    :class="isOpenTopic('informasi') ? 'bg-[#fdf3e7] text-[#a75d1b] border border-black font-bold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900'">
                                <span>Layanan Informasi</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 transition-transform" :class="isOpenTopic('informasi') ? 'rotate-180 text-[#a75d1b]' : ''"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            
                            <div x-show="isOpenTopic('informasi')" x-collapse>
                                <div class="pl-5 border-l border-slate-200 mt-2.5 pb-2 space-y-2 text-left">
                                    <button @click="selectSubcategory('Knowledge Base Produk TI', 'informasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Knowledge Base Produk TI' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Knowledge Base Produk TI</button>
                                    <button @click="selectSubcategory('Informasi Produk TI', 'informasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Informasi Produk TI' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Informasi Produk TI</button>
                                    <button @click="selectSubcategory('Tugas dan Fungsi Biro TI', 'informasi')" class="w-full text-left py-2 px-3 text-[13px] font-medium rounded-lg leading-relaxed transition-all duration-200" :class="selectedSubcategory === 'Tugas dan Fungsi Biro TI' ? 'bg-[#fdf3e7] text-[#a75d1b] font-bold border-l-2 border-[#b26d27] pl-4' : 'text-slate-500 hover:text-slate-950 hover:bg-slate-50/70'">Tugas dan Fungsi Biro TI</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT COLUMN: ARTICLES LIST -->
                <div class="lg:col-span-8 space-y-4">

                    <!-- Active Filter Badge Header -->
                    <div class="flex items-center gap-2 mb-2 text-xs flex-wrap" x-show="activeTopic || selectedSubcategory || searchQuery" style="display: none;">
                        <span class="text-slate-500 font-semibold">Filter aktif:</span>
                        
                        <!-- Category Badge -->
                        <template x-if="activeTopic">
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#FFF4E5] border border-[#FCDDB5] text-[#b26d27] font-semibold text-[11px] rounded-full shadow-3xs">
                                <span x-text="topicMapping[activeTopic]"></span>
                                <span class="text-[10px] font-bold leading-none cursor-pointer" @click="activeTopic = ''; selectedSubcategory = '';">✕</span>
                            </span>
                        </template>

                        <!-- Subcategory Badge -->
                        <template x-if="selectedSubcategory">
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-[#f5fbf7] border border-[#d1f2dd] text-emerald-700 font-semibold text-[11px] rounded-full shadow-3xs">
                                <span x-text="selectedSubcategory"></span>
                                <span class="text-[10px] font-bold leading-none cursor-pointer" @click="selectedSubcategory = ''">✕</span>
                            </span>
                        </template>

                        <!-- Search Query Badge -->
                        <template x-if="searchQuery">
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-slate-100 border border-slate-200 text-slate-700 font-semibold text-[11px] rounded-full shadow-3xs">
                                <span x-text="'Pencarian: &ldquo;' + searchQuery + '&rdquo;'"></span>
                                <span class="text-[10px] font-bold leading-none cursor-pointer" @click="searchQuery = ''; modalQuery = '';">✕</span>
                            </span>
                        </template>
                    </div>

                    <!-- Articles Stack -->
                    <div class="space-y-1">
                        
                        <!-- Dynamic Articles rendering -->
                        <template x-for="article in filteredArticles" :key="article.id">
                            <div class="article-card bg-white border border-slate-100 rounded-2xl p-4.5 flex items-center justify-between gap-4 cursor-pointer group shadow-3xs" 
                                 @click="selectArticle(article.id)">
                                <div class="flex items-center min-w-0">
                                    <div class="min-w-0">
                                        <h4 class="text-[13px] sm:text-sm font-bold text-slate-900 group-hover:text-[#b26d27] transition-colors leading-snug" 
                                            x-text="article.title">
                                        </h4>
                                        <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 font-medium">
                                            <span x-text="article.updated_at"></span>
                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-500 rounded-md text-[10px]" x-text="article.category"></span>
                                            <template x-if="article.subcategory">
                                                <span class="px-2 py-0.5 bg-orange-50 text-[#b26d27] rounded-md text-[10px]" x-text="article.subcategory"></span>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-slate-300 group-hover:text-[#b26d27] group-hover:translate-x-0.5 transition-all shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                </div>
                            </div>
                        </template>

                        <!-- Empty State -->
                        <div x-show="filteredArticles.length === 0" class="text-center py-16 bg-white rounded-3xl border border-slate-100 p-6 space-y-3">
                            <div class="w-12 h-12 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center mx-auto shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            </div>
                            <h4 class="text-sm font-bold text-slate-800">Artikel tidak ditemukan</h4>
                            <p class="text-xs text-slate-500 max-w-xs mx-auto">Coba cari dengan kata kunci lain atau reset filter untuk menampilkan semua artikel.</p>
                            <button @click="clearFilters()" class="px-4 py-2 bg-[#b26d27] hover:bg-[#9b5a1b] text-white text-xs font-bold rounded-xl transition-all shadow-xs cursor-pointer inline-block mt-2">
                                Reset Semua Filter
                            </button>
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
            <div class="flex items-center gap-2">
                <div class="inline-flex items-center px-3.5 py-1 bg-[#FFF4E5] border border-[#FCDDB5] text-[#b26d27] font-bold text-[11px] rounded-full shadow-3xs" x-text="selectedArticle?.category">
                </div>
                <template x-if="selectedArticle?.subcategory">
                    <div class="inline-flex items-center px-3.5 py-1 bg-[#f5fbf7] border border-[#d1f2dd] text-emerald-700 font-bold text-[11px] rounded-full shadow-3xs" x-text="selectedArticle?.subcategory">
                    </div>
                </template>
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
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
                        <span x-text="selectedArticle?.likes + ' likes'"></span>
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
            selectedSubcategory: '', // selected sub-category filter
            searchOpen: false,
            searchQuery: '',
            modalQuery: '',
            topicMapping: {
                'identitas': 'Layanan Identitas',
                'data': 'Layanan Data',
                'aplikasi': 'Layanan Aplikasi',
                'teknologi': 'Layanan Teknologi',
                'perangkat': 'Layanan Perangkat',
                'dukungan': 'Layanan Dukungan TI',
                'informasi': 'Layanan Informasi'
            },
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
            toggleTopic(id) {
                if (this.isOpenTopic(id)) {
                    this.activeTopic = '';
                    this.selectedSubcategory = '';
                } else {
                    this.activeTopic = id;
                    this.activeSub = ''; // Reset active sub so the new category starts fresh
                    this.selectedSubcategory = '';
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
            selectSubcategory(subName, parentTopicId) {
                this.selectedSubcategory = subName;
                if (parentTopicId) {
                    this.activeTopic = parentTopicId;
                }
            },
            clearFilters() {
                this.activeTopic = '';
                this.activeSub = '';
                this.selectedSubcategory = '';
                this.searchQuery = '';
                this.modalQuery = '';
            },
            get filteredArticles() {
                let query = this.searchQuery.trim().toLowerCase();
                let topicCategory = this.topicMapping[this.activeTopic] || '';
                
                return this.articles.filter(article => {
                    // Match Category (if active)
                    if (topicCategory && article.category !== topicCategory) {
                        return false;
                    }
                    // Match Subcategory (if active)
                    if (this.selectedSubcategory && article.subcategory !== this.selectedSubcategory) {
                        return false;
                    }
                    // Match Search Query (if present)
                    if (query) {
                        const matchTitle = article.title.toLowerCase().includes(query);
                        const matchContent = article.content.toLowerCase().includes(query);
                        const matchCat = article.category.toLowerCase().includes(query);
                        const matchSub = article.subcategory ? article.subcategory.toLowerCase().includes(query) : false;
                        if (!matchTitle && !matchContent && !matchCat && !matchSub) {
                            return false;
                        }
                    }
                    return true;
                });
            },
            articles: @json($articles)
        }
    }
</script>
@endpush
@endsection
