@extends('layouts.app')

@section('title', 'Dashboard Pegawai - Portal Layanan TI BPK')

@section('content')
<div class="space-y-6 animate-in fade-in duration-300">
    @php
        $totalCount = $tickets->count();
        $pendingCount = $tickets->filter(fn($t) => $t->status === 'Pending' || $t->status === 'Kembalikan tiket ke operator')->count();
        $activeCount = $tickets->filter(fn($t) => in_array($t->status, ['Diterima', 'Ditugaskan', 'Dikerjakan', 'Dieskalasi']))->count();
        $completedCount = $tickets->filter(fn($t) => $t->status === 'Selesai')->count();
    @endphp

    <!-- Section Heading -->
    <div>
        <h2 class="text-lg font-bold text-[#b26d27] font-display">Status Tiket Saya</h2>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Total Tiket -->
        <div class="bg-white p-5 rounded-2xl shadow-xs flex flex-col justify-between h-28 border border-slate-100/30">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-mono">Total Tiket</span>
            <div class="flex items-baseline justify-between mt-2">
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalCount }}</h3>
                <div class="w-8 h-8 rounded-xl bg-[#fcf4ec] text-[#b26d27] flex items-center justify-center">
                    <i data-lucide="layers" class="w-4.5 h-4.5"></i>
                </div>
            </div>
        </div>

        <!-- Card 2: Menunggu -->
        <div class="bg-white p-5 rounded-2xl shadow-xs flex flex-col justify-between h-28 border border-slate-100/30">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-mono">Menunggu</span>
            <div class="flex items-baseline justify-between mt-2">
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $pendingCount }}</h3>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                    <i data-lucide="clock" class="w-4.5 h-4.5"></i>
                </div>
            </div>
        </div>

        <!-- Card 3: Diproses -->
        <div class="bg-white p-5 rounded-2xl shadow-xs flex flex-col justify-between h-28 border border-slate-100/30">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-mono">Diproses</span>
            <div class="flex items-baseline justify-between mt-2">
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $activeCount }}</h3>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                    <i data-lucide="play" class="w-4.5 h-4.5"></i>
                </div>
            </div>
        </div>

        <!-- Card 4: Selesai -->
        <div class="bg-white p-5 rounded-2xl shadow-xs flex flex-col justify-between h-28 border border-slate-100/30">
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-mono">Selesai</span>
            <div class="flex items-baseline justify-between mt-2">
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $completedCount }}</h3>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-4.5 h-4.5"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tickets Panel -->
    <div class="bg-white rounded-2xl shadow-xs overflow-hidden border border-slate-100/30">
        <!-- Header -->
        <div class="p-5 border-b border-slate-100 flex items-center justify-between gap-4">
            <div>
                <h3 class="text-sm font-bold text-gray-800 font-display">Tiket terbaru</h3>
                <p class="text-xs text-gray-400 mt-0.5">Status riwayat pelayanan Anda</p>
            </div>
            <a href="{{ route('dashboard.tiket') }}" class="text-[#b26d27] hover:underline text-xs font-bold flex items-center gap-1 cursor-pointer">
                <span>Lihat semua</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            @if($tickets->isEmpty())
                <div class="text-center py-12 text-gray-400 space-y-2">
                    <i data-lucide="file-spreadsheet" class="w-10 h-10 mx-auto text-gray-300"></i>
                    <p class="text-xs font-medium">Belum ada tiket yang dilaporkan.</p>
                    <a href="{{ route('dashboard.lapor') }}" class="inline-block mt-2 text-xs bg-[#b26d27] text-white font-bold px-4 py-2 rounded-full hover:bg-[#9b5a1b] transition-colors cursor-pointer">
                        Buat Laporan Baru
                    </a>
                </div>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-[10px] font-bold text-gray-400 uppercase tracking-wider border-b border-slate-100">
                            <th class="px-6 py-4">ID Tiket</th>
                            <th class="px-6 py-4">Kategori Layanan</th>
                            <th class="px-6 py-4">Layanan</th>
                            <th class="px-6 py-4">Tanggal Update</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-medium text-gray-700">
                        @foreach($tickets->take(5) as $ticket)
                            @php
                                $displayStatus = $ticket->status === 'Kembalikan tiket ke operator' ? 'Pending' : $ticket->status;
                                $statusClass = '';
                                switch ($displayStatus) {
                                    case 'Pending': $statusClass = 'status-pending'; break;
                                    case 'Diterima': $statusClass = 'status-diterima'; break;
                                    case 'Ditugaskan': $statusClass = 'status-ditugaskan'; break;
                                    case 'Dikerjakan': $statusClass = 'status-dikerjakan'; break;
                                    case 'Dieskalasi': $statusClass = 'status-dieskalasi'; break;
                                    case 'Selesai': $statusClass = 'status-selesai'; break;
                                    default: $statusClass = 'status-pending';
                                }
                            @endphp
                            <tr class="hover:bg-slate-50/20 transition-colors">
                                <td class="px-6 py-4 font-mono font-bold text-[#b26d27]">{{ $ticket->id }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900 block">{{ $ticket->layananKategori }}</span>
                                    <span class="text-gray-400 text-[10px] block mt-0.5">{{ $ticket->layananSub }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-800 block truncate max-w-xs" title="{{ $ticket->layanan }}">
                                        {{ $ticket->layanan }}
                                    </span>
                                    <span class="text-gray-400 text-[10px] block truncate max-w-xs mt-0.5">{{ $ticket->detail }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 font-mono">{{ $ticket->tanggalUpdate }}</td>
                                <td class="px-6 py-4">
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $displayStatus }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('dashboard.tiket', ['id' => $ticket->id]) }}" class="inline-block bg-slate-100 hover:bg-[#fcf4ec] hover:text-[#b26d27] text-gray-700 font-bold px-3 py-1.5 rounded-xl transition-all cursor-pointer">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
