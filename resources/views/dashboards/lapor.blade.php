@extends('layouts.app')

@section('title', 'Lapor Insiden/Layanan - Portal Layanan TI BPK')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6" x-data="laporPage()">
    <!-- LEFT COLUMN: Report Form -->
    <div class="lg:col-span-7 bg-white p-5 md:p-6 rounded-2xl border border-[#e2e6ea] shadow-xs space-y-6">
        <div>
            <h2 class="text-lg font-bold text-gray-800 font-display">Form Lapor Insiden / Permintaan Layanan</h2>
            <p class="text-xs text-gray-400 mt-1">Gunakan form di bawah ini atau minta bantuan asisten AI di sebelah kanan untuk mengisi otomatis.</p>
        </div>

        <div x-show="successMessage" class="p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-semibold flex items-center gap-3">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600 shrink-0"></i>
            <div>
                <p class="font-bold">Laporan Terkirim!</p>
                <p class="text-[11px] text-emerald-700 mt-0.5" x-text="'Tiket ' + successMessage + ' berhasil dibuat.'"></p>
                <a :href="'/dashboard/tiket?id=' + successMessage" class="text-[#b26d27] hover:underline font-bold mt-1 inline-block">Lihat Tiket Saya →</a>
            </div>
        </div>

        <form @submit.prevent="submitForm()" class="space-y-4">
            <!-- Kategori Select -->
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-1.5 uppercase tracking-wider">Kategori (Level 1)</label>
                <select x-model="kategori" @change="onCategoryChange()" class="w-full bg-white border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-xl px-4 py-3 text-sm outline-none transition-all font-medium">
                    <option value="">-- Pilih Kategori --</option>
                    <template x-for="cat in catalog">
                        <option :value="cat.category" x-text="cat.category"></option>
                    </template>
                </select>
            </div>

            <!-- Sub-Layanan Select -->
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-1.5 uppercase tracking-wider">Sub-Layanan (Level 2)</label>
                <select x-model="subLayanan" @change="onSubChange()" :disabled="!kategori" class="w-full bg-white border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-xl px-4 py-3 text-sm outline-none transition-all font-medium disabled:opacity-50">
                    <option value="">-- Pilih Sub-Layanan --</option>
                    <template x-for="sub in getSubLayananList()">
                        <option :value="sub.name" x-text="sub.name"></option>
                    </template>
                </select>
            </div>

            <!-- Detail Layanan Select -->
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-1.5 uppercase tracking-wider">Detail Layanan (Level 3)</label>
                <select x-model="detailLayanan" :disabled="!subLayanan" class="w-full bg-white border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-xl px-4 py-3 text-sm outline-none transition-all font-medium disabled:opacity-50">
                    <option value="">-- Pilih Detail Layanan --</option>
                    <template x-for="item in getDetailLayananList()">
                        <option :value="item" x-text="item"></option>
                    </template>
                </select>
            </div>

            <!-- Auto-routing Info -->
            <div x-show="kategori" class="p-3 bg-slate-50 border border-slate-100 rounded-xl flex items-center gap-2 text-xs text-gray-500 font-medium" style="display: none;">
                <i data-lucide="info" class="w-4 h-4 text-[#b26d27]"></i>
                <span>Tiket akan otomatis diteruskan ke: <strong class="text-gray-700" x-text="getRoutingInfo()"></strong></span>
            </div>

            <!-- Detail Masalah -->
            <div>
                <label class="block text-xs font-bold text-gray-400 mb-1.5 uppercase tracking-wider">Detail Masalah / Deskripsi Permintaan</label>
                <textarea x-model="detailMasalah" rows="4" placeholder="Jelaskan secara spesifik kendala hardware, software, atau bantuan yang Anda butuhkan..." class="w-full bg-white border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-xl px-4 py-3 text-sm outline-none transition-all font-medium placeholder:text-gray-300"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" :disabled="loadingSubmit" class="w-full bg-[#b26d27] hover:bg-[#9b5a1b] text-white font-bold text-sm py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50">
                <i data-lucide="send" class="w-4.5 h-4.5"></i>
                <span x-text="loadingSubmit ? 'Mengirim...' : 'Kirim Laporan'"></span>
            </button>
        </form>
    </div>

    <!-- RIGHT COLUMN: Service Chatbot -->
    <div class="lg:col-span-5 flex flex-col bg-white border border-[#e2e6ea] rounded-2xl shadow-sm h-[560px] overflow-hidden">
        <!-- Chat Header -->
        <div class="bg-[#F0DCC0] text-[#78430e] px-4 py-4 flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-[#b26d27] flex items-center justify-center text-white">
                <i data-lucide="bot" class="w-5 h-5"></i>
            </div>
            <div>
                <h3 class="text-sm font-bold font-display leading-tight flex items-center gap-1.5">
                    <span>Asisten Virtual Layanan TI</span>
                    <span class="text-[9px] px-1.5 py-0.5 rounded-full font-mono font-bold text-white bg-emerald-600 animate-pulse">
                        GEMINI AI
                    </span>
                </h3>
                <p class="text-[10px] text-gray-600 font-medium">Bantu isi form otomatis dengan deskripsi masalah Anda</p>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-slate-50" id="chat-box">
            <template x-for="msg in chatMessages" :key="msg.id">
                <div class="flex gap-2.5 max-w-[85%]" :class="msg.sender === 'user' ? 'ml-auto flex-row-reverse' : 'mr-auto'">
                    <!-- Avatar -->
                    <div class="w-7 h-7 rounded-full shrink-0 flex items-center justify-center font-bold text-xs"
                         :class="msg.sender === 'bot' ? 'bg-[#fcf4ec] text-[#b26d27] border border-[#f7e3ce]' : 'bg-[#F0DCC0] text-[#78430e]'">
                        <template x-if="msg.sender === 'bot'">
                            <i data-lucide="bot" class="w-4 h-4"></i>
                        </template>
                        <template x-if="msg.sender === 'user'">
                            <i data-lucide="user" class="w-4 h-4"></i>
                        </template>
                    </div>

                    <!-- Bubble -->
                    <div class="space-y-1.5">
                        <div class="p-3 rounded-2xl text-xs leading-relaxed shadow-xs"
                             :class="msg.sender === 'bot' ? 'bg-white text-gray-800 rounded-tl-none border border-gray-100' : 'bg-[#b26d27] text-white rounded-tr-none'"
                             x-text="msg.text"></div>

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
                                    <span>Gunakan Rekomendasi</span>
                                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            <!-- Typing Indicator -->
            <div x-show="chatLoading" class="flex gap-2.5 max-w-[85%] mr-auto" style="display: none;">
                <div class="w-7 h-7 rounded-full bg-[#fcf4ec] text-[#b26d27] flex items-center justify-center border border-[#f7e3ce]">
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
        <form @submit.prevent="sendChatMessage()" class="p-3 bg-white border-t border-[#e2e6ea] flex gap-2">
            <input type="text" x-model="chatInput" placeholder="Tulis kendala Anda (contoh: wifi lemot total)..." class="flex-1 bg-slate-50 border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-xl px-4 py-2.5 text-xs outline-none transition-all placeholder:text-gray-400 font-medium">
            <button type="submit" class="bg-[#b26d27] hover:bg-[#9b5a1b] text-white w-9.5 h-9.5 rounded-xl flex items-center justify-center shrink-0 cursor-pointer shadow-sm hover:shadow-md transition-all">
                <i data-lucide="send" class="w-4 h-4"></i>
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function laporPage() {
        return {
            kategori: '',
            subLayanan: '',
            detailLayanan: '',
            detailMasalah: '',
            loadingSubmit: false,
            successMessage: '',
            
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

            catalog: [
                {
                    category: "Layanan Identitas",
                    subs: [
                        { name: "Layanan Akun", items: ["Pembuatan Akun Baru Portal BPK", "Reset Password / Masalah Login", "Perubahan Hak Akses Aplikasi", "Penghapusan / Penonaktifan Akun Pegawai"] },
                        { name: "Layanan TTE", items: ["Registrasi Sertifikat TTE Baru", "Perpanjangan Masa Aktif TTE", "Pencabutan Sertifikat TTE", "Troubleshooting Tanda Tangan Elektronik Gagal"] },
                        { name: "Layanan Segel Elektronik", items: ["Penerbitan Segel Baru Instansi", "Perpanjangan Masa Aktif Segel", "Masalah Verifikasi Segel Elektronik"] },
                        { name: "Layanan Email", items: ["Pembuatan Email Baru @bpk.go.id", "Reset Password Email Dinas", "Masalah Kuota Email Penuh", "Konfigurasi Mail Client (Outlook/Thunderbird/HP)"] },
                        { name: "Layanan MFA", items: ["Registrasi Multi-Factor Authentication Baru", "Reset Token MFA / Google Authenticator", "Masalah Sinkronisasi Waktu MFA"] }
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
                        { name: "Pengembangan Aplikasi", items: ["Permintaan Fitur Baru Aplikasi", "Pelaporan Bug / Error Aplikasi", "Uji Coba / Testing Aplikasi Baru", "Integrasi API Antar Aplikasi BPK"] },
                        { name: "Aplikasi Pemeriksaan", items: ["SiAP-BPK (Sistem Informasi Pemeriksaan)", "Aplikasi E-Audit Pemeriksaan Pusat", "Aplikasi Kertas Kerja Pemeriksaan (KKP)", "Masalah Sinkronisasi Offline SiAP-BPK"] },
                        { name: "Aplikasi Kelembagaan", items: ["Aplikasi Kepegawaian (SISDM BPK)", "Aplikasi Keuangan (SIKAD BPK)", "Aplikasi Persuratan Dinas (E-Office)", "Aplikasi Perjalanan Dinas Pegawai"] },
                        { name: "Aplikasi Pendukung", items: ["Aplikasi Manajemen Risiko Biro TI", "Aplikasi Helpdesk Biro TI", "Aplikasi Presensi Pegawai BPK"] },
                        { name: "Aplikasi Kolaborasi", items: ["Microsoft Teams BPK", "BPK Cloud Storage (Nextcloud)", "Aplikasi Survei Internal BPK"] },
                        { name: "Layanan Survei", items: ["Pembuatan Kuesioner Baru", "Analisis Hasil Survei Internal", "Export Data Survei Pegawai"] }
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
                        { name: "Standarisasi Perangkat Komputer", items: ["Konsultasi Spesifikasi PC/Laptop", "Verifikasi Kelayakan Perangkat Lama", "Instalasi OS Standar BPK RI"] },
                        { name: "Pemeliharaan Perangkat", items: ["Pembersihan Hardware PC/Laptop", "Perbaikan Kerusakan Fisik Laptop Dinas", "Instalasi Antivirus / Scan Malware Perangkat"] },
                        { name: "Peminjaman Perangkat", items: ["Peminjaman Laptop Rapat Paripurna", "Peminjaman Projector / Proyektor", "Peminjaman Sound System", "Pengembalian Perangkat Pinjaman"] },
                        { name: "Penyediaan Barang Persediaan", items: ["Penyediaan Toner / Tinta Printer Biro", "Penyediaan Mouse / Keyboard Baru", "Penyediaan Kabel Konektor Display / HDMI"] }
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

            getRoutingInfo() {
                if (!this.kategori) return '';
                const routing = this.subbagRouting[this.subLayanan] || this.subbagRouting[this.kategori] || 'Subbagian Pelayanan TIK';
                return routing;
            },

            applyRecommendation(rec) {
                this.kategori = rec.category;
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
                            layanan: this.detailLayanan,
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
                    { keywords: ["lan", "kabel lan", "kabel", "colokan lan", "port lan"], category: "Layanan Teknologi", sub: "Layanan Intranet", service: "Penyediaan kabel LAN ruang kerja" },
                    { keywords: ["wifi", "wi-fi", "wireless", "internet kantor", "sinyal wifi"], category: "Layanan Teknologi", sub: "Layanan Intranet", service: "Pengaturan konfigurasi Wifi Biro" },
                    { keywords: ["mfa", "multi factor", "google authenticator", "otp", "token mfa"], category: "Layanan Identitas", sub: "Layanan MFA", service: "Registrasi Multi-Factor Authentication Baru" },
                    { keywords: ["mfa reset", "reset mfa", "authenticator", "otp salah"], category: "Layanan Identitas", sub: "Layanan MFA", service: "Reset Token MFA / Google Authenticator" },
                    { keywords: ["vpn", "vpn bpk", "akses intranet", "vpn error", "connect vpn"], category: "Layanan Teknologi", sub: "Layanan Virtual Private Network", service: "Pemasangan VPN BPK di Laptop" },
                    { keywords: ["buat akun", "akun baru", "daftar portal", "user baru"], category: "Layanan Identitas", sub: "Layanan Akun", service: "Pembuatan Akun Baru Portal BPK" },
                    { keywords: ["lupa password", "reset password", "password locked", "ganti sandi"], category: "Layanan Identitas", sub: "Layanan Akun", service: "Reset Password / Masalah Login" },
                    { keywords: ["tte", "tanda tangan", "tanda tangan elektronik", "sertifikat tte"], category: "Layanan Identitas", sub: "Layanan TTE", service: "Registrasi Sertifikat TTE Baru" },
                    { keywords: ["email", "email dinas", "email bpk", "buat email"], category: "Layanan Identitas", sub: "Layanan Email", service: "Pembuatan Email Baru @bpk.go.id" },
                    { keywords: ["email penuh", "kuota email", "storage email"], category: "Layanan Identitas", sub: "Layanan Email", service: "Masalah Kuota Email Penuh" },
                    { keywords: ["laptop lambat", "laptop lemot", "upgrade ram", "perbaikan"], category: "Layanan Perangkat", sub: "Pemeliharaan Perangkat", service: "Perbaikan Kerusakan Fisik Laptop Dinas" },
                    { keywords: ["virus", "antivirus", "malware", "scan laptop"], category: "Layanan Perangkat", sub: "Pemeliharaan Perangkat", service: "Instalasi Antivirus / Scan Malware Perangkat" },
                    { keywords: ["siap", "siap-bpk", "audit siap", "unggah kkp"], category: "Layanan Aplikasi", sub: "Aplikasi Pemeriksaan", service: "SiAP-BPK (Sistem Informasi Pemeriksaan)" },
                    { keywords: ["sisdm", "kepegawaian", "absen sisdm", "cuti sisdm"], category: "Layanan Aplikasi", sub: "Aplikasi Kelembagaan", service: "Aplikasi Kepegawaian (SISDM BPK)" },
                    { keywords: ["e-office", "eoffice", "persuratan", "naskah dinas"], category: "Layanan Aplikasi", sub: "Aplikasi Kelembagaan", service: "Aplikasi Persuratan Dinas (E-Office)" }
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
                    this.chatMessages.push({
                        id: 'bot-' + Date.now(),
                        sender: 'bot',
                        text: '[Offline Fallback] Berdasarkan kata kunci Anda, berikut adalah rekomendasi katalog yang sesuai:',
                        recommendation: {
                            category: bestRule.category,
                            sub: bestRule.sub,
                            service: bestRule.service,
                            confidence: confidence
                        }
                    });
                } else {
                    const fallbackReplies = [
                        "Maaf, saya belum menemukan kategori layanan yang cocok. Bisakah Anda menjelaskannya dengan kata kunci lain? Seperti menggunakan kata 'email', 'wifi', 'laptop', 'siap-bpk', atau 'password'.",
                        "Kata kunci tersebut tidak terdaftar di Katalog Layanan TI BPK RI. Mohon deskripsikan kembali masalah hardware, software, atau akun yang Anda alami."
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
            }
        };
    }
</script>
@endpush
