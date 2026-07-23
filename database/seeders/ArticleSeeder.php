<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing articles first to avoid duplication
        Article::truncate();

        $articles = [
            // LAYANAN IDENTITAS
            [
                'title' => 'Bagaimana cara mendaftarkan identitas digital saya?',
                'category' => 'Layanan Identitas',
                'subcategory' => 'Layanan Akun',
                'likes' => 22224,
                'content' => '
                    <p>Untuk mendaftarkan identitas digital Anda pada sistem Melati, ikuti petunjuk berikut:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Persiapan Dokumen:</strong> Pastikan Anda telah memiliki e-KTP dan email resmi BPK RI aktif.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Akses Portal:</strong> Kunjungi halaman registrasi mandiri melalui menu utama.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Verifikasi Wajah:</strong> Lakukan verifikasi e-KTP dan foto wajah secara langsung menggunakan kamera.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Aktivasi:</strong> Klik tautan aktivasi yang dikirimkan ke email Anda untuk menyelesaikan pendaftaran.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(10),
                'updated_at' => now()->subMonths(10),
            ],
            [
                'title' => 'Siapa saja yang berhak menggunakan layanan identitas ini?',
                'category' => 'Layanan Identitas',
                'subcategory' => 'Layanan Akun',
                'likes' => 763,
                'content' => '
                    <p>Layanan identitas digital Melati ditujukan khusus untuk kalangan internal BPK RI:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Seluruh Pegawai Negeri Sipil (PNS) di lingkungan BPK RI.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) BPK RI.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Tenaga Kontrak / Solver internal yang terdaftar resmi di Biro TIK.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(4),
                'updated_at' => now()->subMonths(4),
            ],
            [
                'title' => 'Bagaimana cara memeriksa status pendaftaran akun saya?',
                'category' => 'Layanan Identitas',
                'subcategory' => 'Layanan Akun',
                'likes' => 457,
                'content' => '
                    <p>Untuk mengetahui status pengajuan akun atau pendaftaran layanan Anda:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Silakan masuk ke halaman utama Portal Melati.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Periksa tab <strong>Notifikasi</strong> pada pojok kanan atas untuk melihat update persetujuan admin.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Hubungi operator helpdesk melalui fitur chat jika status tetap menggantung lebih dari 1x24 jam.</span></li>
                    </ul>
                ',
                'created_at' => now()->subYears(2),
                'updated_at' => now()->subYears(2),
            ],
            [
                'title' => 'Apa yang harus dilakukan jika verifikasi identitas gagal?',
                'category' => 'Layanan Identitas',
                'subcategory' => 'Layanan Akun',
                'likes' => 1284,
                'content' => '
                    <p>Jika verifikasi identitas Anda gagal, berikut langkah yang perlu dilakukan:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Periksa penyebab kegagalan:</strong> Foto buram, data tidak sesuai e-KTP, atau koneksi tidak stabil.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Langkah perbaikan:</strong> Ulangi proses verifikasi dengan pencahayaan yang cukup, pastikan seluruh bagian e-KTP terlihat jelas, dan gunakan koneksi internet stabil. Jika 3 kali tetap gagal, buat tiket bantuan di helpdesk.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(3),
                'updated_at' => now()->subMonths(3),
            ],
            [
                'title' => 'Cara mendaftarkan Sertifikat TTE Dinas (Tanda Tangan Elektronik)',
                'category' => 'Layanan Identitas',
                'subcategory' => 'Layanan TTE (Tanda Tangan Elektronik)',
                'likes' => 1829,
                'content' => '
                    <p>Sertifikat TTE Dinas BPK diterbitkan bekerja sama dengan BSrE (Balai Sertifikasi Elektronik):</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Pengajuan:</strong> Ajukan registrasi melalui Portal TTE Dinas dengan mengisi NIP, unit kerja, dan mengunggah SK Jabatan atau Surat Tugas resmi.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Verifikasi Data:</strong> Verifikator Biro TIK akan memvalidasi data Anda dan mengirimkan email link set-passphrase dari BSrE.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Aktivasi Passphrase:</strong> Klik link tersebut, buat passphrase TTE Anda (jaga kerahasiaannya), dan unduh aplikasi pendukung TTE.</span></li>
                    </ul>
                ',
                'created_at' => now()->subWeeks(2),
                'updated_at' => now()->subWeeks(2),
            ],
            [
                'title' => 'Panduan Penggunaan Segel Elektronik Instansi',
                'category' => 'Layanan Identitas',
                'subcategory' => 'Layanan Segel Elektronik',
                'likes' => 340,
                'content' => '
                    <p>Segel Elektronik digunakan untuk menjamin keaslian dokumen resmi yang diterbitkan secara otomatis oleh sistem aplikasi BPK:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Hak Akses:</strong> Hanya diberikan kepada admin sistem aplikasi satker yang berwenang.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Integrasi API:</strong> Hubungi Biro TIK Subbagian Keamanan Informasi untuk mendapatkan API Key dan integrasi library segel elektronik ke dalam aplikasi satker Anda.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ],
            [
                'title' => 'Konfigurasi Email BPK di Outlook, Android, dan iOS',
                'category' => 'Layanan Identitas',
                'subcategory' => 'Layanan Email',
                'likes' => 4102,
                'content' => '
                    <p>Panduan setting email resmi BPK (@bpk.go.id) pada aplikasi email client:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Outlook Desktop:</strong> Tambahkan akun baru -> masukkan email BPK -> pilih Exchange / Microsoft 365 -> ikuti login Single Sign-On (SSO) BPK.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Perangkat Mobile (Outlook App):</strong> Instal aplikasi Microsoft Outlook dari Play Store/App Store -> Masukkan email -> Autentikasi dengan OTP MFA Anda.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ],
            [
                'title' => 'Registrasi Token MFA (Multi-Factor Authentication)',
                'category' => 'Layanan Identitas',
                'subcategory' => 'Layanan MFA (Multi-Factor Authentication)',
                'likes' => 9450,
                'content' => '
                    <p>Otentikasi Dua Faktor (MFA) wajib digunakan untuk seluruh akses sistem informasi kritis BPK RI:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Instalasi Authenticator:</strong> Unduh Google Authenticator atau Microsoft Authenticator di ponsel Anda.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Hubungkan Akun:</strong> Login ke portal profil BPK, pilih menu keamanan MFA, scan kode QR yang tampil menggunakan aplikasi authenticator di ponsel Anda, lalu masukkan 6 digit angka verifikasi yang muncul.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(3),
                'updated_at' => now()->subMonths(3),
            ],

            // LAYANAN DATA
            [
                'title' => 'Alur Pengajuan Rencana Kebutuhan Data Pemeriksaan',
                'category' => 'Layanan Data',
                'subcategory' => 'Perencanaan Data',
                'likes' => 512,
                'content' => '
                    <p>Sebelum melakukan pemeriksaan, tim pemeriksa harus mengajukan rencana kebutuhan data:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Masuk ke aplikasi perencanaan data pemeriksaan BPK.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Isi daftar entitas pemeriksaan, daftar tabel/informasi data yang dibutuhkan, serta estimasi waktu penggunaan data.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Ajukan persetujuan ke Ketua Tim (Katim) dan Pengendali Teknis (PT) untuk diteruskan ke Biro TI Satker Pengelola Data.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(2),
                'updated_at' => now()->subMonths(2),
            ],
            [
                'title' => 'Cara Melakukan Pengumpulan Data E-Audit BPK',
                'category' => 'Layanan Data',
                'subcategory' => 'Pengumpulan Data',
                'likes' => 891,
                'content' => '
                    <p>Pengumpulan data dari entitas pemeriksaan dilakukan secara elektronik melalui portal E-Audit BPK:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Kirimkan link unggah data e-audit resmi kepada kontak entitas yang berwenang.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Gunakan jalur VPN aman jika pengiriman data dilakukan secara real-time / database-to-database link.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Semua file data yang masuk akan otomatis dipindai oleh sistem antivirus e-audit.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ],
            [
                'title' => 'Standarisasi Pengolahan Data untuk Pemeriksa',
                'category' => 'Layanan Data',
                'subcategory' => 'Pengolahan Data',
                'likes' => 344,
                'content' => '
                    <p>Setiap data mentah (raw data) yang diperoleh dari entitas harus diolah sesuai standar agar siap dianalisis:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Lakukan data cleansing (pembersihan data) dari duplikasi dan format yang tidak seragam menggunakan software pengolah data resmi.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Dokumentasikan skrip atau alur query pengolahan data Anda sebagai kertas kerja audit (KKA) digital.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(5),
                'updated_at' => now()->subMonths(5),
            ],
            [
                'title' => 'Prosedur Backup dan Penyimpanan Data di Storage BPK',
                'category' => 'Layanan Data',
                'subcategory' => 'Penyimpanan Data',
                'likes' => 622,
                'content' => '
                    <p>Penyimpanan data pemeriksaan yang aman dan terpusat disediakan pada Storage Network BPK:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Simpan dokumen kerja Anda di Cloud Storage BPK (Nextcloud internal) atau folder bersama (Shared Folder Network) satker Anda.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Sistem melakukan backup berkala secara harian (incremental backup) dan mingguan (full backup) ke Data Center cadangan (DRC).</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(6),
                'updated_at' => now()->subMonths(6),
            ],
            [
                'title' => 'Aturan Berbagi Data (Data Sharing) Antar Satker',
                'category' => 'Layanan Data',
                'subcategory' => 'Penyebarluasan Data',
                'likes' => 198,
                'content' => '
                    <p>Pertukaran data antar Satuan Kerja BPK RI diatur dengan ketat demi menjaga kerahasiaan negara:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Gunakan platform transfer file internal (seperti portal berkirim berkas terenkripsi BPK) daripada media eksternal (Google Drive/WhatsApp).</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pastikan penerima data telah mengisi formulir NDA (Non-Disclosure Agreement) data dinas jika data yang dibagikan bersifat rahasia/sangat rahasia.</span></li>
                    </ul>
                ',
                'created_at' => now()->subYear(),
                'updated_at' => now()->subYear(),
            ],
            [
                'title' => 'Panduan Menggunakan Software Analisis Data di BPK',
                'category' => 'Layanan Data',
                'subcategory' => 'Analisis Data',
                'likes' => 725,
                'content' => '
                    <p>Biro TI memfasilitasi lisensi software analisis data (seperti ACL, IDEA, Python, R, dan Tableau) untuk menunjang audit:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Instalasi Lisensi:</strong> Ajukan permohonan instalasi berlisensi melalui helpdesk Melati dengan melampirkan Surat Tugas Pemeriksaan yang relevan.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Pelatihan:</strong> Akses modul e-learning analisis data di platform LMS BPK untuk tutorial penggunaan lanjutan.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(8),
                'updated_at' => now()->subMonths(8),
            ],
            [
                'title' => 'Klasifikasi Data Sensitif dan Enkripsi File Pemeriksaan',
                'category' => 'Layanan Data',
                'subcategory' => 'Pengamanan Data',
                'likes' => 1455,
                'content' => '
                    <p>Semua file Kertas Kerja Pemeriksaan (KKP) yang mengandung data sensitif wajib diamankan:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Enkripsi File:</strong> Gunakan software kompresi berstandar (seperti 7-Zip) dengan password AES-256 sebelum mengirimkan file melalui jaringan publik.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Klasifikasi Data:</strong> Bedakan data menjadi kategori Publik, Terbatas, Rahasia, dan Sangat Rahasia. Ikuti panduan penanganan tiap klasifikasi sesuai keputusan Kepala Biro TI.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(3),
                'updated_at' => now()->subMonths(3),
            ],
            [
                'title' => 'SOP Pemusnahan Data Digital dan Media Penyimpanan',
                'category' => 'Layanan Data',
                'subcategory' => 'Pemusnahan Data',
                'likes' => 120,
                'content' => '
                    <p>Pemusnahan file atau media penyimpanan fisik yang tidak lagi terpakai diatur secara resmi:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Data Digital:</strong> Penghapusan permanen dari server utama dan cadangan (DRC) setelah masa retensi dokumen berakhir.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Media Fisik (Hardisk/Flashdisk):</strong> Harus diserahkan ke Biro TI untuk dilakukan degaussing (penghilangan kemagnetan) atau penghancuran fisik agar data di dalamnya tidak dapat di-recovery kembali.</span></li>
                    </ul>
                ',
                'created_at' => now()->subYear(),
                'updated_at' => now()->subYear(),
            ],
            [
                'title' => 'Panduan Akses Visualisasi Data BIDICS Dashboard',
                'category' => 'Layanan Data',
                'subcategory' => 'BIDICS Dashboard',
                'likes' => 1209,
                'content' => '
                    <p>BIDICS Dashboard menyediakan visualisasi data terintegrasi untuk pimpinan dan pemeriksa BPK:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Buka peramban (browser) dan akses alamat intranet: <code>https://bidics.bpk.go.id</code>.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Login menggunakan kredensial Single Sign-On (SSO) BPK dan pastikan Anda sudah terhubung ke jaringan kantor atau VPN BPK.</span></li>
                    </ul>
                ',
                'created_at' => now()->subWeeks(2),
                'updated_at' => now()->subWeeks(2),
            ],
            [
                'title' => 'Pengenalan Fitur Self-Service Analytics (SSA) BIDICS',
                'category' => 'Layanan Data',
                'subcategory' => 'BIDICS-SSA',
                'likes' => 677,
                'content' => '
                    <p>Fitur BIDICS Self-Service Analytics (SSA) memungkinkan pengguna membuat analisis data mandiri tanpa bantuan developer:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Akses Model Data:</strong> Masuk to portal SSA, pilih dataset yang tersedia (Kepegawaian, Keuangan, atau Hasil Pemeriksaan).</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Drag and Drop:</strong> Tarik kolom data yang diinginkan untuk membuat visualisasi grafik, tabel, atau diagram interaktif secara instan.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ],

            // LAYANAN APLIKASI
            [
                'title' => 'Cara Mengajukan Permintaan Pengembangan Aplikasi Baru',
                'category' => 'Layanan Aplikasi',
                'subcategory' => 'Pengembangan Aplikasi',
                'likes' => 315,
                'content' => '
                    <p>Satker yang memerlukan sistem aplikasi baru harus menempuh alur pengajuan resmi:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Penyusunan KAK:</strong> Susun Kerangka Acuan Kerja (KAK) yang mendeskripsikan tujuan, fitur, dan kebutuhan pengguna.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Review Arsitektur:</strong> Ajukan berkas KAK melalui nota dinas ke Biro TI untuk dilakukan penilaian arsitektur, kelayakan, serta ketersediaan resource developer.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(3),
                'updated_at' => now()->subMonths(3),
            ],
            [
                'title' => 'Panduan Penggunaan Aplikasi SiAP (Sistem Informasi Arsip Pemeriksaan)',
                'category' => 'Layanan Aplikasi',
                'subcategory' => 'Aplikasi Pemeriksaan',
                'likes' => 2901,
                'content' => '
                    <p>Aplikasi SiAP digunakan untuk mengarsipkan seluruh dokumen hasil pemeriksaan secara digital:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pilih tahun anggaran dan nama entitas pemeriksaan pada menu drop-down.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Unggah file LHP (Laporan Hasil Pemeriksaan) dalam format PDF yang sudah ditandatangani secara elektronik (TTE).</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pastikan ukuran file LHP tidak melebihi 100MB per file.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ],
            [
                'title' => 'Solusi Masalah Login Aplikasi Kepegawaian (SISDM)',
                'category' => 'Layanan Aplikasi',
                'subcategory' => 'Aplikasi Kelembagaan',
                'likes' => 1890,
                'content' => '
                    <p>Jika Anda mengalami kendala saat masuk ke aplikasi SISDM BPK:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Hapus cache dan cookies browser Anda atau gunakan mode Incognito (Jendela Penyamaran).</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pastikan input NIP dan Password sudah sesuai. Jika lupa password, gunakan fitur "Lupa Password" di halaman login untuk reset via email resmi.</span></li>
                    </ul>
                ',
                'created_at' => now()->subWeeks(2),
                'updated_at' => now()->subWeeks(2),
            ],
            [
                'title' => 'Panduan Aplikasi Perjalanan Dinas (LPD)',
                'category' => 'Layanan Aplikasi',
                'subcategory' => 'Aplikasi Pendukung',
                'likes' => 1230,
                'content' => '
                    <p>Aplikasi LPD memfasilitasi pengajuan, administrasi, dan pertanggungjawaban perjalanan dinas:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Buat surat tugas baru di LPD sebelum keberangkatan dengan melampirkan nota dinas persetujuan pimpinan.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Unggah tiket, boarding pass, bill hotel, dan bukti riil pengeluaran ke dalam aplikasi LPD maksimal 5 hari kerja setelah perjalanan selesai.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(2),
                'updated_at' => now()->subMonths(2),
            ],
            [
                'title' => 'Cara Menggunakan Portal Kolaborasi Teams BPK',
                'category' => 'Layanan Aplikasi',
                'subcategory' => 'Aplikasi Kolaborasi',
                'likes' => 3450,
                'content' => '
                    <p>Portal kolaborasi Teams didukung oleh Microsoft 365 resmi BPK:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Gunakan akun email BPK penuh untuk masuk ke Microsoft Teams.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Anda dapat menjadwalkan rapat online, berbagi file Excel/Word real-time dengan rekan satker, dan membuat channel kolaborasi tim ad-hoc.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ],
            [
                'title' => 'Panduan Membuat Kuesioner Survei dengan Aplikasi Internal',
                'category' => 'Layanan Aplikasi',
                'subcategory' => 'Layanan Survei',
                'likes' => 488,
                'content' => '
                    <p>Biro TI menyediakan platform survei internal untuk pengumpulan data kuesioner dari eksternal/internal:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Akses portal Survei BPK, klik "Buat Survei Baru", lalu rancang pertanyaan kuesioner Anda.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Survei internal ini terjamin kerahasiaan datanya karena disimpan langsung pada server lokal Data Center BPK.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(4),
                'updated_at' => now()->subMonths(4),
            ],

            // LAYANAN TEKNOLOGI (3 Levels)
            [
                'title' => 'Cara Mengajukan Pemasangan Jaringan LAN Baru',
                'category' => 'Layanan Teknologi',
                'subcategory' => 'Layanan Intranet',
                'service' => 'Pembuatan Local Area Network (LAN)',
                'likes' => 304,
                'content' => '
                    <p>Untuk menambah titik port LAN baru pada ruang kerja Anda:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Ajukan tiket melalui platform Melati dengan memilih Kategori: <strong>Layanan Teknologi</strong>, Sub: <strong>Layanan Intranet</strong>, Detail: <strong>Pembuatan LAN</strong>.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Sebutkan nomor ruangan dan jumlah port LAN yang ingin dipasang. Petugas infrastruktur jaringan akan menjadwalkan instalasi kabel UTP.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(2),
                'updated_at' => now()->subMonths(2),
            ],
            [
                'title' => 'Panduan Menghubungkan Perangkat ke Wi-Fi BPK-Secure',
                'category' => 'Layanan Teknologi',
                'subcategory' => 'Layanan Intranet',
                'service' => 'Pemasangan perangkat Wireless Fidelity (Wifi)',
                'likes' => 5210,
                'content' => '
                    <p>Wi-Fi BPK-Secure ditujukan untuk laptop dinas pegawai dengan enkripsi WPA2-Enterprise:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pilih SSID <strong>Wi-Fi BPK-Secure</strong> pada daftar koneksi nirkabel perangkat Anda.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Masukkan username email BPK (tanpa @bpk.go.id) dan password Anda ketika diminta kredensial keamanan.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Setujui sertifikat keamanan (trust certificate) jika muncul notifikasi konfirmasi di browser.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ],
            [
                'title' => 'Mengatasi Masalah Wi-Fi Terputus (Disconnected)',
                'category' => 'Layanan Teknologi',
                'subcategory' => 'Layanan Intranet',
                'service' => 'Pengaturan konfigurasi Wifi',
                'likes' => 1320,
                'content' => '
                    <p>Jika koneksi Wi-Fi Anda sering terputus atau mendapat status "No Internet Access":</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Lakukan "Forget Network" pada SSID Wi-Fi BPK-Secure, lalu sambungkan kembali dengan memasukkan ulang password.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Pastikan pengaturan IP Address dan DNS Server pada adapter nirkabel Anda diatur secara otomatis (DHCP).</span></li>
                    </ul>
                ',
                'created_at' => now()->subWeeks(3),
                'updated_at' => now()->subWeeks(3),
            ],
            [
                'title' => 'Panduan Pemasangan dan Koneksi VPN BPK',
                'category' => 'Layanan Teknologi',
                'subcategory' => 'Layanan Virtual Private Network',
                'service' => 'Pemasangan VPN',
                'likes' => 11450,
                'content' => '
                    <p>VPN (Virtual Private Network) digunakan untuk mengakses portal internal BPK dari luar jaringan kantor:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Instalasi Client:</strong> Unduh installer FortiClient VPN resmi melalui link download di Portal TI BPK.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Konfigurasi Koneksi:</strong> Buat koneksi baru -> set jenis VPN ke SSL-VPN -> masukkan Remote Gateway: <code>vpn.bpk.go.id</code> -> set port ke <code>10443</code>.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span><strong>Login:</strong> Masukkan kredensial email BPK dan input 6 digit OTP MFA Google Authenticator Anda saat diminta.</span></li>
                    </ul>
                ',
                'created_at' => now()->subWeek(),
                'updated_at' => now()->subWeek(),
            ],
            [
                'title' => 'Mengakses Control Panel Web Hosting BPK',
                'category' => 'Layanan Teknologi',
                'subcategory' => 'Layanan Hosting',
                'service' => 'Pengaturan konfigurasi hosting subdomain',
                'likes' => 229,
                'content' => '
                    <p>Admin satker yang memiliki hosting subdomain bpk.go.id dapat mengelola website melalui control panel:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Akses cPanel hosting Anda di URL yang dikirimkan oleh administrator server Biro TI.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Lakukan update CMS (seperti WordPress/Drupal) dan plugin secara rutin untuk mencegah celah keamanan (vulnerability).</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(5),
                'updated_at' => now()->subMonths(5),
            ],

            // LAYANAN PERANGKAT
            [
                'title' => 'Spesifikasi Standar Laptop Dinas BPK RI',
                'category' => 'Layanan Perangkat',
                'subcategory' => 'Standarisasi Perangkat Komputer',
                'likes' => 1440,
                'content' => '
                    <p>Biro TI menetapkan standar spesifikasi laptop dinas untuk menunjang kelancaran tugas pemeriksaan dan administratif:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Intel Core i5/i7 (Generasi terbaru) / AMD Ryzen 5/7.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>RAM minimal 16GB DDR4/DDR5.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Storage minimal 512GB SSD NVMe.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>OS Windows 11 Enterprise berlisensi resmi dengan terinstal antivirus korporat.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(8),
                'updated_at' => now()->subMonths(8),
            ],
            [
                'title' => 'Alur dan Syarat Peminjaman Laptop/Proyektor Kegiatan',
                'category' => 'Layanan Perangkat',
                'subcategory' => 'Peminjaman Perangkat',
                'likes' => 1120,
                'content' => '
                    <p>Untuk meminjam perangkat TI pendukung kegiatan rapat, sosialisasi, atau kedinasan:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Ajukan tiket peminjaman minimal H-2 sebelum pelaksanaan kegiatan.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Tuliskan secara detail jenis perangkat (Laptop, Proyektor, Pointer), tanggal peminjaman, serta nama penanggung jawab kegiatan.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Kembalikan perangkat dalam keadaan utuh maksimal H+1 setelah kegiatan selesai.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonth(),
                'updated_at' => now()->subMonth(),
            ],

            // LAYANAN DUKUNGAN TI
            [
                'title' => 'Prosedur Request Pendampingan TI untuk Acara/Sidang BPK',
                'category' => 'Layanan Dukungan TI',
                'subcategory' => 'Pendampingan Personel TI',
                'likes' => 388,
                'content' => '
                    <p>Biro TI menyediakan tim pendampingan (operator on-site) untuk memastikan kelancaran TI selama acara krusial:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Kirimkan surat permohonan pendampingan satker ke Biro TI atau buat tiket bantuan di portal Melati minimal H-3.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Sebutkan lokasi, waktu detail, platform yang digunakan (misal: Zoom/Teams), serta kebutuhan setup jaringan atau multimedia pendukung.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(2),
                'updated_at' => now()->subMonths(2),
            ],

            // LAYANAN INFORMASI
            [
                'title' => 'Katalog Layanan Teknologi Informasi Biro TI',
                'category' => 'Layanan Informasi',
                'subcategory' => 'Informasi Produk TI',
                'likes' => 890,
                'content' => '
                    <p>Katalog Layanan TI adalah dokumen acuan resmi yang memuat seluruh jenis layanan yang disediakan oleh Biro TI BPK RI:</p>
                    <ul class="space-y-2.5 text-[13.5px] text-slate-600 leading-relaxed font-medium mt-4">
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Mencakup 7 Kategori Utama: Layanan Identitas, Layanan Data, Layanan Aplikasi, Layanan Teknologi, Layanan Perangkat, Layanan Dukungan TI, dan Layanan Informasi.</span></li>
                        <li class="flex items-start gap-2.5"><span class="text-[#b26d27] mt-1 shrink-0">•</span><span>Masing-masing kategori memiliki SLA (Service Level Agreement) penanganan kendala yang bervariasi sesuai tingkat urgensi masalah.</span></li>
                    </ul>
                ',
                'created_at' => now()->subMonths(6),
                'updated_at' => now()->subMonths(6),
            ]
        ];

        foreach ($articles as $articleData) {
            Article::create($articleData);
        }
    }
}
