<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Comment;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Pengguna Dashboard (Home / Main)
     */
    public function pengguna()
    {
        $tickets = Ticket::where('pengirimId', Auth::id())
            ->orderBy('tanggalUpdate', 'desc')
            ->get();

        return view('dashboards.pengguna', compact('tickets'));
    }

    /**
     * Pengguna Lapor Tiket Form
     */
    public function lapor()
    {
        return view('dashboards.lapor');
    }

    /**
     * Pengguna Tiket Saya List
     */
    public function tiketSaya()
    {
        $tickets = Ticket::where('pengirimId', Auth::id())
            ->orderBy('tanggalUpdate', 'desc')
            ->get();

        return view('dashboards.tiket', compact('tickets'));
    }

    /**
     * Pengguna Tiket Detail
     */
    public function tiketDetail()
    {
        $tickets = Ticket::where('pengirimId', Auth::id())
            ->orderBy('tanggalUpdate', 'desc')
            ->get();

        return view('dashboards.detail', compact('tickets'));
    }

    /**
     * Kasubbag Dashboard
     */
    public function kasubbag()
    {
        $user = Auth::user();
        $tickets = Ticket::where('kasubbagId', $user->subbagId)
            ->orderBy('tanggalUpdate', 'desc')
            ->get();

        $solvers = User::where('role', 'solver')
            ->where('subbagId', $user->subbagId)
            ->get();

        return view('dashboards.kasubbag', compact('tickets', 'solvers'));
    }

    /**
     * Solver Dashboard
     */
    public function solver()
    {
        $tickets = Ticket::where('solverId', Auth::id())
            ->orderBy('tanggalUpdate', 'desc')
            ->get();

        return view('dashboards.solver', compact('tickets'));
    }

    /**
     * Operator Dashboard - Overview
     */
    public function operator()
    {
        $tickets = Ticket::orderBy('tanggalUpdate', 'desc')->get();

        return view('dashboards.operator', compact('tickets'));
    }

    /**
     * Operator Dashboard - Semua Tiket
     */
    public function operatorTiket()
    {
        $tickets = Ticket::orderBy('tanggalUpdate', 'desc')->get();

        return view('dashboards.operator-tiket', compact('tickets'));
    }

    /**
     * Operator Dashboard - Analitik
     */
    public function operatorAnalitik()
    {
        $tickets = Ticket::all();

        return view('dashboards.operator-analitik', compact('tickets'));
    }

    // ==========================================
    // AJAX API ENDPOINTS
    // ==========================================

    /**
     * Get all tickets with comments for current user / dashboard
     */
    public function getTicketsApi()
    {
        $user = Auth::user();
        $query = Ticket::with('comments');

        if ($user->role === 'pengguna') {
            $query->where('pengirimId', $user->id);
        } elseif ($user->role === 'kasubbag') {
            $query->where('kasubbagId', $user->subbagId);
        } elseif ($user->role === 'solver') {
            $query->where(function ($q) use ($user) {
                $q->where('solverId', $user->id)
                  ->orWhere(function ($q2) use ($user) {
                      $q2->where('kasubbagId', $user->subbagId)
                         ->where(function ($q3) {
                             $q3->whereNull('solverId')
                                ->orWhere('solverId', '');
                         })
                         ->whereNotIn('status', ['Selesai', 'Kembalikan tiket ke operator']);
                  });
            });
        }

        $tickets = $query->orderBy('tanggalUpdate', 'desc')->get();

        return response()->json($tickets);
    }

    /**
     * Create new ticket
     */
    public function createTicketApi(Request $request)
    {
        $request->validate([
            'jenis' => 'nullable|string',
            'layananKategori' => 'required|string',
            'layananSub' => 'required|string',
            'layanan' => 'nullable|string',
            'detail' => 'required|string',
        ]);

        $user = Auth::user();
        $subbagMaster = [
            'k1' => 'Subbagian Pengelolaan Infrastruktur dan Jaringan',
            'k2' => 'Subbagian Pelayanan TIK',
            'k3' => 'Subbagian Pengembangan Sistem Informasi Pemeriksaan',
            'k4' => 'Subbagian Pengembangan Sistem Informasi Kelembagaan',
            'k5' => 'Subbagian Sains Data',
            'k6' => 'Subbagian Tata Kelola Data',
            'k7' => 'Subbagian Keamanan Informasi',
            'k8' => 'Subbagian MIOT',
        ];

        $subbagRouting = [
            'Layanan Identitas' => 'k2',
            'Layanan Data' => 'k6',
            'Layanan Aplikasi' => 'k3',
            'Layanan Teknologi' => 'k1',
            'Layanan Perangkat' => 'k2',
            'Layanan Dukungan TI Untuk Kegiatan Khusus' => 'k2',
            'Layanan Informasi' => 'k8',
            'Layanan TTE' => 'k7',
            'Layanan Segel Elektronik' => 'k7',
            'Layanan MFA' => 'k7',
            'Layanan Sistem Layanan Data' => 'k5',
            'Aplikasi Kelembagaan' => 'k4',
            'Aplikasi Pendukung' => 'k4',
            'Aplikasi Kolaborasi' => 'k2',
            'Layanan Survei' => 'k2',
        ];

        $category = $request->layananKategori;
        $sub = $request->layananSub;
        $layanan = $request->layanan ?: $sub;

        // Route dynamically
        $subbagId = $subbagRouting[$sub] ?? $subbagRouting[$category] ?? 'k2';
        $subbagName = $subbagMaster[$subbagId] ?? 'Subbagian Pelayanan TIK';

        $kasubbagUser = User::where('role', 'kasubbag')->where('subbagId', $subbagId)->first();
        $kasubbagName = $kasubbagUser ? $kasubbagUser->name : "Kasubbag $subbagName";

        $year = date('Y');
        $count = Ticket::count() + 1;
        $ticketId = "TKT-$year-" . str_pad($count, 3, '0', STR_PAD_LEFT);

        $now = date('Y-m-d H:i');

        $ticket = Ticket::create([
            'id' => $ticketId,
            'pengirimId' => $user->id,
            'pengirimName' => $user->name,
            'jenis' => $request->jenis ?? 'Layanan',
            'layananKategori' => $category,
            'layananSub' => $sub,
            'layanan' => $layanan,
            'detail' => $request->detail,
            'tanggal' => date('Y-m-d'),
            'tanggalUpdate' => $now,
            'kasubbagId' => $subbagId,
            'kasubbagName' => $kasubbagName,
            'status' => 'Pending',
        ]);

        // Tambahkan komentar sistem otomatis
        Comment::create([
            'id' => 'cmt-' . microtime(true),
            'ticketId' => $ticketId,
            'authorId' => $user->id,
            'authorName' => $user->name,
            'authorRole' => $user->role,
            'text' => "Tiket baru berhasil diajukan dengan kategori \"$category\" → \"$sub\" → \"$layanan\". Otomatis diteruskan ke $subbagName.",
            'timestamp' => $now,
            'type' => 'sistem',
        ]);

        // Kirim notifikasi ke semua solver di subbagian terkait
        $solvers = User::where('role', 'solver')->where('subbagId', $subbagId)->get();
        foreach ($solvers as $solver) {
            Notification::create([
                'user_id' => $solver->id,
                'ticket_id' => $ticketId,
                'title' => 'Tiket Baru Tersedia',
                'message' => "Tiket baru {$ticketId} ({$layanan}) tersedia untuk diambil di subbagian Anda.",
            ]);
        }

        // Kirim notifikasi ke semua kasubbag di subbagian terkait
        $kasubbags = User::where('role', 'kasubbag')->where('subbagId', $subbagId)->get();
        foreach ($kasubbags as $kb) {
            Notification::create([
                'user_id' => $kb->id,
                'ticket_id' => $ticketId,
                'title' => 'Tiket Baru Tersedia',
                'message' => "Tiket baru {$ticketId} ({$layanan}) tersedia untuk diambil di subbagian Anda.",
            ]);
        }

        return response()->json(['success' => true, 'id' => $ticketId]);
    }

    /**
     * Memperbarui status tiket dan memproses aksi (terima, tugaskan, selesaikan, eskalasi, tolak)
     */
    public function updateTicketActionApi(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $now = date('Y-m-d H:i');

        $oldStatus = $ticket->status;
        $oldSolverId = $ticket->solverId;
        $oldKasubbagId = $ticket->kasubbagId;

        $ticket->update([
            'status' => $request->status ?? $ticket->status,
            'kasubbagId' => $request->kasubbagId ?? $ticket->kasubbagId,
            'kasubbagName' => $request->kasubbagName ?? $ticket->kasubbagName,
            'solverId' => $request->solverId ?? $ticket->solverId,
            'solverName' => $request->solverName ?? $ticket->solverName,
            'alasanTolak' => $request->alasanTolak ?? $ticket->alasanTolak,
            'catatanKasubbag' => $request->catatanKasubbag ?? $ticket->catatanKasubbag,
            'tanggalSelesai' => $request->tanggalSelesai ?? $ticket->tanggalSelesai,
            'tanggalUpdate' => $now,
        ]);

        $newStatus = $ticket->status;
        $newSolverId = $ticket->solverId;
        $newKasubbagId = $ticket->kasubbagId;

        // Hapus notifikasi 'Tiket Belum Diambil' jika sudah ditugaskan, dialihkan, selesai, atau dikembalikan ke operator
        if (!empty($newSolverId) || ($newKasubbagId !== $oldKasubbagId) || in_array($newStatus, ['Selesai', 'Kembalikan tiket ke operator'])) {
            Notification::where('ticket_id', $ticket->id)
                ->where('title', 'Tiket Belum Diambil')
                ->delete();
        }

        // 1. Kirim notifikasi ke Pelapor ketika status tiket berubah
        if ($newStatus !== $oldStatus) {
            $isOldActive = in_array($oldStatus, ['Diterima', 'Ditugaskan', 'Dikerjakan', 'Dieskalasi']);
            $isNewActive = in_array($newStatus, ['Diterima', 'Ditugaskan', 'Dikerjakan', 'Dieskalasi']);

            if ($isNewActive && !$isOldActive) {
                Notification::create([
                    'user_id' => $ticket->pengirimId,
                    'ticket_id' => $ticket->id,
                    'title' => 'Tiket Diproses',
                    'message' => "Tiket Anda dengan ID {$ticket->id} ({$ticket->layanan}) saat ini sedang diproses dengan status: {$newStatus}.",
                ]);
            } elseif ($newStatus === 'Selesai' && $oldStatus !== 'Selesai') {
                Notification::create([
                    'user_id' => $ticket->pengirimId,
                    'ticket_id' => $ticket->id,
                    'title' => 'Tiket Selesai',
                    'message' => "Tiket Anda dengan ID {$ticket->id} ({$ticket->layanan}) telah selesai ditangani.",
                ]);
            }
        }

        // 2. Kirim notifikasi ke Solver saat ditugaskan
        if (!empty($newSolverId) && ($oldSolverId !== $newSolverId || ($oldStatus !== $newStatus && in_array($newStatus, ['Ditugaskan', 'Dikerjakan'])))) {
            Notification::create([
                'user_id' => $newSolverId,
                'ticket_id' => $ticket->id,
                'title' => 'Tugas Baru Ditugaskan',
                'message' => "Anda telah ditugaskan untuk menangani tiket {$ticket->id} ({$ticket->layanan}).",
            ]);
        }

        // 3. Kirim notifikasi ke semua Solver jika tiket didelegasikan kembali (bisa diambil kembali)
        if (empty($newSolverId) && !empty($newKasubbagId) && (!empty($oldSolverId) || $newStatus === 'Dieskalasi')) {
            $solvers = User::where('role', 'solver')->where('subbagId', $newKasubbagId)->get();
            foreach ($solvers as $solver) {
                Notification::create([
                    'user_id' => $solver->id,
                    'ticket_id' => $ticket->id,
                    'title' => 'Tiket Tersedia Kembali',
                    'message' => "Tiket {$ticket->id} ({$ticket->layanan}) dikembalikan/dieskalasi dan kini tersedia untuk diambil.",
                ]);
            }
        }

        if ($request->has('comment')) {
            $commentData = $request->comment;
            Comment::create([
                'id' => $commentData['id'] ?? ('cmt-' . microtime(true)),
                'ticketId' => $id,
                'authorId' => $commentData['authorId'] ?? Auth::id(),
                'authorName' => $commentData['authorName'] ?? Auth::user()->name,
                'authorRole' => $commentData['authorRole'] ?? Auth::user()->role,
                'text' => $commentData['text'],
                'timestamp' => $now,
                'type' => $commentData['type'] ?? 'komentar',
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Add comment to ticket
     */
    public function addCommentApi(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|array',
            'comment.text' => 'required|string',
        ]);

        $commentData = $request->comment;
        $now = date('Y-m-d H:i');

        Comment::create([
            'id' => $commentData['id'] ?? ('cmt-' . microtime(true)),
            'ticketId' => $id,
            'authorId' => Auth::id(),
            'authorName' => Auth::user()->name,
            'authorRole' => Auth::user()->role,
            'text' => $commentData['text'],
            'timestamp' => $now,
            'type' => $commentData['type'] ?? 'komentar',
        ]);

        Ticket::where('id', $id)->update(['tanggalUpdate' => $now]);

        return response()->json(['success' => true]);
    }

    /**
     * Gemini AI Recommendation
     */
    public function chatRecommendApi(Request $request)
    {
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json([
                'error' => 'API Key Gemini belum dikonfigurasi di server Laravel. Silakan tambahkan GEMINI_API_KEY ke file .env Anda.',
            ], 500);
        }

        $messages = $request->messages;
        if (!is_array($messages)) {
            return response()->json(['error' => 'messages array is required'], 400);
        }

        // Count existing AI chat bubbles in history
        $aiBubbleCount = 0;
        foreach ($messages as $msg) {
            if ($msg['sender'] === 'bot') {
                $aiBubbleCount++;
            }
        }

        // Format history for Gemini API
        $contents = [];
        foreach ($messages as $msg) {
            $contents[] = [
                'role' => $msg['sender'] === 'user' ? 'user' : 'model',
                'parts' => [['text' => $msg['text']]],
            ];
        }

        $catalogGuide = '
1. Kategori: "Layanan Identitas"
   - Sub-Layanan: "Layanan Akun"
     * Items: "Pembuatan Akun Baru Portal BPK", "Reset Password / Masalah Login", "Perubahan Hak Akses Aplikasi", "Penghapusan / Penonaktifan Akun Pegawai"
   - Sub-Layanan: "Layanan TTE"
     * Items: "Registrasi Sertifikat TTE Baru", "Perpanjangan Masa Aktif TTE", "Pencabutan Sertifikat TTE", "Troubleshooting Tanda Tangan Elektronik Gagal"
   - Sub-Layanan: "Layanan Segel Elektronik"
     * Items: "Penerbitan Segel Baru Instansi", "Perpanjangan Masa Aktif Segel", "Masalah Verifikasi Segel Elektronik"
   - Sub-Layanan: "Layanan Email"
     * Items: "Pembuatan Email Baru @bpk.go.id", "Reset Password Email Dinas", "Masalah Kuota Email Penuh", "Konfigurasi Mail Client (Outlook/Thunderbird/HP)"
   - Sub-Layanan: "Layanan MFA"
     * Items: "Registrasi Multi-Factor Authentication Baru", "Reset Token MFA / Google Authenticator", "Masalah Sinkronisasi Waktu MFA"

2. Kategori: "Layanan Data"
   - Sub-Layanan: "Pengelolaan Data"
     * Items: "Perencanaan Data", "Pengumpulan Data", "Pengolahan Data", "Penyimpanan Data", "Penyebarluasan Data", "Analisis Data", "Pengamanan Data", "Pemusnahan Data"
   - Sub-Layanan: "Layanan Sistem Layanan Data"
     * Items: "BIDICS Dashboard", "BIDICS-SSA"

3. Kategori: "Layanan Aplikasi"
   - Sub-Layanan: "Pengembangan Aplikasi"
     * Items: "Permintaan Fitur Baru Aplikasi", "Pelaporan Bug / Error Aplikasi", "Uji Coba / Testing Aplikasi Baru", "Integrasi API Antar Aplikasi BPK"
   - Sub-Layanan: "Aplikasi Pemeriksaan"
     * Items: "SiAP-BPK (Sistem Informasi Pemeriksaan)", "Aplikasi E-Audit Pemeriksaan Pusat", "Aplikasi Kertas Kerja Pemeriksaan (KKP)", "Masalah Sinkronisasi Offline SiAP-BPK"
   - Sub-Layanan: "Aplikasi Kelembagaan"
     * Items: "Aplikasi Kepegawaian (SISDM BPK)", "Aplikasi Keuangan (SIKAD BPK)", "Aplikasi Persuratan Dinas (E-Office)", "Aplikasi Perjalanan Dinas Pegawai"
   - Sub-Layanan: "Aplikasi Pendukung"
     * Items: "Aplikasi Manajemen Risiko Biro TI", "Aplikasi Helpdesk Biro TI", "Aplikasi Presensi Pegawai BPK"
   - Sub-Layanan: "Aplikasi Kolaborasi"
     * Items: "Microsoft Teams BPK", "BPK Cloud Storage (Nextcloud)", "Aplikasi Survei Internal BPK"
   - Sub-Layanan: "Layanan Survei"
     * Items: "Pembuatan Kuesioner Baru", "Analisis Hasil Survei Internal", "Export Data Survei Pegawai"

4. Kategori: "Layanan Teknologi"
   - Sub-Layanan: "Layanan Intranet"
     * Items: "Pembuatan Local Area Network (LAN)", "Pengaturan konfigurasi LAN", "Penonaktifan LAN", "Penyediaan kabel LAN", "Pemasangan perangkat Wireless Fidelity (Wifi)", "Pengaturan konfigurasi Wifi", "Penonaktifan Wifi"
   - Sub-Layanan: "Layanan Internet"
     * Items: "Pemasangan perangkat koneksi internet", "Pengaturan konfigurasi perangkat koneksi internet", "Penonaktifan perangkat koneksi internet"
   - Sub-Layanan: "Layanan Virtual Private Network"
     * Items: "Pemasangan VPN", "Pengaturan konfigurasi VPN", "Penonaktifan VPN"
   - Sub-Layanan: "Layanan Hosting"
     * Items: "Pendaftaran hosting subdomain", "Pengaturan konfigurasi hosting subdomain", "Penonaktifan hosting subdomain"

5. Kategori: "Layanan Perangkat"
   - Sub-Layanan: "Standarisasi Perangkat Komputer"
     * Items: "Konsultasi Spesifikasi PC/Laptop", "Verifikasi Kelayakan Perangkat Lama", "Instalasi OS Standar BPK RI"
   - Sub-Layanan: "Pemeliharaan Perangkat"
     * Items: "Pembersihan Hardware PC/Laptop", "Perbaikan Kerusakan Fisik Laptop Dinas", "Instalasi Antivirus / Scan Malware Perangkat"
   - Sub-Layanan: "Peminjaman Perangkat"
     * Items: "Peminjaman Laptop Rapat Paripurna", "Peminjaman Projector / Proyektor", "Peminjaman Sound System", "Pengembalian Perangkat Pinjaman"
   - Sub-Layanan: "Penyediaan Barang Persediaan"
     * Items: "Penyediaan Toner / Tinta Printer Biro", "Penyediaan Mouse / Keyboard Baru", "Penyediaan Kabel Konektor Display / HDMI"

6. Kategori: "Layanan Dukungan TI Untuk Kegiatan Khusus"
   - Sub-Layanan: "Pendampingan Personel TI"
     * Items: "Pendampingan Sidang / Rapat Pleno", "Pendampingan Pemeriksaan Lapangan (On-Site Audit)", "Pendampingan Diklat / Pelatihan TIK", "Dukungan TI Acara Nasional BPK"

7. Kategori: "Layanan Informasi"
   - Sub-Layanan: "Knowledge Base Produk TI"
     * Items: "Permintaan User Manual SiAP", "Permintaan Video Panduan Aplikasi", "FAQ Portal Layanan TI BPK"
   - Sub-Layanan: "Informasi Produk TI"
     * Items: "Katalog Layanan Biro TI Terbaru", "Spesifikasi Hardware Terbaru Standard BPK", "Status Rilis Aplikasi Baru Biro TI"
   - Sub-Layanan: "Tugas dan Fungsi Biro TI"
     * Items: "Struktur Organisasi Biro TI Pusat", "SOP Pelayanan Layanan TI BPK", "Uraian Tugas Subbagian TI"
';

        $systemInstruction = "Anda adalah Asisten Virtual Layanan TI BPK RI (Badan Pemeriksa Keuangan Republik Indonesia).
Tugas utama Anda adalah membantu pengguna (pegawai BPK) menyelesaikan masalah TI mereka secara ramah dan solutif (problem solving) terlebih dahulu.

Saat ini, percakapan telah memiliki {$aiBubbleCount} bubble chat dari AI.

ATURAN TENTANG REKOMENDASI TIKET:
1. Jika jumlah bubble chat dari AI SAAT INI kurang dari 5 (saat ini: {$aiBubbleCount} bubble):
   - Anda DILARANG KERAS memberikan saran pembuatan tiket atau rekomendasi katalog tiket. Objek 'recommendation' di JSON wajib bernilai null.
   - Fokus sepenuhnya untuk memberikan panduan solusi/troubleshooting untuk menyelesaikan masalah pengguna secara langsung.
   - Jika Anda merasa panduan solusi telah selesai diberikan dan masalah mungkin sudah teratasi, tanyakan secara eksplisit kepada pengguna untuk memastikan apakah masalahnya sudah benar-benar selesai (solve).

2. Jika jumlah bubble chat dari AI SAAT INI sudah 5 atau lebih (saat ini: {$aiBubbleCount} bubble):
   - Jika masalah pengguna belum terselesaikan setelah Anda memandu mereka, Anda wajib merekomendasikan pembuatan tiket berdasarkan Katalog Layanan TI BPK RI berikut:
   $catalogGuide
   
   - Dalam kasus ini, isi objek 'recommendation' dengan kategori, sub, dan service yang tepat sesuai katalog di atas.
   - Namun, jika masalah pengguna sudah berhasil diselesaikan (atau pengguna mengonfirmasi sudah solve), jangan merekomendasikan tiket (isi objek 'recommendation' dengan null).

Format respons Anda harus SELALU berupa objek JSON yang valid dengan struktur berikut:
{
  \"reply\": \"Jawaban solusi, sapaan, panduan troubleshooting, atau pertanyaan konfirmasi Anda dalam Bahasa Indonesia yang ramah dan profesional.\",
  \"recommendation\": {
    \"category\": \"Nama Kategori Level 1\",
    \"sub\": \"Nama Sub-Layanan Level 2\",
    \"service\": \"Nama Detail Layanan Level 3\",
    \"confidence\": \"Tinggi\" | \"Sedang\" | \"Rendah\",
    \"score\": 5
  }
}

Or jika tidak menyarankan tiket:
{
  \"reply\": \"Jawaban solusi, panduan troubleshooting, atau pertanyaan konfirmasi Anda dalam Bahasa Indonesia yang ramah dan profesional.\",
  \"recommendation\": null
}";

        $models = [
            'gemini-3.5-flash',
            'gemini-2.5-flash',
            'gemini-2.5-flash-lite'
        ];
        $maxRetries = 2;
        $retryDelay = 1; // seconds
        $response = null;
        $lastError = null;

        try {
            foreach ($models as $model) {
                $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . $apiKey;

                $payload = [
                    'contents' => $contents,
                    'systemInstruction' => [
                        'parts' => [['text' => $systemInstruction]]
                    ],
                    'generationConfig' => [
                        'responseMimeType' => 'application/json',
                        'responseSchema' => [
                            'type' => 'OBJECT',
                            'properties' => [
                                'reply' => [
                                    'type' => 'STRING',
                                    'description' => 'Jawaban solusi, sapaan, panduan troubleshooting, atau pertanyaan konfirmasi Anda dalam Bahasa Indonesia yang ramah dan profesional.'
                                ],
                                'recommendation' => [
                                    'type' => 'OBJECT',
                                    'nullable' => true,
                                    'properties' => [
                                        'category' => [
                                            'type' => 'STRING',
                                            'description' => 'Nama Kategori Level 1 dari Katalog Layanan'
                                        ],
                                        'sub' => [
                                            'type' => 'STRING',
                                            'description' => 'Nama Sub-Layanan Level 2 dari Katalog Layanan'
                                        ],
                                        'service' => [
                                            'type' => 'STRING',
                                            'description' => 'Nama Detail Layanan Level 3 dari Katalog Layanan'
                                        ],
                                        'confidence' => [
                                            'type' => 'STRING',
                                            'enum' => ['Tinggi', 'Sedang', 'Rendah']
                                        ],
                                        'score' => [
                                            'type' => 'INTEGER'
                                        ]
                                    ],
                                    'required' => ['category', 'sub', 'service', 'confidence']
                                ]
                            ],
                            'required' => ['reply']
                        ]
                    ]
                ];

                for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
                    try {
                        $response = Http::post($apiUrl, $payload);

                        if ($response->successful()) {
                            $data = $response->json();
                            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? '{}';
                            
                            // Clean up markdown code block wrappers if present
                            $text = trim($text);
                            if (strpos($text, '```') === 0) {
                                $text = preg_replace('/^```(?:json)?\s*|\s*```$/s', '', $text);
                            }
                            $text = trim($text);

                            $result = json_decode($text, true);

                            // Enforce rule programmatically: no recommendations before 5 AI bubbles (4 in history + 1 being generated)
                            if ($result && $aiBubbleCount < 4) {
                                $result['recommendation'] = null;
                            }

                            return response()->json($result);
                        }

                        $lastError = $response->body();
                        $status = $response->status();

                        // If it is 503 (Unavailable) or 429 (Resource Exhausted), wait and retry
                        if ($status === 503 || $status === 429) {
                            Log::warning("Gemini API ({$model}) returned status {$status}, retrying in {$retryDelay}s (attempt {$attempt}/{$maxRetries})...");
                            sleep($retryDelay);
                            continue;
                        }

                        break;
                    } catch (\Exception $e) {
                        $lastError = $e->getMessage();
                        Log::warning("Gemini API ({$model}) request exception, retrying: " . $e->getMessage());
                        sleep($retryDelay);
                    }
                }
            }

            Log::error("Gemini API Request Failed after fallback models", ['last_error' => $lastError]);
            return response()->json([
                'error' => 'Gagal memproses AI Chatbot setelah mencoba beberapa model.',
                'details' => $lastError
            ], 500);

        } catch (\Exception $e) {
            Log::error("Gemini API Exception", ['msg' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan sistem saat memproses AI Chatbot.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function getNotificationsApi()
    {
        $user = Auth::user();

        // Jika user adalah kasubbag atau solver, cek apakah ada tiket di subbagian mereka yang belum diambil
        if ($user && in_array($user->role, ['kasubbag', 'solver']) && !empty($user->subbagId)) {
            $unassignedTickets = Ticket::where('kasubbagId', $user->subbagId)
                ->where(function ($q) {
                    $q->whereNull('solverId')->orWhere('solverId', '');
                })
                ->whereNotIn('status', ['Selesai', 'Kembalikan tiket ke operator'])
                ->get();

            foreach ($unassignedTickets as $ticket) {
                // Pastikan notifikasi 'Tiket Belum Diambil' untuk tiket ini belum pernah dibuat untuk user ini
                $exists = Notification::where('user_id', $user->id)
                    ->where('ticket_id', $ticket->id)
                    ->where('title', 'Tiket Belum Diambil')
                    ->exists();

                if (!$exists) {
                    Notification::create([
                        'user_id' => $user->id,
                        'ticket_id' => $ticket->id,
                        'title' => 'Tiket Belum Diambil',
                        'message' => "Tiket {$ticket->id} ({$ticket->layananSub}) belum diambil oleh solver.",
                        'is_read' => false,
                    ]);
                }
            }
        }

        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get();
        return response()->json($notifications);
    }

    public function markNotificationsReadApi()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->where('title', '!=', 'Tiket Belum Diambil')
            ->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function getSolversBusyStatusApi()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([], 401);
        }

        $subbagId = $user->subbagId;
        $solvers = User::where('role', 'solver')
            ->where('subbagId', $subbagId)
            ->get();

        $today = date('Y-m-d');
        $result = [];

        foreach ($solvers as $solver) {
            $count = Ticket::where('solverId', $solver->id)
                ->whereHas('comments', function($q) use ($solver, $today) {
                    $q->where('type', 'penugasan')
                      ->where('timestamp', 'like', $today . '%')
                      ->where(function($q2) use ($solver) {
                          $q2->where('text', "Tiket ditugaskan kepada solver: {$solver->name}.")
                             ->orWhere('text', "Tiket ditugaskan kepada solver: {$solver->name} dan mulai dikerjakan.")
                             ->orWhere('text', "Tiket diambil secara mandiri oleh Solver: {$solver->name}.")
                             ->orWhere('text', "Tiket diambil secara mandiri dan mulai dikerjakan oleh Solver: {$solver->name}.");
                      });
                })
                ->count();

            if ($count >= 3) {
                $level = 'Hi';
            } elseif ($count >= 2) {
                $level = 'Med';
            } else {
                $level = 'Low';
            }

            $result[] = [
                'id' => $solver->id,
                'name' => $solver->name,
                'assigned_today' => $count,
                'busy_level' => $level,
            ];
        }

        return response()->json($result);
    }
}
