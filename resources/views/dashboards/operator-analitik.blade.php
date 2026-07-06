@extends('layouts.app')

@section('title', 'Analitik TI - Operator Biro TI BPK')

@section('content')
<div class="space-y-6 animate-in fade-in duration-300">
    @php
        $total = $tickets->count();

        $completed = $tickets->filter(fn($t) => $t->status === 'Selesai')->count();
        $open = $tickets->filter(fn($t) => $t->status !== 'Selesai' && $t->status !== 'Kembalikan tiket ke operator')->count();
        $rejected = $tickets->filter(fn($t) => $t->status === 'Kembalikan tiket ke operator')->count();

        // Calculate rates
        $completionRate = $total > 0 ? round(($completed / $total) * 100) : 0;
        $rejectionRate = $total > 0 ? round(($rejected / $total) * 100) : 0;

        $subbags = [
            'k1' => 'Subbag Jaringan',
            'k2' => 'Subbag Pelayanan TIK',
            'k3' => 'Subbag SIM-P',
            'k4' => 'Subbag SIM-K',
            'k5' => 'Subbag Sains Data',
            'k6' => 'Subbag Tata Kelola',
            'k7' => 'Subbag Keamanan',
            'k8' => 'Subbag MIOT'
        ];

        $subbagStats = [];
        foreach ($subbags as $id => $name) {
            $subTickets = $tickets->filter(fn($t) => $t->kasubbagId === $id);
            $subbagStats[] = [
                'name' => $name,
                'selesai' => $subTickets->filter(fn($t) => $t->status === 'Selesai')->count(),
                'terbuka' => $subTickets->filter(fn($t) => $t->status !== 'Selesai' && $t->status !== 'Kembalikan tiket ke operator')->count(),
                'ditolak' => $subTickets->filter(fn($t) => $t->status === 'Kembalikan tiket ke operator')->count(),
            ];
        }
    @endphp

    <!-- Dashboard Header -->
    <div>
        <h2 class="text-lg font-bold text-gray-800 font-display">Analitik Pelayanan & Kinerja TI</h2>
        <p class="text-xs text-gray-400 mt-1">Laporan analitik real-time performa penyelesaian tiket di Biro TI BPK RI.</p>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Card 1: Total Tiket -->
        <div class="bg-white border border-[#e2e6ea] p-5 rounded-2xl shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-mono">Total Laporan Masuk</span>
                <h3 class="text-2xl font-extrabold text-gray-800 font-display">{{ $total }}</h3>
                <p class="text-[10px] text-gray-400 font-medium">Seluruh tiket terdaftar di sistem</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-[#fcf4ec] text-[#b26d27] flex items-center justify-center">
                <i data-lucide="layers" class="w-5 h-5"></i>
            </div>
        </div>

        <!-- Card 2: Completion Rate -->
        <div class="bg-white border border-[#e2e6ea] p-5 rounded-2xl shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-mono">Rasio Penyelesaian</span>
                <h3 class="text-2xl font-extrabold text-gray-800 font-display">{{ $completionRate }}%</h3>
                <p class="text-[10px] text-gray-400 font-medium">{{ $completed }} dari {{ $total }} tiket diselesaikan</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="trending-up" class="w-5 h-5"></i>
            </div>
        </div>

        <!-- Card 3: Rejection Rate -->
        <div class="bg-white border border-[#e2e6ea] p-5 rounded-2xl shadow-xs flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider font-mono">Rasio Tiket Dikembalikan</span>
                <h3 class="text-2xl font-extrabold text-gray-800 font-display">{{ $rejectionRate }}%</h3>
                <p class="text-[10px] text-gray-400 font-medium">{{ $rejected }} tiket dikembalikan / tidak valid</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-700 flex items-center justify-center">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
            </div>
        </div>
    </div>

    <!-- Charts Container -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Doughnut Chart: Status Distribution -->
        <div class="bg-white border border-[#e2e6ea] p-5 rounded-2xl shadow-xs lg:col-span-4 flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Distribusi Status Tiket</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Rasio Selesai vs Aktif vs Dikembalikan</p>
            </div>
            
            <div class="my-6 flex items-center justify-center h-[200px]">
                <canvas id="statusChart"></canvas>
            </div>

            <div class="grid grid-cols-3 gap-1 pt-3.5 border-t border-gray-100 text-[10px] font-medium text-center">
                <div class="space-y-1">
                    <span class="text-xs font-extrabold text-emerald-600" x-text="'{{ $completed }}'"></span>
                    <div class="text-gray-400">Selesai</div>
                </div>
                <div class="space-y-1">
                    <span class="text-xs font-extrabold text-blue-600" x-text="'{{ $open }}'"></span>
                    <div class="text-gray-400">Aktif</div>
                </div>
                <div class="space-y-1">
                    <span class="text-xs font-extrabold text-rose-600" x-text="'{{ $rejected }}'"></span>
                    <div class="text-gray-400">Dikembalikan</div>
                </div>
            </div>
        </div>

        <!-- Bar Chart: Subbag Status Progress -->
        <div class="bg-white border border-[#e2e6ea] p-5 rounded-2xl shadow-xs lg:col-span-8 flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Kinerja Per Subbagian Biro TI</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Volume tiket aktif, selesai, dan dikembalikan per subbag</p>
            </div>

            <div class="mt-6 h-[250px] relative w-full">
                <canvas id="subbagChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Load Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Initialize Doughnut Chart for Status Tiket
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Aktif', 'Dikembalikan'],
                datasets: [{
                    data: [{{ $completed }}, {{ $open }}, {{ $rejected }}],
                    backgroundColor: ['#10b981', '#3b82f6', '#f43f5e'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.label}: ${context.raw} tiket`;
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });

        // 2. Initialize Stacked Bar Chart for Subbag Status
        const subbagData = @json($subbagStats);
        const subbagLabels = subbagData.map(d => d.name);
        const selesaiData = subbagData.map(d => d.selesai);
        const terbukaData = subbagData.map(d => d.terbuka);
        const ditolakData = subbagData.map(d => d.ditolak);

        const ctxSubbag = document.getElementById('subbagChart').getContext('2d');
        new Chart(ctxSubbag, {
            type: 'bar',
            data: {
                labels: subbagLabels,
                datasets: [
                    {
                        label: 'Selesai',
                        data: selesaiData,
                        backgroundColor: '#10b981',
                        borderRadius: 4
                    },
                    {
                        label: 'Terbuka',
                        data: terbukaData,
                        backgroundColor: '#3b82f6',
                        borderRadius: 4
                    },
                    {
                        label: 'Dikembalikan',
                        data: ditolakData,
                        backgroundColor: '#ef4444',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 10,
                            font: {
                                size: 10,
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 8,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        stacked: true,
                        ticks: {
                            font: {
                                size: 9
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
