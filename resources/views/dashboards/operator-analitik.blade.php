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

        if (!function_exists('formatIndoDate')) {
            function formatIndoDate($dateStr) {
                if (empty($dateStr)) return '-';
                $timestamp = strtotime(substr($dateStr, 0, 10));
                if (!$timestamp) return $dateStr;
                
                $months = [
                    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                
                $d = date('d', $timestamp);
                $m = $months[(int)date('m', $timestamp)];
                $y = date('Y', $timestamp);
                
                return "$d $m $y";
            }
        }

        // Get 7 Days trend datasets
        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $last7Days[] = date('Y-m-d', strtotime("-$i days"));
        }

        $trendData = [];
        foreach ($last7Days as $day) {
            $trendData[] = [
                'date' => $day,
                'formatted' => formatIndoDate($day),
                'incoming' => $tickets->filter(fn($t) => $t->tanggal === $day)->count(),
                'completed' => $tickets->filter(fn($t) => $t->tanggalSelesai === $day && $t->status === 'Selesai')->count(),
                'in_progress' => $tickets->filter(fn($t) => $t->tanggal === $day && in_array($t->status, ['Diterima', 'Ditugaskan', 'Dikerjakan', 'Dieskalasi']))->count()
            ];
        }

        // Get historical list of daily reports
        $allDates = $tickets->pluck('tanggal')
            ->merge($tickets->whereNotNull('tanggalSelesai')->pluck('tanggalSelesai'))
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        $dailyReports = [];
        foreach ($allDates as $date) {
            $incomingCount = $tickets->filter(fn($t) => $t->tanggal === $date)->count();
            $completedCount = $tickets->filter(fn($t) => $t->tanggalSelesai === $date && $t->status === 'Selesai')->count();
            $inProgressCount = $tickets->filter(fn($t) => $t->tanggal === $date && in_array($t->status, ['Diterima', 'Ditugaskan', 'Dikerjakan', 'Dieskalasi']))->count();

            if ($incomingCount > 0 || $completedCount > 0 || $inProgressCount > 0) {
                $dailyReports[] = [
                    'date' => $date,
                    'formatted' => formatIndoDate($date),
                    'incoming' => $incomingCount,
                    'in_progress' => $inProgressCount,
                    'completed' => $completedCount
                ];
            }
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

    <!-- Daily Report Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Daily Trend Chart (Col 8) -->
        <div class="bg-white border border-[#e2e6ea] p-5 rounded-2xl shadow-xs lg:col-span-8 flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider flex items-center gap-1.5">
                    <i data-lucide="trending-up" class="w-4 h-4 text-[#b26d27]"></i>
                    <span>Tren Pelayanan Harian (7 Hari Terakhir)</span>
                </h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Perbandingan harian tiket masuk, selesai, dan aktif.</p>
            </div>
            <div class="mt-6 h-[250px] relative w-full">
                <canvas id="dailyTrendChart"></canvas>
            </div>
        </div>

        <!-- Summary Widget (Col 4) -->
        <div class="bg-white border border-[#e2e6ea] p-5 rounded-2xl shadow-xs lg:col-span-4 flex flex-col justify-between">
            <div>
                <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Rangkuman Hari Ini</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Statistik aktivitas pelayanan khusus hari ini.</p>
            </div>
            
            <div class="space-y-4 my-auto py-4">
                <div class="flex justify-between items-center p-3.5 bg-blue-50/50 border border-blue-100/50 rounded-xl">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-500 text-white flex items-center justify-center">
                            <i data-lucide="file-plus" class="w-4.5 h-4.5"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-700">Tiket Masuk Hari Ini</span>
                    </div>
                    <span class="text-lg font-extrabold text-blue-700">{{ $tickets->filter(fn($t) => $t->tanggal === date('Y-m-d'))->count() }}</span>
                </div>

                <div class="flex justify-between items-center p-3.5 bg-amber-50/50 border border-amber-100/50 rounded-xl">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-500 text-white flex items-center justify-center">
                            <i data-lucide="clock" class="w-4.5 h-4.5"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-700">Sedang Dikerjakan</span>
                    </div>
                    <span class="text-lg font-extrabold text-amber-700">{{ $tickets->filter(fn($t) => in_array($t->status, ['Diterima', 'Ditugaskan', 'Dikerjakan', 'Dieskalasi']))->count() }}</span>
                </div>

                <div class="flex justify-between items-center p-3.5 bg-emerald-50/50 border border-emerald-100/50 rounded-xl">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center">
                            <i data-lucide="check-circle" class="w-4.5 h-4.5"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-700">Tiket Selesai Hari Ini</span>
                    </div>
                    <span class="text-lg font-extrabold text-emerald-700">{{ $tickets->filter(fn($t) => $t->tanggalSelesai === date('Y-m-d') && $t->status === 'Selesai')->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Report Table -->
    <div class="bg-white border border-[#e2e6ea] rounded-2xl shadow-xs overflow-hidden flex flex-col">
        <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-slate-50">
            <div>
                <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider flex items-center gap-1.5">
                    <i data-lucide="calendar" class="w-4 h-4 text-[#b26d27]"></i>
                    <span>Laporan Harian Tiket Pelayanan TI</span>
                </h3>
                <p class="text-[10px] text-gray-400 mt-0.5">Ringkasan harian tiket masuk, tiket selesai, dan tiket dalam pengerjaan.</p>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 text-gray-400 font-bold uppercase tracking-wider border-b border-gray-100 text-[10px]">
                        <th class="p-3.5 pl-5">Tanggal</th>
                        <th class="p-3.5 text-center">Tiket Masuk</th>
                        <th class="p-3.5 text-center">Sedang Dikerjakan (Aktif)</th>
                        <th class="p-3.5 text-center">Tiket Selesai</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                    @if(empty($dailyReports))
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-400 text-xs font-medium">
                                Belum ada data laporan harian.
                            </td>
                        </tr>
                    @else
                        @foreach($dailyReports as $report)
                            <tr class="hover:bg-slate-50/30 transition-colors">
                                <td class="p-3.5 pl-5 font-semibold text-gray-900">{{ $report['formatted'] }}</td>
                                <td class="p-3.5 text-center text-blue-600 font-bold font-mono">{{ $report['incoming'] }}</td>
                                <td class="p-3.5 text-center text-amber-600 font-bold font-mono">{{ $report['in_progress'] }}</td>
                                <td class="p-3.5 text-center text-emerald-600 font-bold font-mono">{{ $report['completed'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
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

        // 3. Initialize Line Chart for Daily Trend
        const trendData = @json($trendData);
        const trendLabels = trendData.map(d => d.formatted);
        const trendIncoming = trendData.map(d => d.incoming);
        const trendInProgress = trendData.map(d => d.in_progress);
        const trendCompleted = trendData.map(d => d.completed);

        const ctxTrend = document.getElementById('dailyTrendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [
                    {
                        label: 'Tiket Masuk',
                        data: trendIncoming,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        borderWidth: 2,
                        tension: 0.35,
                        fill: true
                    },
                    {
                        label: 'Sedang Dikerjakan',
                        data: trendInProgress,
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.05)',
                        borderWidth: 2,
                        tension: 0.35,
                        fill: true
                    },
                    {
                        label: 'Tiket Selesai',
                        data: trendCompleted,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.05)',
                        borderWidth: 2,
                        tension: 0.35,
                        fill: true
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
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 9,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
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
