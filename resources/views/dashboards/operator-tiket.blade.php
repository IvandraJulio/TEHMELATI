@extends('layouts.app')

@section('title', 'Semua Tiket - Operator Biro TI BPK')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 h-[calc(100vh-8.5rem)] animate-in fade-in duration-300" x-data="operatorTicketsPage()">
    <!-- LEFT PANEL: Ticket List with Filters (Col 5) -->
    <div class="lg:col-span-5 bg-white rounded-2xl border border-[#e2e6ea] shadow-xs flex flex-col h-full overflow-hidden">
        <!-- Search & Filter Header -->
        <div class="p-4 border-b border-[#e2e6ea] space-y-3 shrink-0">
            <div class="flex items-center justify-between gap-4">
                <h3 class="text-sm font-bold text-gray-800 font-display">Daftar Semua Tiket</h3>
                <span class="text-[10px] text-gray-400 font-mono" x-text="filteredTickets().length + ' tiket'"></span>
            </div>
            
            <!-- Search Input -->
            <div class="relative">
                <input type="text" x-model="search" placeholder="Cari ID, pelapor, detail..." class="w-full bg-slate-50 border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-800 rounded-xl pl-9.5 pr-4 py-2 text-xs outline-none transition-all placeholder:text-gray-400 font-medium">
                <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
            </div>

            <!-- Filters -->
            <div class="mb-4">
                <label class="block text-[8px] font-bold text-gray-400 mb-1 uppercase tracking-wider">Status</label>
                <select x-model="statusFilter" class="w-full bg-slate-50 border border-slate-200 focus:border-[#b26d27] text-gray-700 rounded-lg p-1.5 text-[10px] font-bold">
                    <option value="All">Semua Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Diterima">Diterima</option>
                    <option value="Ditugaskan">Ditugaskan</option>
                    <option value="Dikerjakan">Dikerjakan</option>
                    <option value="Dieskalasi">Dieskalasi</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Kembalikan tiket ke operator">Dikembalikan</option>
                </select>
            </div>
        </div>

        <!-- Scrollable Ticket List -->
        <div class="flex-1 overflow-y-auto divide-y divide-[#e2e6ea]">
            <template x-for="t in filteredTickets()" :key="t.id">
                <div @click="selectTicket(t.id)" 
                     class="p-4 text-left cursor-pointer transition-all hover:bg-slate-50/50"
                     :class="selectedId === t.id ? 'bg-[#fcf4ec]/40 border-l-4 border-l-[#b26d27]' : ''">
                    <div class="flex items-center justify-between gap-2 mb-1.5">
                        <span class="font-mono font-bold text-[#b26d27] text-xs" x-text="t.id"></span>
                        <span class="text-[10px] text-gray-400 font-mono" x-text="t.tanggal"></span>
                    </div>
                    <h4 class="text-xs font-bold text-gray-900 truncate" x-text="t.layanan"></h4>
                    <p class="text-[10px] text-gray-500 truncate" x-text="'Pelapor: ' + t.pengirimName"></p>
                    
                    <div class="flex items-center justify-between gap-2 mt-2.5">
                        <span class="status-badge font-semibold" :class="getStatusBadgeClass(t.status)" x-text="t.status === 'Kembalikan tiket ke operator' ? 'Dikembalikan' : t.status"></span>
                    </div>
                </div>
            </template>
            <div x-show="filteredTickets().length === 0" class="p-8 text-center text-gray-400 text-xs">
                Tidak ada tiket ditemukan.
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL: Ticket Details (Col 7) -->
    <div class="lg:col-span-7 bg-white rounded-2xl border border-[#e2e6ea] shadow-xs flex flex-col h-full overflow-hidden">
        <template x-if="getSelectedTicket()">
            <div class="flex flex-col h-full overflow-hidden">
                <!-- Details Header -->
                <div class="p-5 border-b border-[#e2e6ea] shrink-0 bg-slate-50/40">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-base font-bold text-gray-800 font-display mt-0.5" x-text="getSelectedTicket().layanan"></h2>
                            <p class="text-[11px] text-gray-400 mt-1" x-text="'ID: ' + getSelectedTicket().id + ' | Pelapor: ' + getSelectedTicket().pengirimName"></p>
                        </div>
                        <span class="status-badge" :class="getStatusBadgeClass(getSelectedTicket().status)" x-text="getSelectedTicket().status === 'Kembalikan tiket ke operator' ? 'Dikembalikan' : getSelectedTicket().status"></span>
                    </div>
                </div>

                <!-- Scrollable Body -->
                <div class="flex-1 overflow-y-auto p-5 space-y-6">
                    <!-- Issue Detail -->
                    <div class="space-y-2 bg-[#fffbeb]/20 border border-[#e8ceab]/30 p-4 rounded-xl">
                        <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider flex items-center gap-1.5">
                            <i data-lucide="info" class="w-4 h-4 text-[#b26d27]"></i>
                            <span>Detail Pelaporan</span>
                        </h3>
                        <p class="text-xs text-gray-700 leading-relaxed font-medium whitespace-pre-wrap" x-text="getSelectedTicket().detail"></p>
                    </div>

                    <!-- Flow Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs font-medium text-gray-600">
                        <div class="border border-slate-100 p-3 rounded-xl space-y-1">
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider font-bold">Rute Subbagian</div>
                            <div class="text-gray-800 font-bold" x-text="getSelectedTicket().kasubbagName"></div>
                        </div>
                        <div class="border border-slate-100 p-3 rounded-xl space-y-1" x-show="getSelectedTicket().solverName">
                            <div class="text-[10px] text-gray-400 uppercase tracking-wider font-bold">Solver Ditugaskan</div>
                            <div class="text-gray-800 font-bold" x-text="getSelectedTicket().solverName"></div>
                        </div>
                    </div>

                    <!-- REASSIGN SECTION (Only if Operator role has access or if ticket status allows) -->
                    <div class="border-t border-slate-100 pt-5 space-y-3.5">
                        <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Penugasan Ulang Subbagian (Reassign)</h4>
                        
                        <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl flex flex-col md:flex-row md:items-end gap-3.5">
                            <div class="flex-1">
                                <label class="block text-[10px] font-bold text-gray-400 mb-1.5 uppercase tracking-wider">Pindahkan Subbagian TI</label>
                                <select x-model="selectedSubbagId" class="w-full bg-white border border-slate-200 focus:border-[#b26d27] focus:ring-1 focus:ring-[#b26d27]/30 text-gray-700 rounded-lg p-2.5 text-xs font-bold">
                                    <template x-for="(name, id) in subbags">
                                        <option :value="id" x-text="name" :selected="id === getSelectedTicket().kasubbagId"></option>
                                    </template>
                                </select>
                            </div>
                            <button @click="reassignTicket()" class="bg-[#b26d27] hover:bg-[#9b5a1b] text-white font-bold text-xs py-3 px-4 rounded-xl transition-all shadow-sm hover:shadow-md cursor-pointer shrink-0">
                                Pindahkan Rute
                            </button>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="border-t border-slate-100 pt-5 flex flex-col space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- LEFT COLUMN: Chat/Obrolan -->
                            <div class="flex flex-col space-y-3">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5">
                                    <i data-lucide="message-square" class="w-4 h-4 text-[#b26d27]"></i>
                                    <span>Obrolan & Komentar</span>
                                </h3>

                                <!-- Comments Thread -->
                                <div class="space-y-3.5 max-h-[250px] overflow-y-auto pr-1" id="comments-box">
                                    <template x-for="c in getSelectedTicket().comments.filter(c => !['sistem', 'terima', 'penugasan', 'mulai_kerjakan', 'penyelesaian', 'eskalasi'].includes(c.type))" :key="c.id">
                                        <div class="p-3.5 rounded-lg border leading-relaxed text-xs" 
                                             :class="getCommentBubbleClass(c.type)">
                                            <div class="flex items-center justify-between gap-2 mb-1.5">
                                                <div class="flex items-center gap-2 min-w-0">
                                                    <span class="font-bold text-gray-900 truncate" x-text="c.authorName"></span>
                                                    <span class="text-[9px] font-extrabold px-1.5 py-0.5 rounded uppercase"
                                                          :class="getRoleBadgeClass(c.authorRole)"
                                                          x-text="c.authorRole"></span>
                                                </div>
                                                <span class="text-[9px] text-gray-400 font-mono" x-text="c.timestamp"></span>
                                            </div>
                                            <p class="text-xs font-medium text-gray-700 whitespace-pre-wrap" x-text="c.text"></p>
                                        </div>
                                    </template>
                                    <div x-show="getSelectedTicket().comments.filter(c => !['sistem', 'terima', 'penugasan', 'mulai_kerjakan', 'penyelesaian', 'eskalasi'].includes(c.type)).length === 0" class="text-center py-6 text-gray-400 text-xs font-medium">
                                        Belum ada obrolan.
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT COLUMN: Log Aktivitas -->
                            <div class="flex flex-col space-y-3">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5">
                                    <i data-lucide="history" class="w-4 h-4 text-[#b26d27]"></i>
                                    <span>Log Aktivitas Sistem</span>
                                </h3>

                                <!-- Logs Thread -->
                                <div class="space-y-3.5 max-h-[250px] overflow-y-auto pr-1" id="logs-box">
                                    <template x-for="c in getSelectedTicket().comments.filter(c => ['sistem', 'terima', 'penugasan', 'mulai_kerjakan', 'penyelesaian', 'eskalasi'].includes(c.type))" :key="c.id">
                                        <div class="p-3.5 rounded-lg border leading-relaxed text-xs" 
                                             :class="getCommentBubbleClass(c.type)">
                                            <div class="flex items-center justify-between gap-2 mb-1.5">
                                                <div class="flex items-center gap-2 min-w-0">
                                                    <span class="font-bold text-gray-900 truncate" x-text="c.authorName"></span>
                                                    <span class="text-[9px] font-extrabold px-1.5 py-0.5 rounded uppercase"
                                                          :class="getRoleBadgeClass(c.authorRole)"
                                                          x-text="c.authorRole"></span>
                                                </div>
                                                <span class="text-[9px] text-gray-400 font-mono" x-text="c.timestamp"></span>
                                            </div>
                                            <p class="text-xs font-medium text-gray-700 whitespace-pre-wrap" x-text="c.text"></p>
                                        </div>
                                    </template>
                                    <div x-show="getSelectedTicket().comments.filter(c => ['sistem', 'terima', 'penugasan', 'mulai_kerjakan', 'penyelesaian', 'eskalasi'].includes(c.type)).length === 0" class="text-center py-6 text-gray-400 text-xs font-medium">
                                        Belum ada log aktivitas.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template x-if="!getSelectedTicket()">
            <div class="m-auto text-center py-12 text-gray-400 space-y-2">
                <i data-lucide="layers" class="w-12 h-12 mx-auto text-gray-300"></i>
                <p class="text-sm font-semibold">Pilih tiket dari daftar di sebelah kiri untuk melihat detail.</p>
            </div>
        </template>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function operatorTicketsPage() {
        return {
            tickets: [],
            selectedId: null,
            search: '',
            statusFilter: 'All',
            selectedSubbagId: '',

            subbags: {
                'k1': 'Subbagian Pengelolaan Infrastruktur dan Jaringan',
                'k2': 'Subbagian Pelayanan TIK',
                'k3': 'Subbagian Pengembangan Sistem Informasi Pemeriksaan',
                'k4': 'Subbagian Pengembangan Sistem Informasi Kelembagaan',
                'k5': 'Subbagian Sains Data',
                'k6': 'Subbagian Tata Kelola Data',
                'k7': 'Subbagian Keamanan Informasi',
                'k8': 'Subbagian MIOT'
            },

            init() {
                // Preselect from query params
                const params = new URLSearchParams(window.location.search);
                const qId = params.get('id');
                if (qId) {
                    this.selectedId = qId;
                }
                
                this.fetchTickets();
            },

            async fetchTickets() {
                try {
                    const res = await fetch('/api/tickets');
                    this.tickets = await res.json();
                    
                    const displayed = this.filteredTickets();
                    if (displayed.length > 0 && !this.selectedId) {
                        this.selectedId = displayed[0].id;
                    }
                    
                    const selected = this.getSelectedTicket();
                    if (selected) {
                        this.selectedSubbagId = selected.kasubbagId;
                    }
                    
                    this.$nextTick(() => {
                        lucide.createIcons();
                        this.scrollComments();
                    });
                } catch (e) {
                    console.error(e);
                }
            },

            filteredTickets() {
                return this.tickets.filter(t => {
                    // Status filter
                    if (this.statusFilter !== 'All') {
                        if (t.status !== this.statusFilter) return false;
                    }
                    
                    // Search box
                    if (this.search) {
                        const s = this.search.toLowerCase();
                        return t.id.toLowerCase().includes(s) ||
                               t.pengirimName.toLowerCase().includes(s) ||
                               t.layanan.toLowerCase().includes(s) ||
                               t.detail.toLowerCase().includes(s);
                    }

                    return true;
                });
            },

            getSelectedTicket() {
                return this.tickets.find(t => t.id === this.selectedId);
            },

            selectTicket(id) {
                this.selectedId = id;
                const t = this.getSelectedTicket();
                if (t) {
                    this.selectedSubbagId = t.kasubbagId;
                }
                this.$nextTick(() => {
                    lucide.createIcons();
                    this.scrollComments();
                });
            },

            getStatusBadgeClass(status) {
                if (status === 'Kembalikan tiket ke operator') {
                    return 'status-ditolak';
                }
                switch (status) {
                    case 'Pending': return 'status-pending';
                    case 'Diterima': return 'status-diterima';
                    case 'Ditugaskan': return 'status-ditugaskan';
                    case 'Dikerjakan': return 'status-dikerjakan';
                    case 'Dieskalasi': return 'status-dieskalasi';
                    case 'Selesai': return 'status-selesai';
                    default: return 'status-pending';
                }
            },

            getCommentBubbleClass(type) {
                switch (type) {
                    case 'sistem': return 'bg-slate-50 border-slate-200 text-slate-700';
                    case 'terima': return 'bg-emerald-50 border-l-4 border-l-emerald-500 text-emerald-800';
                    case 'penugasan': return 'bg-blue-50 border-l-4 border-l-blue-500 text-blue-800';
                    case 'mulai_kerjakan': return 'bg-purple-50 border-l-4 border-l-purple-500 text-purple-800';
                    case 'penyelesaian': return 'bg-green-50 border-l-4 border-l-green-600 text-green-800';
                    case 'eskalasi': return 'bg-amber-50 border-l-4 border-l-amber-500 text-amber-800';
                    default: return 'bg-white border-[#e2e6ea] shadow-xs text-gray-800';
                }
            },

            getRoleBadgeClass(role) {
                if (role === 'pengguna') return 'bg-[#fcf4ec] text-[#b26d27]';
                if (role === 'kasubbag') return 'bg-blue-100 text-blue-800';
                if (role === 'solver') return 'bg-purple-100 text-purple-800';
                return 'bg-slate-100 text-slate-700';
            },

            async reassignTicket() {
                const ticket = this.getSelectedTicket();
                if (!ticket || !this.selectedSubbagId) return;

                const subbagName = this.subbags[this.selectedSubbagId];
                const operatorName = '{{ Auth::user()->name }}';

                try {
                    const response = await fetch(`/api/tickets/${ticket.id}/actions`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            status: 'Pending',
                            kasubbagId: this.selectedSubbagId,
                            kasubbagName: `Kasubbag ${subbagName}`,
                            solverId: '',
                            solverName: '',
                            comment: {
                                text: `Operator ${operatorName} mengalihkan rute tiket ke ${subbagName}.`,
                                type: 'penugasan'
                            }
                        })
                    });

                    if (response.ok) {
                        this.fetchTickets();
                    } else {
                        alert('Gagal memindahkan rute tiket.');
                    }
                } catch (e) {
                    alert('Terjadi kesalahan jaringan.');
                }
            },

            scrollComments() {
                const box = document.getElementById('comments-box');
                if (box) {
                    box.scrollTop = box.scrollHeight;
                }
                const logBox = document.getElementById('logs-box');
                if (logBox) {
                    logBox.scrollTop = logBox.scrollHeight;
                }
            }
        };
    }
</script>
@endpush
