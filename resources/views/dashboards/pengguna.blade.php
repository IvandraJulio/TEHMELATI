@extends('layouts.app')

@section('title', 'Beranda - Portal Layanan TI BPK')

@section('content')
<div class="h-[calc(100vh-8.5rem)] flex flex-col justify-between" x-data="berandaPage()">
    <!-- Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 h-full items-stretch">
        
        <!-- LEFT COLUMN: Chatbot (virtual assistant) -->
        <div :class="showForm ? 'lg:col-span-8' : 'lg:col-span-12 max-w-4xl mx-auto w-full'" 
             class="bg-white border border-[#e2e6ea] rounded-2xl shadow-sm flex flex-col h-full overflow-hidden transition-all duration-300">
             
             <!-- Chat Header -->
             <div class="bg-[#F0DCC0] text-[#78430e] px-5 py-4 flex items-center gap-3 shrink-0 border-b border-orange-100">
                 <div class="w-9 h-9 rounded-xl bg-[#b26d27] flex items-center justify-center text-white shadow-xs">
                     <i data-lucide="bot" class="w-5.5 h-5.5"></i>
                 </div>
                 <div>
                     <h3 class="text-sm font-bold font-display leading-tight flex items-center gap-1.5 text-gray-800">
                         <span>Asisten Virtual Layanan TI</span>
                         <span class="text-[9px] px-1.5 py-0.5 rounded-full font-mono font-bold text-white bg-emerald-600">
                             GEMINI AI
                         </span>
                     </h3>
                     <p class="text-[10px] text-gray-500 font-medium">Bantu isi form otomatis dengan deskripsi masalah Anda</p>
                 </div>
             </div>

             <!-- Chat Messages -->
             <div class="flex-1 overflow-y-auto p-5 space-y-4 bg-[#fcfbfa]" id="chat-box">
                 <template x-for="msg in chatMessages" :key="msg.id">
                     <div class="flex gap-3 max-w-[85%]" :class="msg.sender === 'user' ? 'ml-auto flex-row-reverse' : 'mr-auto'">
                         <!-- Avatar -->
                         <div class="w-8 h-8 rounded-full shrink-0 flex items-center justify-center font-bold text-xs"
                              :class="msg.sender === 'bot' ? 'bg-[#fcf4ec] text-[#b26d27] border border-[#f7e3ce]' : 'bg-[#F0DCC0] text-[#78430e]'">
                             <template x-if="msg.sender === 'bot'">
                                 <i data-lucide="bot" class="w-4 h-4"></i>
                             </template>
                             <template x-if="msg.sender === 'user'">
                                 <i data-lucide="user" class="w-4 h-4"></i>
                             </template>
                         </div>

                         <!-- Bubble -->
                         <div class="space-y-2">
                             <div class="p-3.5 rounded-2xl text-xs leading-relaxed shadow-xs border"
                                  :class="msg.sender === 'bot' ? 'bg-[#F3EDE2] text-gray-700 rounded-tl-none border-gray-200/60' : 'bg-[#F0DCC0] text-gray-800 border-orange-200/50 rounded-tr-none'"
                                  x-html="formatMarkdown(msg.text)"></div>

                             <!-- Recommendation Card -->
                             <template x-if="msg.sender === 'bot' && msg.recommendation">
                                 <div class="bg-white border border-[#f7e3ce] rounded-xl p-3.5 shadow-sm space-y-3 max-w-full">
                                     <div class="flex items-center justify-between gap-2 border-b border-gray-100 pb-2">
                                         <span class="text-[10px] font-bold text-[#b26d27] uppercase tracking-wider flex items-center gap-1">
                                             <i data-lucide="sparkles" class="w-3.5 h-3.5"></i> Rekomendasi Layanan
                                         </span>
                                         <span class="text-[9px] font-bold px-1.5 py-0.5 rounded"
                                               :class="msg.recommendation.confidence === 'Tinggi' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100'"
                                               x-text="msg.recommendation.confidence"></span>
                                     </div>
                                     <div class="text-[11px] space-y-1 text-gray-700 font-medium leading-relaxed">
                                         <div>Kategori: <strong x-text="msg.recommendation.category"></strong></div>
                                         <div>Sub-Layanan: <strong x-text="msg.recommendation.sub"></strong></div>
                                         <div>Layanan: <strong x-text="msg.recommendation.service"></strong></div>
                                     </div>
                                     <button @click="applyRecommendation(msg.recommendation)" class="w-full bg-[#b26d27] hover:bg-[#9b5a1b] text-white py-1.5 px-3 rounded-lg text-[10px] font-bold transition-all flex items-center justify-center gap-1 cursor-pointer">
                                         <span>Gunakan Rekomendasi & Buka Form</span>
                                         <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                     </button>
                                 </div>
                             </template>
                         </div>
                     </div>
                 </template>
                 
                 <!-- Typing Indicator -->
                 <div x-show="chatLoading" class="flex gap-3 max-w-[85%] mr-auto" style="display: none;">
                     <div class="w-8 h-8 rounded-full bg-[#fcf4ec] text-[#b26d27] flex items-center justify-center border border-[#f7e3ce]">
                         <i data-lucide="bot" class="w-4 h-4"></i>
                     </div>
                     <div class="bg-white text-gray-500 rounded-2xl rounded-tl-none border border-gray-100 p-3 text-xs flex items-center gap-1 shadow-xs">
                         <span class="animate-bounce">●</span>
                         <span class="animate-bounce" style="animation-delay: 0.2s">●</span>
                         <span class="animate-bounce" style="animation-delay: 0.4s">●</span>
                     </div>
                 </div>
             </div>

             <!-- Chat Input Form -->
             <form @submit.prevent="sendChatMessage()" class="p-3.5 bg-white border-t border-[#e2e6ea] flex gap-2 shrink-0">
                 <input type="text" x-model="chatInput" placeholder="Tulis kendala Anda (contoh: wifi lemot total)..." class="flex-1 bg-[#f5f6f8] border border-slate-100 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-full px-5 py-3 text-xs outline-none transition-all placeholder:text-gray-400 font-semibold">
                 <button type="submit" class="bg-[#b26d27] hover:bg-[#9b5a1b] text-white w-10 h-10 rounded-full flex items-center justify-center shrink-0 cursor-pointer shadow-sm hover:shadow-md transition-all">
                     <i data-lucide="send" class="w-4 h-4"></i>
                 </button>
             </form>
        </div>

        <!-- RIGHT COLUMN: Form Permintaan Layanan -->
        <div x-show="showForm" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-8"
             class="lg:col-span-4 bg-white p-5 md:p-6 rounded-2xl border border-[#e2e6ea] shadow-xs flex flex-col justify-between h-full overflow-hidden"
             style="display: none;">
             
             <div class="flex flex-col h-full justify-between">
                 <div class="space-y-4">
                     <div class="flex justify-between items-start">
                         <div>
                             <h2 class="text-sm font-bold text-gray-800 font-display">Form Permintaan Layanan</h2>
                             <p class="text-[10px] text-gray-400 mt-1">Lorem ipsum dolor sit amet</p>
                         </div>
                         <button @click="showForm = false" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg">
                             <i data-lucide="x" class="w-4 h-4"></i>
                         </button>
                     </div>

                     <div x-show="successMessage" class="p-3 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold flex items-center gap-3">
                         <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
                         <div>
                             <p class="font-bold">Laporan Terkirim!</p>
                             <p class="text-[10px] text-emerald-700 mt-0.5" x-text="'Tiket ' + successMessage + ' berhasil dibuat.'"></p>
                             <a :href="'/dashboard/detail?id=' + successMessage" class="text-[#b26d27] hover:underline font-bold mt-1 inline-block">Lihat Detail Tiket →</a>
                         </div>
                     </div>

                     <form @submit.prevent="submitForm()" class="space-y-3.5">
                          <!-- Kategori Select -->
                          <div class="relative" x-data="{ open: false }" @click.away="open = false">
                              <label class="block text-[10px] font-bold text-gray-800 mb-1">Kategori (level 1)</label>
                              <button type="button" @click="open = !open" 
                                      class="w-full flex items-center justify-between bg-[#EFE9DF] border-2 border-[#3D3025] text-[#5A4535] rounded-xl px-4 py-2.5 text-xs font-bold transition-all outline-none">
                                  <span x-text="kategori ? formatDisplay(kategori) : '-Pilih Kategori-'"></span>
                                  <i data-lucide="chevron-down" class="w-4 h-4 text-[#8C7662] transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                              </button>
                              <div x-show="open" 
                                   x-transition:enter="transition ease-out duration-100"
                                   x-transition:enter-start="opacity-0 scale-95"
                                   x-transition:enter-end="opacity-100 scale-100"
                                   x-transition:leave="transition ease-in duration-75"
                                   x-transition:leave-start="opacity-100 scale-100"
                                   x-transition:leave-end="opacity-0 scale-95"
                                   class="absolute z-50 left-0 right-0 mt-1 bg-[#EFE9DF] border-2 border-[#3D3025] rounded-xl shadow-lg overflow-hidden flex flex-col"
                                   style="display: none;">
                                   <template x-for="cat in catalog">
                                       <button type="button" 
                                               @click="kategori = cat.category; onCategoryChange(); open = false;"
                                               class="w-full text-left px-4 py-2.5 text-xs text-[#785E4E] hover:bg-[#E6DDD0] font-semibold transition-colors cursor-pointer"
                                               x-text="formatDisplay(cat.category)">
                                       </button>
                                   </template>
                              </div>
                          </div>

                          <!-- Sub-Layanan Select -->
                          <div class="relative" x-data="{ open: false }" @click.away="open = false">
                              <label class="block text-[10px] font-bold text-gray-800 mb-1">Sub-Layanan (level 2)</label>
                              <button type="button" @click="if (kategori) open = !open" :disabled="!kategori"
                                      class="w-full flex items-center justify-between bg-[#EFE9DF] border-2 border-[#3D3025] text-[#5A4535] rounded-xl px-4 py-2.5 text-xs font-bold transition-all outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                                  <span x-text="subLayanan ? formatDisplay(subLayanan) : '-Pilih Sub-Layanan-'"></span>
                                  <i data-lucide="chevron-down" class="w-4 h-4 text-[#8C7662] transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                              </button>
                              <div x-show="open" 
                                   x-transition:enter="transition ease-out duration-100"
                                   x-transition:enter-start="opacity-0 scale-95"
                                   x-transition:enter-end="opacity-100 scale-100"
                                   x-transition:leave="transition ease-in duration-75"
                                   x-transition:leave-start="opacity-100 scale-100"
                                   x-transition:leave-end="opacity-0 scale-95"
                                   class="absolute z-50 left-0 right-0 mt-1 bg-[#EFE9DF] border-2 border-[#3D3025] rounded-xl shadow-lg overflow-hidden flex flex-col"
                                   style="display: none;">
                                   <template x-for="sub in getSubLayananList()">
                                       <button type="button" 
                                               @click="subLayanan = sub.name; onSubChange(); open = false;"
                                               class="w-full text-left px-4 py-2.5 text-xs text-[#785E4E] hover:bg-[#E6DDD0] font-semibold transition-colors cursor-pointer"
                                               x-text="formatDisplay(sub.name)">
                                       </button>
                                   </template>
                              </div>
                          </div>

                          <!-- Detail Layanan Select (Level 3) -->
                          <div class="relative" x-show="getDetailLayananList().length > 0" x-data="{ open: false }" @click.away="open = false" style="display: none;">
                              <label class="block text-[10px] font-bold text-gray-800 mb-1">Detail Layanan (level 3)</label>
                              <button type="button" @click="if (subLayanan) open = !open" :disabled="!subLayanan"
                                      class="w-full flex items-center justify-between bg-[#EFE9DF] border-2 border-[#3D3025] text-[#5A4535] rounded-xl px-4 py-2.5 text-xs font-bold transition-all outline-none disabled:opacity-50 disabled:cursor-not-allowed">
                                  <span x-text="detailLayanan ? formatDisplay(detailLayanan) : '-Pilih Detail-'"></span>
                                  <i data-lucide="chevron-down" class="w-4 h-4 text-[#8C7662] transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                              </button>
                              <div x-show="open" 
                                   x-transition:enter="transition ease-out duration-100"
                                   x-transition:enter-start="opacity-0 scale-95"
                                   x-transition:enter-end="opacity-100 scale-100"
                                   x-transition:leave="transition ease-in duration-75"
                                   x-transition:leave-start="opacity-100 scale-100"
                                   x-transition:leave-end="opacity-0 scale-95"
                                   class="absolute z-50 left-0 right-0 mt-1 bg-[#EFE9DF] border-2 border-[#3D3025] rounded-xl shadow-lg overflow-hidden flex flex-col"
                                   style="display: none;">
                                   <template x-for="item in getDetailLayananList()">
                                       <button type="button" 
                                               @click="detailLayanan = item; open = false;"
                                               class="w-full text-left px-4 py-2.5 text-xs text-[#785E4E] hover:bg-[#E6DDD0] font-semibold transition-colors cursor-pointer"
                                               x-text="formatDisplay(item)">
                                       </button>
                                   </template>
                              </div>
                          </div>

                         <!-- Detail Masalah -->
                         <div>
                             <label class="block text-[10px] font-bold text-gray-800 mb-1">Deskripsi permintaan layanan</label>
                             <textarea x-model="detailMasalah" rows="5" placeholder="Tulis deskripsi kendala/permintaan..." class="w-full bg-white border border-slate-200 focus:border-[#b26d27] text-gray-800 rounded-xl px-3.5 py-2.5 text-xs outline-none transition-all font-semibold placeholder:text-gray-300"></textarea>
                         </div>

                         <!-- Submit Button -->
                         <button type="submit" :disabled="loadingSubmit" class="w-full bg-[#E7BE8D] hover:bg-[#d9ab75] text-white font-bold text-xs py-3 rounded-xl transition-all shadow-xs flex items-center justify-center gap-1.5 cursor-pointer disabled:opacity-50">
                             <i data-lucide="send" class="w-4 h-4"></i>
                             <span x-text="loadingSubmit ? 'Mengirim...' : 'Kirim permintaan layanan'"></span>
                         </button>
                     </form>
                 </div>
             </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function berandaPage() {
        return {
            kategori: '',
            subLayanan: '',
            detailLayanan: '',
            detailMasalah: '',
            loadingSubmit: false,
            successMessage: '',
            showForm: false,
            
            // Chatbot State
            chatInput: '',
            chatLoading: false,
            chatMessages: [
                {
                    id: 'welcome',
                    sender: 'bot',
                    text: 'Halo! Saya adalah Asisten Virtual Layanan TI BPK berbasis Google Gemini AI. Deskripsikan kendala atau permintaan layanan Anda dalam bahasa sehari-hari (contoh: "kabel LAN saya rusak" atau "lupa password email dinas"), dan saya akan merekomendasikan kategori layanan yang tepat secara cerdas.'
                }
            ],
            timerExpired: false,
            firstUserMessageTime: null,
            remainingSeconds: 300,
            timerInterval: null,

            catalog: [
                {
                    category: "Layanan Identitas",
                    subs: [
                        { name: "Layanan Akun", items: [] },
                        { name: "Layanan TTE", items: [] },
                        { name: "Layanan Segel Elektronik", items: [] },
                        { name: "Layanan Email", items: [] },
                        { name: "Layanan MFA", items: [] }
                    ]
                },
                {
                    category: "Layanan Data",
                    subs: [
                        { name: "Pengelolaan Data", items: ["Perencanaan Data", "Pengumpulan Data", "Pengolahan Data", "Penyimpanan Data", "Penyebarluasan Data", "Analisis Data", "Pengamanan Data", "Pemusnahan Data"] },
                        { name: "Layanan Sistem Layanan Data", items: ["BIDICS Dashboard", "BIDICS-SSA"] }
                    ]
                },
                {
                    category: "Layanan Aplikasi",
                    subs: [
                        { name: "Pengembangan Aplikasi", items: [] },
                        { name: "Aplikasi Pemeriksaan", items: [] },
                        { name: "Aplikasi Kelembagaan", items: [] },
                        { name: "Aplikasi Pendukung", items: [] },
                        { name: "Aplikasi Kolaborasi", items: [] },
                        { name: "Layanan Survei", items: [] }
                    ]
                },
                {
                    category: "Layanan Teknologi",
                    subs: [
                        { name: "Layanan Intranet", items: ["Pembuatan Local Area Network (LAN)", "Pengaturan konfigurasi LAN", "Penonaktifan LAN", "Penyediaan kabel LAN", "Pemasangan perangkat Wireless Fidelity (Wifi)", "Pengaturan konfigurasi Wifi", "Penonaktifan Wifi"] },
                        { name: "Layanan Internet", items: ["Pemasangan perangkat koneksi internet", "Pengaturan konfigurasi perangkat koneksi internet", "Penonaktifan perangkat koneksi internet"] },
                        { name: "Layanan Virtual Private Network", items: ["Pemasangan VPN", "Pengaturan konfigurasi VPN", "Penonaktifan VPN"] },
                        { name: "Layanan Hosting", items: ["Pendaftaran hosting subdomain", "Pengaturan konfigurasi hosting subdomain", "Penonaktifan hosting subdomain"] }
                    ]
                },
                {
                    category: "Layanan Perangkat",
                    subs: [
                        { name: "Standarisasi Perangkat Komputer", items: [] },
                        { name: "Pemeliharaan Perangkat", items: [] },
                        { name: "Peminjaman Perangkat", items: [] },
                        { name: "Penyediaan Barang Persediaan", items: [] }
                    ]
                },
                {
                    category: "Layanan Dukungan TI Untuk Kegiatan Khusus",
                    subs: [
                        { name: "Pendampingan Personel TI", items: [] }
                    ]
                },
                {
                    category: "Layanan Informasi",
                    subs: [
                        { name: "Knowledge Base Produk TI", items: [] },
                        { name: "Informasi Produk TI", items: [] },
                        { name: "Tugas dan Fungsi Biro TI", items: [] }
                    ]
                }
            ],

            subbagRouting: {
                'Layanan Identitas': 'Subbagian Pelayanan TIK',
                'Layanan Data': 'Subbagian Tata Kelola Data',
                'Layanan Aplikasi': 'Subbagian Pengembangan Sistem Informasi Pemeriksaan',
                'Layanan Teknologi': 'Subbagian Pengelolaan Infrastruktur dan Jaringan',
                'Layanan Perangkat': 'Subbagian Pelayanan TIK',
                'Layanan Dukungan TI Untuk Kegiatan Khusus': 'Subbagian Pelayanan TIK',
                'Layanan Informasi': 'Subbagian MIOT',
                'Layanan TTE': 'Subbagian Keamanan Informasi',
                'Layanan Segel Elektronik': 'Subbagian Keamanan Informasi',
                'Layanan MFA': 'Subbagian Keamanan Informasi',
                'Layanan Sistem Layanan Data': 'Subbagian Sains Data',
                'Aplikasi Kelembagaan': 'Subbagian Pengembangan Sistem Informasi Kelembagaan',
                'Aplikasi Pendukung': 'Subbagian Pengembangan Sistem Informasi Kelembagaan',
                'Aplikasi Kolaborasi': 'Subbagian Pelayanan TIK',
                'Layanan Survei': 'Subbagian Pelayanan TIK',
            },

            formatDisplay(text) {
                if (!text) return '';
                if (text === 'Layanan Dukungan TI Untuk Kegiatan Khusus') {
                    return 'Layanan dukungan TI';
                }
                let parts = text.split(' ');
                if (parts.length > 1) {
                    return parts[0] + ' ' + parts.slice(1).join(' ').toLowerCase();
                }
                return text;
            },

            getBotResponseCount() {
                return this.chatMessages.filter(m => m.sender === 'bot' && m.id !== 'welcome').length;
            },

            formatTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;
                return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
            },

            init() {
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('showForm') === 'true') {
                    this.showForm = true;
                }
                this.$nextTick(() => {
                    this.scrollChat();
                    lucide.createIcons();
                });
            },

            onCategoryChange() {
                this.subLayanan = '';
                this.detailLayanan = '';
            },

            onSubChange() {
                this.detailLayanan = '';
            },

            getSubLayananList() {
                const node = this.catalog.find(c => c.category === this.kategori);
                return node ? node.subs : [];
            },

            getDetailLayananList() {
                const subs = this.getSubLayananList();
                const subNode = subs.find(s => s.name === this.subLayanan);
                return subNode ? subNode.items : [];
            },

            applyRecommendation(rec) {
                this.kategori = rec.category;
                this.showForm = true;
                this.$nextTick(() => {
                    this.subLayanan = rec.sub;
                    this.$nextTick(() => {
                        this.detailLayanan = rec.service;
                    });
                });
            },

            async submitForm() {
                if (!this.kategori || !this.subLayanan || !this.detailMasalah.trim()) {
                    alert('Harap isi semua kolom form yang diperlukan.');
                    return;
                }

                this.loadingSubmit = true;
                this.successMessage = '';

                try {
                    const response = await fetch('/api/tickets', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            layananKategori: this.kategori,
                            layananSub: this.subLayanan,
                            layanan: this.detailLayanan || this.subLayanan,
                            detail: this.detailMasalah
                        })
                    });

                    const data = await response.json();
                    if (response.ok && data.success) {
                        this.successMessage = data.id;
                        this.kategori = '';
                        this.subLayanan = '';
                        this.detailLayanan = '';
                        this.detailMasalah = '';
                    } else {
                        alert(data.error || 'Gagal mengirim tiket.');
                    }
                } catch (err) {
                    alert('Terjadi kesalahan jaringan.');
                } finally {
                    this.loadingSubmit = false;
                }
            },

            async sendChatMessage() {
                if (!this.chatInput.trim()) return;

                const userText = this.chatInput.trim();
                const newUserMsg = {
                    id: 'usr-' + Date.now(),
                    sender: 'user',
                    text: userText
                };

                this.chatMessages.push(newUserMsg);
                this.chatInput = '';
                this.chatLoading = true;

                // Start 5-minute timer on first user message
                if (!this.firstUserMessageTime) {
                    this.firstUserMessageTime = Date.now();
                    this.remainingSeconds = 300;
                    this.timerInterval = setInterval(() => {
                        const elapsed = Math.floor((Date.now() - this.firstUserMessageTime) / 1000);
                        this.remainingSeconds = Math.max(0, 300 - elapsed);
                        if (this.remainingSeconds <= 0) {
                            this.timerExpired = true;
                            clearInterval(this.timerInterval);
                        }
                    }, 1000);
                }

                this.scrollChat();

                try {
                    const updatedMessages = this.chatMessages.map(m => ({
                        sender: m.sender,
                        text: m.text
                    }));

                    const response = await fetch('/api/chat-recommend', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ messages: updatedMessages })
                    });

                    const data = await response.json();
                    this.chatLoading = false;

                    if (response.ok && data.reply) {
                        this.chatMessages.push({
                            id: 'bot-' + Date.now(),
                            sender: 'bot',
                            text: data.reply,
                            recommendation: data.recommendation
                        });
                    } else {
                        throw new Error("Backend error or rate limit");
                    }
                } catch (err) {
                    console.warn("AI Chatbot failed, using local keyword matching fallback:", err);
                    this.localFallback(userText);
                } finally {
                    this.$nextTick(() => {
                        this.scrollChat();
                        lucide.createIcons();
                    });
                }
            },

            localFallback(userText) {
                this.chatLoading = false;
                const cleanedInput = userText.toLowerCase();

                const rules = [
                    { keywords: ["lan", "kabel lan", "kabel", "colokan lan", "port lan"], category: "Layanan Teknologi", sub: "Layanan Intranet", service: "Penyediaan kabel LAN ruang kerja", hint: "Cobalah untuk menggunakan kabel LAN cadangan atau periksa koneksi colokan port LAN pada komputer/dinding." },
                    { keywords: ["wifi", "wi-fi", "wireless", "internet kantor", "sinyal wifi"], category: "Layanan Teknologi", sub: "Layanan Intranet", service: "Pengaturan konfigurasi Wifi Biro", hint: "Pastikan Wifi laptop Anda dalam keadaan ON, disconnect dan hubungkan kembali, atau periksa sinyal hotspot Anda." },
                    { keywords: ["mfa", "multi factor", "google authenticator", "otp", "token mfa"], category: "Layanan Identitas", sub: "Layanan MFA", service: "Registrasi Multi-Factor Authentication Baru", hint: "Buka aplikasi Google Authenticator di handphone Anda, pastikan sinkronisasi waktu sudah tepat." },
                    { keywords: ["mfa reset", "reset mfa", "authenticator", "otp salah"], category: "Layanan Identitas", sub: "Layanan MFA", service: "Reset Token MFA / Google Authenticator", hint: "Jika OTP tidak sinkron, silakan atur sinkronisasi waktu (Time Sync) pada aplikasi Google Authenticator Anda." },
                    { keywords: ["vpn", "vpn bpk", "akses intranet", "vpn error", "connect vpn"], category: "Layanan Teknologi", sub: "Layanan Virtual Private Network", service: "Pemasangan VPN BPK di Laptop", hint: "Pastikan koneksi internet Anda stabil sebelum mengaktifkan VPN BPK. Coba sambungkan ulang client VPN Anda." },
                    { keywords: ["buat akun", "akun baru", "daftar portal", "user baru"], category: "Layanan Identitas", sub: "Layanan Akun", service: "Pembuatan Akun Baru Portal BPK", hint: "Silakan akses halaman registrasi di portal utama untuk membuat akun baru BPK." },
                    { keywords: ["lupa password", "reset password", "password locked", "ganti sandi"], category: "Layanan Identitas", sub: "Layanan Akun", service: "Reset Password / Masalah Login", hint: "Cobalah reset password menggunakan fitur lupa password di portal, pastikan Caps Lock tidak aktif." },
                    { keywords: ["tte", "tanda tangan", "tanda tangan elektronik", "sertifikat tte"], category: "Layanan Identitas", sub: "Layanan TTE", service: "Registrasi Sertifikat TTE Baru", hint: "Pastikan token USB TTE terpasang dan jalankan aplikasi support e-Signer BPK dengan benar." },
                    { keywords: ["email", "email dinas", "email bpk", "buat email"], category: "Layanan Identitas", sub: "Layanan Email", service: "Pembuatan Email Baru @bpk.go.id", hint: "Silakan hubungi Administrator untuk pembuatan email baru BPK." },
                    { keywords: ["email penuh", "kuota email", "storage email"], category: "Layanan Identitas", sub: "Layanan Email", service: "Masalah Kuota Email Penuh", hint: "Silakan buka webmail BPK, pastikan folder kiriman/sampah dibersihkan untuk melegakan kapasitas kotak masuk." },
                    { keywords: ["laptop lambat", "laptop lemot", "upgrade ram", "perbaikan"], category: "Layanan Perangkat", sub: "Pemeliharaan Perangkat", service: "Perbaikan Kerusakan Fisik Laptop Dinas", hint: "Untuk laptop lemot, coba matikan aplikasi latar belakang yang berat, atau lakukan restart laptop terlebih dahulu." },
                    { keywords: ["cairan", "air", "ketumpahan", "basah"], category: "Layanan Perangkat", sub: "Pemeliharaan Perangkat", service: "Perbaikan Kerusakan Fisik Laptop Dinas", hint: "Segera matikan daya perangkat apabila laptop terkena cairan (tumpahan air) dan cabut baterai/charger. Jangan dinyalakan sampai benar-benar kering." },
                    { keywords: ["virus", "antivirus", "malware", "scan laptop"], category: "Layanan Perangkat", sub: "Pemeliharaan Perangkat", service: "Instalasi Antivirus / Scan Malware Perangkat", hint: "Gunakan antivirus ter-update dan lakukan pemindaian penuh (Full Scan) pada direktori sistem Anda." },
                    { keywords: ["siap", "siap-bpk", "audit siap", "unggah kkp"], category: "Layanan Aplikasi", sub: "Aplikasi Pemeriksaan", service: "SiAP-BPK (Sistem Informasi Pemeriksaan)", hint: "Pastikan status internet aktif untuk menyinkronkan KKP offline ke sistem SiAP BPK." },
                    { keywords: ["sisdm", "kepegawaian", "absen sisdm", "cuti sisdm"], category: "Layanan Aplikasi", sub: "Aplikasi Kelembagaan", service: "Aplikasi Kepegawaian (SISDM BPK)", hint: "Untuk SISDM, pastikan jaringan intranet terhubung atau gunakan VPN BPK jika di luar kantor." },
                    { keywords: ["e-office", "eoffice", "persuratan", "naskah dinas"], category: "Layanan Aplikasi", sub: "Aplikasi Kelembagaan", service: "Aplikasi Persuratan Dinas (E-Office)", hint: "Periksa daftar surat masuk/keluar di E-Office, lakukan reload halaman jika respon lambat." }
                ];

                let bestRule = null;
                let maxScore = 0;

                for (const rule of rules) {
                    let score = 0;
                    for (const kw of rule.keywords) {
                        if (cleanedInput.includes(kw)) {
                            score += kw.split(" ").length;
                        }
                    }
                    if (score > maxScore) {
                        maxScore = score;
                        bestRule = rule;
                    }
                }

                if (maxScore > 0 && bestRule) {
                    const confidence = maxScore >= 2 ? "Tinggi" : "Sedang";

                    if (this.getBotResponseCount() < 4) {
                        // Under 5th bot bubble: Only give troubleshooting tips/solving help
                        this.chatMessages.push({
                            id: 'bot-' + Date.now(),
                            sender: 'bot',
                            text: `[Offline Fallback] Masalah Anda terdeteksi berkaitan dengan ${bestRule.service}. Tips Solusi: ${bestRule.hint} Apakah kendala Anda sudah teratasi?`
                        });
                    } else {
                        // 5th bot bubble or later: Suggest ticket creation
                        this.chatMessages.push({
                            id: 'bot-' + Date.now(),
                            sender: 'bot',
                            text: '[Offline Fallback] Jika kendala belum terselesaikan, berikut adalah rekomendasi katalog untuk membuat tiket pelayanan:',
                            recommendation: {
                                category: bestRule.category,
                                sub: bestRule.sub,
                                service: bestRule.service,
                                confidence: confidence
                            }
                        });
                    }
                } else {
                    const fallbackReplies = [
                        "Maaf, saya belum menemukan solusi yang cocok. Bisakah Anda menjelaskan masalah Anda dengan kata kunci lain? Seperti menggunakan kata 'email', 'wifi', 'laptop', 'siap-bpk', atau 'password'.",
                        "Saya tidak menemukan solusi untuk kata kunci tersebut di basis data offline. Harap jelaskan kembali detail kendala hardware, software, atau akun yang Anda alami."
                    ];
                    const reply = fallbackReplies[Math.floor(Math.random() * fallbackReplies.length)];
                    this.chatMessages.push({
                        id: 'bot-' + Date.now(),
                        sender: 'bot',
                        text: reply
                    });
                }
            },

            scrollChat() {
                const chatBox = document.getElementById('chat-box');
                if (chatBox) {
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            },

            formatMarkdown(text) {
                if (!text) return '';
                // Escape HTML first to prevent XSS
                let temp = document.createElement('div');
                temp.textContent = text;
                let safeHtml = temp.innerHTML;
                
                // Replace **text** with <strong>text</strong>
                safeHtml = safeHtml.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                // Replace *text* with <em>text</em>
                safeHtml = safeHtml.replace(/\*(.*?)\*/g, '<em>$1</em>');
                // Replace newlines with <br>
                safeHtml = safeHtml.replace(/\n/g, '<br>');
                return safeHtml;
            }
        };
    }
</script>
@endpush
