@extends('layouts.dashboard')

@section('page_title', 'Dokumentasi Sistem')

@php
    $sections = [
        ['id' => 'ikhtisar',  'icon' => 'fa-circle-info',    'title' => 'Ikhtisar Sistem'],
        ['id' => 'teknologi', 'icon' => 'fa-microchip',       'title' => 'Teknologi'],
        ['id' => 'statis',    'icon' => 'fa-code',            'title' => 'Halaman & Section Statis'],
        ['id' => 'peran',     'icon' => 'fa-user-shield',     'title' => 'Peran & Hak Akses'],
        ['id' => 'branding',  'icon' => 'fa-palette',         'title' => 'Identitas Visual'],
        ['id' => 'blog',      'icon' => 'fa-newspaper',       'title' => 'Manajemen Blog'],
        ['id' => 'kategori',  'icon' => 'fa-tags',            'title' => 'Kategori'],
        ['id' => 'album',     'icon' => 'fa-images',          'title' => 'Album & Galeri'],
        ['id' => 'media',     'icon' => 'fa-photo-film',      'title' => 'Media & Editor'],
        ['id' => 'pengguna',  'icon' => 'fa-users-gear',      'title' => 'Pengguna (Admin)'],
        ['id' => 'profil',    'icon' => 'fa-user-gear',       'title' => 'Profil & Keamanan'],
        ['id' => 'faq',       'icon' => 'fa-circle-question', 'title' => 'Tips & FAQ'],
    ];
@endphp

@section('content')
    <div
        x-data="{ active: @js($sections[0]['id']) }"
        x-init="
            const ids = @js(array_column($sections, 'id'));
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) { active = entry.target.id; }
                });
            }, { rootMargin: '-25% 0px -65% 0px', threshold: 0 });
            ids.forEach((id) => {
                const el = document.getElementById(id);
                if (el) observer.observe(el);
            });
        "
        class="relative"
    >
        {{-- Konten dokumentasi --}}
        <div class="max-w-3xl space-y-6 xl:pr-4">
            <div class="bg-gradient-to-br from-primary to-primary-700 text-white rounded-2xl p-6 md:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-white/70">Panduan Penggunaan</p>
                        <h2 class="text-2xl md:text-3xl font-extrabold mt-1">Dokumentasi Sistem</h2>
                        <p class="text-white/90 mt-2 text-sm md:text-base">
                            Panduan penggunaan panel admin {{ config('app.name') }} untuk admin dan operator.
                            Gunakan navigasi di kanan untuk berpindah antar bagian.
                        </p>
                    </div>
                    <button type="button" onclick="window.print()"
                        class="no-print shrink-0 inline-flex items-center gap-2 px-4 py-2 bg-white/15 hover:bg-white/25 border border-white/30 text-white text-sm font-semibold rounded-xl transition">
                        <i class="fa-solid fa-print"></i>
                        <span class="hidden sm:inline">Cetak</span>
                    </button>
                </div>
            </div>

            {{-- Ikhtisar --}}
            <section id="ikhtisar" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-circle-info text-primary"></i> Ikhtisar Sistem</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Aplikasi ini adalah CMS ringan untuk mengelola situs profil yayasan. Situs publik menampilkan
                    beranda <em>one-page</em>, blog, dan galeri, sedangkan konten dinamisnya dikelola melalui panel
                    admin di <code class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-white/10 text-xs">/dashboard</code>.
                </p>
                <ul class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300">
                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Manajemen Blog/Artikel dengan editor TinyMCE dan multi-kategori.</li>
                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Manajemen Album/Galeri beserta unggah banyak foto.</li>
                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Autentikasi peran (admin &amp; operator) tanpa registrasi publik.</li>
                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Tema terang (hijau daun) dan mode gelap.</li>
                </ul>
            </section>

            {{-- Teknologi --}}
            <section id="teknologi" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-microchip text-primary"></i> Teknologi yang Digunakan</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Ringkasan teknologi yang membangun dan menjalankan sistem ini — ditujukan bagi pembaca
                    non-teknis maupun developer baru yang bergabung dengan proyek.
                </p>
                <div class="mt-5 grid sm:grid-cols-2 gap-3">

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center shrink-0">
                                <i class="fa-brands fa-php text-primary text-lg"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-800 dark:text-slate-100">PHP 8.2 + Laravel 12</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                                    Bahasa pemrograman backend dan framework utama. Menjalankan logika aplikasi,
                                    routing, autentikasi, validasi, dan seluruh akses ke database.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-database text-primary text-base"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-800 dark:text-slate-100">SQLite</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                                    Basis data berbasis berkas tunggal, ringan tanpa server terpisah.
                                    Cocok untuk situs profil berskala kecil–menengah. Dapat dipindah ke
                                    MySQL/PostgreSQL tanpa banyak perubahan kode.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-file-code text-primary text-base"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-800 dark:text-slate-100">Blade (Laravel Templating)</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                                    Mesin template bawaan Laravel untuk menyusun halaman HTML.
                                    Dipakai untuk semua tampilan: halaman publik, dashboard, dan konten statis.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center shrink-0">
                                <i class="fa-brands fa-css3-alt text-primary text-lg"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-800 dark:text-slate-100">Tailwind CSS 4</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                                    Framework CSS berbasis <em>utility class</em> untuk tampilan responsif dan konsisten.
                                    Kelas yang tidak terpakai otomatis dipangkas saat build.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center shrink-0">
                                <i class="fa-brands fa-js text-primary text-lg"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-800 dark:text-slate-100">Alpine.js 3</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                                    Pustaka JavaScript ringan untuk interaktivitas sisi klien: toggle menu,
                                    akordeon, lightbox galeri, dan pemuatan data Blog/Galeri dinamis dari API.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-bolt text-primary text-base"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-800 dark:text-slate-100">Vite 7</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                                    Alat build dan bundler aset (CSS &amp; JS). Menyediakan <em>hot reload</em>
                                    cepat saat pengembangan dan bundle terminifikasi untuk produksi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-pen-nib text-primary text-base"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-800 dark:text-slate-100">TinyMCE 8 <span class="font-normal text-slate-400">(self-hosted)</span></p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                                    Editor teks kaya (<em>WYSIWYG</em>) tanpa API key untuk menulis artikel Blog.
                                    Mendukung format teks, tabel, dan unggah gambar langsung dari editor.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-lg bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-font text-primary text-base"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-slate-800 dark:text-slate-100">Font Awesome 6 &amp; Google Fonts</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                                    Font Awesome menyediakan ikon antarmuka. Google Fonts menyediakan
                                    tipografi utama <strong>Plus Jakarta Sans</strong> untuk identitas visual situs.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            {{-- Halaman & Section Statis --}}
            <section id="statis" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-code text-primary"></i> Halaman &amp; Section Statis</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Bagian ini mencatat seluruh konten <strong>statis</strong> situs — teks, angka, foto, dan informasi yang
                    <strong>tidak</strong> dapat diubah melalui panel admin. Perubahan hanya bisa dilakukan oleh
                    <strong>web developer</strong> dengan mengedit file Blade yang bersangkutan, kemudian men-deploy ulang.
                </p>

                {{-- Beranda: Section Hero --}}
                <div class="mt-6 space-y-4">

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-star text-primary text-sm"></i>
                            <span class="font-bold text-sm">Hero</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/home.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Judul utama (<em>"Menjaga Ekologi Sahul…"</em>), sub-judul, kalimat deskripsi YESL di bawah hero, serta teks dan tautan dua tombol CTA.
                            Latar belakang hero (gambar slider) berada di
                            <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">resources/views/components/hero.blade.php</code>.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-chart-bar text-primary text-sm"></i>
                            <span class="font-bold text-sm">Statistik Dampak</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/dampak.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Lima kotak statistik <em>"Dampak Kami Hingga 2024"</em>: Wilayah Dampingan (114.941 Ha), Penerima Manfaat (3.843),
                            Komunitas Adat (9), Donor Strategis (5), dan Tahun Pengalaman (5). Angka, label, ikon, dan tahun laporan semuanya dikodekan di file ini.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-building text-primary text-sm"></i>
                            <span class="font-bold text-sm">Tentang YESL</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/tentang.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Logo, empat paragraf deskripsi organisasi, akordeon <em>Arti Nama YESL</em>, <em>Filosofi Logo</em>, dan tabel
                            <em>Status Legalitas Organisasi</em> (NIB, nomor SIUP, akta notaris, KEMENKUMHAM, NPWP, alamat, kontak).
                            Gambar logo di <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">public/images/logo-yesl.png</code>.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-bullseye text-primary text-sm"></i>
                            <span class="font-bold text-sm">Visi &amp; Misi</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/visi-misi.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Teks visi (<em>"Terwujudnya bentang alam yang lestari…"</em>), lima poin misi yayasan, serta deskripsi wilayah kerja &amp; kedudukan (Mimika, Papua Tengah).
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-leaf text-primary text-sm"></i>
                            <span class="font-bold text-sm">Nilai-Nilai Organisasi</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/nilai.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Lima nilai inti: <em>Keberpihakan Masyarakat Adat, Kelestarian Bentang Alam, Kolaboratif, Integritas &amp; Akuntabilitas,</em> dan <em>Pembelajaran &amp; Inovatif</em>.
                            Setiap nilai memiliki judul dan deskripsi singkat.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-layer-group text-primary text-sm"></i>
                            <span class="font-bold text-sm">Program Prioritas</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/program.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Empat pilar program (<em>Kajian &amp; Pengelolaan Pengetahuan, Transformasi Ekonomi, Pemberdayaan Masyarakat Adat, Pembiayaan Inovatif</em>)
                            beserta ikon, deskripsi, dan gambar latar masing-masing.
                            Gambar ada di <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">public/images/proram-prioritas/</code>.
                            Halaman detail <em>Program Berjalan</em> (<code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">/program-berjalan</code>) ada di
                            <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">resources/views/pages/program-berjalan.blade.php</code>.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-circle-question text-primary text-sm"></i>
                            <span class="font-bold text-sm">Mengapa YESL</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/mengapa.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Lima alasan mengapa memilih YESL: <em>Dipimpin Masyarakat Adat, Berbasis Bentang Alam, Berbasis Bukti, Kolaboratif,</em> dan
                            <em>Akuntabel &amp; Transparan</em>. Setiap kartu memiliki ikon, judul, deskripsi, dan foto latar.
                            Foto ada di <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">public/images/mengapa-yesl/</code>.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-users text-primary text-sm"></i>
                            <span class="font-bold text-sm">Tim YESL</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/tim.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Dua kelompok: <em>Pembina &amp; Pengawas</em> (Netty Bakkara, Maryana J. E. Hamadi) dan <em>Staf</em>
                            (Rintho G. Maturbongs — Direktur, Prasetyo — Manager Program, Nadhiya Tamrin — Staf Keuangan,
                            Eka Januarita Kafiar — Fasilitator Lokal). Foto tim ada di <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">public/images/team/</code>.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-hand-holding-heart text-primary text-sm"></i>
                            <span class="font-bold text-sm">Donasi / Mari Berkontribusi</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/mari-berkontribusi.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Nomor WhatsApp kontak (<code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">62811490000</code>), detail rekening donasi
                            (BRI a.n. <em>EKOLOGI SAHUL LESTARI</em>, No. Rek. <strong>056101002563303</strong>, Cabang Timika),
                            teks ajakan donasi, dan instruksi transfer. Perubahan nomor rekening atau nomor WA harus dilakukan di sini.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-handshake text-primary text-sm"></i>
                            <span class="font-bold text-sm">Mitra Kerja</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/mitra-kerja.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Tujuh logo mitra &amp; donor: BRIN, EcoNusa, Pemkab Mimika, Konservasi Indonesia, Learning Transforms Lives,
                            Packard Foundation, The Asia Foundation. File logo ada di <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">public/images/patners/</code>.
                            Untuk menambah/menghapus mitra, edit array <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">$mitraKerja</code> di file tersebut.
                        </p>
                    </div>

                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-rectangle-ad text-primary text-sm"></i>
                            <span class="font-bold text-sm">CTA (Ajakan Kolaborasi)</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/cta.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Banner besar di akhir beranda: <em>"Siap Berkolaborasi untuk Tata Kelola SDA yang Adil?"</em> beserta
                            sub-teks dan tombol <em>Hubungi YESL</em>.
                        </p>
                    </div>

                    {{-- Navigasi & Footer --}}
                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-bars text-primary text-sm"></i>
                            <span class="font-bold text-sm">Navigasi &amp; Footer</span>
                            <code class="ml-auto text-[11px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">resources/views/partials/nav.blade.php &amp; footer.blade.php</code>
                        </div>
                        <p class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                            Menu navigasi atas (logo, tautan, tombol toggle dark-mode) dan footer (alamat kantor, peta Google Maps,
                            tautan media sosial, badge NGO Source) dikodekan di kedua file ini.
                        </p>
                    </div>

                </div>

                {{-- Halaman Statis Tambahan --}}
                <h3 class="font-bold text-base mt-8 mb-4 flex items-center gap-2"><i class="fa-solid fa-file text-primary text-sm"></i> Halaman Statis Lainnya</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/60 text-left">
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 rounded-tl-lg border border-slate-200 dark:border-white/10">Halaman</th>
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10">URL</th>
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 rounded-tr-lg border border-slate-200 dark:border-white/10">File Blade</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-600 dark:text-slate-300">
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10 font-medium">Kebijakan Privasi</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">/kebijakan-privasi</code></td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">resources/views/pages/privacy.blade.php</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10 font-medium">FAQ</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">/faq</code></td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">resources/views/pages/faq.blade.php</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10 font-medium">Program Berjalan</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">/program-berjalan</code></td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">resources/views/pages/program-berjalan.blade.php</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10 font-medium">Peta Situs</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">/peta-situs</code></td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">resources/views/pages/sitemap.blade.php</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p class="mt-5 text-sm text-slate-500 dark:text-slate-400 flex gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-amber-500 mt-0.5 shrink-0"></i>
                    Semua perubahan di atas memerlukan akses ke kode sumber. Hubungi web developer untuk pembaruan konten statis.
                </p>
            </section>

            {{-- Peran & Hak Akses --}}
            <section id="peran" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-user-shield text-primary"></i> Peran &amp; Hak Akses (Klasifikasi SDM)</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Terdapat empat klasifikasi SDM yang berinteraksi dengan sistem. Secara teknis, sistem
                    hanya mengenal dua peran login
                    (<code class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-white/10 text-xs">admin</code> dan
                    <code class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-white/10 text-xs">operator</code>),
                    sementara <em>Web Developer</em> dan <em>Pengunjung</em> berada di luar mekanisme login aplikasi.
                </p>

                <div class="mt-5 space-y-4">

                    {{-- Web Developer --}}
                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-code text-violet-500 text-sm"></i>
                            <span class="font-bold text-sm">Web Developer</span>
                            <span class="ml-auto text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-violet-50 text-violet-700 dark:bg-violet-500/10 dark:text-violet-300">Di luar login</span>
                        </div>
                        <div class="px-4 py-4 grid sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200 mb-2 flex items-center gap-1"><i class="fa-solid fa-check-circle text-primary text-xs"></i> Kemampuan</p>
                                <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Mengubah konten statis Blade (hero, tentang, visi-misi, tim, mitra, dll.)</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Menambah/mengubah fitur &amp; halaman aplikasi</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Membuat migrasi database, mengelola peran &amp; middleware</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Deploy dan konfigurasi server produksi</li>
                                </ul>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200 mb-2 flex items-center gap-1"><i class="fa-solid fa-ban text-red-400 text-xs"></i> Batasan</p>
                                <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                    <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-0.5 shrink-0 text-xs"></i> Perubahan konten statis wajib melalui coding &amp; deploy ulang</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-0.5 shrink-0 text-xs"></i> Bukan peran login aplikasi untuk operasional sehari-hari</li>
                                </ul>
                                <p class="text-xs text-slate-400 mt-3"><i class="fa-solid fa-circle-info mr-1"></i> Dibutuhkan: PHP/Laravel, Blade, Tailwind CSS, Alpine.js, Vite, Git.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Admin --}}
                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-crown text-primary text-sm"></i>
                            <span class="font-bold text-sm">Admin</span>
                            <code class="ml-auto text-[10px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">role: admin</code>
                        </div>
                        <div class="px-4 py-4 grid sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200 mb-2 flex items-center gap-1"><i class="fa-solid fa-check-circle text-primary text-xs"></i> Kemampuan</p>
                                <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Akses penuh ke seluruh modul dashboard</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Membuat, mengubah, reset kata sandi, dan hapus akun operator</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> CRUD Blog, Kategori, dan Album/Galeri</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Ubah data akun &amp; kata sandi sendiri</li>
                                </ul>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200 mb-2 flex items-center gap-1"><i class="fa-solid fa-ban text-red-400 text-xs"></i> Batasan</p>
                                <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                    <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-0.5 shrink-0 text-xs"></i> Tidak dapat mengubah konten statis Blade</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-0.5 shrink-0 text-xs"></i> Tidak ada registrasi publik; akun dibuat developer/admin</li>
                                </ul>
                                <p class="text-xs text-slate-400 mt-3"><i class="fa-solid fa-circle-info mr-1"></i> Tidak memerlukan kemampuan coding.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Operator --}}
                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-user-pen text-slate-500 text-sm"></i>
                            <span class="font-bold text-sm">Operator <span class="font-normal text-slate-400 text-xs">(/ Penulis Konten)</span></span>
                            <code class="ml-auto text-[10px] bg-slate-100 dark:bg-white/10 px-2 py-0.5 rounded text-slate-500">role: operator</code>
                        </div>
                        <div class="px-4 py-4 grid sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200 mb-2 flex items-center gap-1"><i class="fa-solid fa-check-circle text-primary text-xs"></i> Kemampuan</p>
                                <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> CRUD Blog/Artikel (tulis, format, gambar, multi-kategori, jadwal, SEO)</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> CRUD Kategori dan Album/Galeri (termasuk unggah &amp; hapus foto)</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Ubah data akun &amp; kata sandi sendiri</li>
                                </ul>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200 mb-2 flex items-center gap-1"><i class="fa-solid fa-ban text-red-400 text-xs"></i> Batasan</p>
                                <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                    <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-0.5 shrink-0 text-xs"></i> Tidak dapat mengakses Manajemen Pengguna (<code class="text-[10px]">/dashboard/users</code>)</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-0.5 shrink-0 text-xs"></i> Tidak dapat mengubah konten statis Blade</li>
                                </ul>
                                <p class="text-xs text-slate-400 mt-3"><i class="fa-solid fa-circle-info mr-1"></i> Tidak memerlukan kemampuan coding.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Pengunjung --}}
                    <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                        <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                            <i class="fa-solid fa-eye text-slate-400 text-sm"></i>
                            <span class="font-bold text-sm">Pengunjung / Visitor</span>
                            <span class="ml-auto text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 dark:bg-white/5 dark:text-slate-400">Publik</span>
                        </div>
                        <div class="px-4 py-4 grid sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200 mb-2 flex items-center gap-1"><i class="fa-solid fa-check-circle text-primary text-xs"></i> Kemampuan</p>
                                <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Menjelajah seluruh halaman publik (beranda, blog, galeri, FAQ, dll.)</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Pencarian &amp; filter (kata kunci, A–Z, rentang tanggal, kategori)</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-0.5 shrink-0 text-xs"></i> Lightbox galeri, toggle mode gelap, akses kontak/donasi via WhatsApp</li>
                                </ul>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-700 dark:text-slate-200 mb-2 flex items-center gap-1"><i class="fa-solid fa-ban text-red-400 text-xs"></i> Batasan</p>
                                <ul class="space-y-1.5 text-slate-600 dark:text-slate-300">
                                    <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-0.5 shrink-0 text-xs"></i> Hanya membaca (read-only), tidak dapat membuat/mengubah konten</li>
                                    <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-0.5 shrink-0 text-xs"></i> Tidak memiliki akses ke dashboard (<code class="text-[10px]">/dashboard</code>)</li>
                                </ul>
                                <p class="text-xs text-slate-400 mt-3"><i class="fa-solid fa-circle-info mr-1"></i> Tidak memerlukan akun atau kemampuan teknis.</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Tabel Ringkasan Hak Akses --}}
                <h3 class="font-bold text-base mt-8 mb-4 flex items-center gap-2"><i class="fa-solid fa-table-cells text-primary text-sm"></i> Ringkasan Hak Akses</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/60 text-left">
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10">Aksi / Fitur</th>
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 text-center">Developer</th>
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 text-center">Admin</th>
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 text-center">Operator</th>
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 text-center">Pengunjung</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-600 dark:text-slate-300">
                            @php
                            $matrix = [
                                ['Akses halaman publik situs',          true,  true,  true,  true],
                                ['Login dashboard',                      false, true,  true,  false],
                                ['Kelola Blog &amp; Artikel',            false, true,  true,  false],
                                ['Kelola Kategori',                      false, true,  true,  false],
                                ['Kelola Album &amp; Galeri',            false, true,  true,  false],
                                ['Kelola Pengguna (operator)',           false, true,  false, false],
                                ['Ubah profil &amp; kata sandi sendiri', false, true,  true,  false],
                                ['Ubah konten statis (Blade)',           true,  false, false, false],
                                ['Tambah fitur / deploy',                true,  false, false, false],
                            ];
                            @endphp
                            @foreach ($matrix as $row)
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10 font-medium">{!! $row[0] !!}</td>
                                @foreach ([1,2,3,4] as $col)
                                    <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10 text-center">
                                        @if ($row[$col])
                                            <i class="fa-solid fa-check text-primary"></i>
                                        @else
                                            <i class="fa-solid fa-xmark text-slate-300 dark:text-slate-600"></i>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- Identitas Visual & Branding --}}
            <section id="branding" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-palette text-primary"></i> Identitas Visual &amp; Branding</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Panduan identitas visual situs yang mencakup tipografi, palet warna, dan elemen desain.
                    Seluruh nilai ini dikodekan di
                    <code class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-white/10 text-xs">resources/css/app.css</code>.
                    Untuk mengubah warna atau font, developer perlu mengedit file tersebut dan menjalankan
                    <code class="px-1.5 py-0.5 rounded bg-slate-100 dark:bg-white/10 text-xs">npm run build</code>.
                </p>

                {{-- Tipografi --}}
                <h3 class="font-bold text-base mt-6 mb-3 flex items-center gap-2"><i class="fa-solid fa-font text-primary text-sm"></i> Tipografi</h3>
                <div class="rounded-xl border border-slate-200 dark:border-white/10 overflow-hidden">
                    <div class="flex flex-wrap items-center gap-3 bg-slate-50 dark:bg-slate-800/60 px-4 py-3 border-b border-slate-200 dark:border-white/10">
                        <span class="font-bold text-sm">Plus Jakarta Sans</span>
                        <span class="text-xs text-slate-500">— Font utama situs (semua teks)</span>
                        <a href="https://fonts.google.com/specimen/Plus+Jakarta+Sans" target="_blank"
                           class="ml-auto text-xs text-primary underline">Google Fonts &rarr;</a>
                    </div>
                    <div class="px-4 py-5 space-y-3">
                        <p class="text-[10px] text-slate-400 mb-4">Fallback: ui-sans-serif, system-ui, sans-serif</p>
                        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-size:1.875rem;font-weight:800;line-height:1.2" class="text-slate-800 dark:text-slate-100">ExtraBold 800 — Judul Utama</p>
                        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-size:1.5rem;font-weight:700;line-height:1.3" class="text-slate-800 dark:text-slate-100">Bold 700 — Sub Judul &amp; Heading Section</p>
                        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-size:1rem;font-weight:600;line-height:1.5" class="text-slate-700 dark:text-slate-200">SemiBold 600 — Label, Navigasi, Tombol</p>
                        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-size:1rem;font-weight:400;line-height:1.75" class="text-slate-600 dark:text-slate-300">Regular 400 — Teks konten, paragraf, dan deskripsi normal</p>
                        <p style="font-family:'Plus Jakarta Sans',sans-serif;font-size:0.875rem;font-weight:400;line-height:1.6" class="text-slate-500 dark:text-slate-400">Small 14px — Teks sekunder, keterangan, meta info</p>
                    </div>
                </div>

                {{-- Palet Warna Primer --}}
                <h3 class="font-bold text-base mt-6 mb-3 flex items-center gap-2"><i class="fa-solid fa-swatchbook text-primary text-sm"></i> Palet Warna Primer (Hijau Daun)</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                    @php
                    $palette = [
                        ['name' => 'primary-50',  'var' => '--color-primary-50',  'hex' => '#f0faf1', 'usage' => 'Latar badge, hover ringan'],
                        ['name' => 'primary-100', 'var' => '--color-primary-100', 'hex' => '#dbf3de', 'usage' => 'Latar aksen terang'],
                        ['name' => 'primary-200', 'var' => '--color-primary-200', 'hex' => '#bae7bf', 'usage' => 'Border aksen hijau'],
                        ['name' => 'primary-300', 'var' => '--color-primary-300', 'hex' => '#8bd493', 'usage' => 'Ikon & ilustrasi muda'],
                        ['name' => 'primary-400', 'var' => '--color-primary-400', 'hex' => '#55ba62', 'usage' => 'Aksen interaktif'],
                        ['name' => 'primary-500', 'var' => '--color-primary-500', 'hex' => '#319b40', 'usage' => 'Hijau medium'],
                        ['name' => 'primary',     'var' => '--color-primary',     'hex' => '#237d31', 'usage' => 'Warna Primer Utama ★'],
                        ['name' => 'primary-700', 'var' => '--color-primary-700', 'hex' => '#1e6329', 'usage' => 'Hover tombol utama'],
                        ['name' => 'primary-800', 'var' => '--color-primary-800', 'hex' => '#1b4f24', 'usage' => 'Teks di latar terang'],
                        ['name' => 'primary-900', 'var' => '--color-primary-900', 'hex' => '#17411f', 'usage' => 'Aksen dark mode'],
                        ['name' => 'primary-950', 'var' => '--color-primary-950', 'hex' => '#08240f', 'usage' => 'Terdalam, dark mode'],
                    ];
                    @endphp
                    @foreach ($palette as $c)
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-white/10">
                        <div class="h-10 w-full" style="background-color: {{ $c['hex'] }};"></div>
                        <div class="px-3 py-2 bg-white dark:bg-slate-800">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">{{ $c['name'] }}</p>
                            <p class="text-xs font-mono text-slate-500">{{ $c['hex'] }}</p>
                            <p class="text-[10px] text-slate-400 mt-0.5 leading-tight">{{ $c['usage'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Warna Sekunder & Pendukung --}}
                <h3 class="font-bold text-base mt-6 mb-3 flex items-center gap-2"><i class="fa-solid fa-circle-half-stroke text-primary text-sm"></i> Warna Sekunder &amp; Pendukung</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-white/10">
                        <div class="h-10" style="background-color: #d97706;"></div>
                        <div class="px-3 py-2 bg-white dark:bg-slate-800">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">secondary</p>
                            <p class="text-xs font-mono text-slate-500">#d97706</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Amber — badge &amp; aksen hangat</p>
                        </div>
                    </div>
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-white/10">
                        <div class="h-10" style="background-color: #0f172a;"></div>
                        <div class="px-3 py-2 bg-white dark:bg-slate-800">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">slate-950 (dark bg)</p>
                            <p class="text-xs font-mono text-slate-500">#0f172a</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Latar utama mode gelap</p>
                        </div>
                    </div>
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-white/10">
                        <div class="h-10" style="background-color: #1e293b;"></div>
                        <div class="px-3 py-2 bg-white dark:bg-slate-800">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">slate-800 (teks)</p>
                            <p class="text-xs font-mono text-slate-500">#1e293b</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Warna teks utama mode terang</p>
                        </div>
                    </div>
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-white/10">
                        <div class="h-10" style="background: rgba(255,255,255,0.8);backdrop-filter:blur(10px);border:1px solid #e2e8f0;"></div>
                        <div class="px-3 py-2 bg-white dark:bg-slate-800">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">.glass (terang)</p>
                            <p class="text-xs font-mono text-slate-500">rgba(255,255,255,0.8)</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Navbar &amp; kartu glassmorphism</p>
                        </div>
                    </div>
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-white/10">
                        <div class="h-10" style="background: rgba(15,23,42,0.72);"></div>
                        <div class="px-3 py-2 bg-white dark:bg-slate-800">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">.dark .glass</p>
                            <p class="text-xs font-mono text-slate-500">rgba(15,23,42,0.72)</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Glass mode gelap</p>
                        </div>
                    </div>
                    <div class="rounded-xl overflow-hidden border border-slate-200 dark:border-white/10">
                        <div class="h-10" style="background-image:linear-gradient(to right,rgba(34,125,49,0.12) 1px,transparent 1px),linear-gradient(to bottom,rgba(34,125,49,0.12) 1px,transparent 1px);background-size:12px 12px;background-color:#f8fafc;"></div>
                        <div class="px-3 py-2 bg-white dark:bg-slate-800">
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">.bg-grid-pattern</p>
                            <p class="text-xs font-mono text-slate-500">rgba(34,125,49,0.12)</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Pola grid tekstur latar</p>
                        </div>
                    </div>
                </div>

                {{-- Panduan Penggunaan Warna --}}
                <h3 class="font-bold text-base mt-6 mb-3 flex items-center gap-2"><i class="fa-solid fa-circle-info text-primary text-sm"></i> Panduan Penggunaan Warna</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/60">
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 text-left">Konteks</th>
                                <th class="px-4 py-2.5 font-semibold text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 text-left">Kelas Tailwind / Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-slate-600 dark:text-slate-300">
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10">Tombol utama (CTA)</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">bg-primary</code> = <code class="text-xs">#237d31</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10">Hover tombol utama</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">hover:bg-primary-700</code> = <code class="text-xs">#1e6329</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10">Ikon &amp; aksen kecil</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">text-primary</code> atau <code class="text-xs">text-primary-400</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10">Badge &amp; label hijau</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">bg-primary-50 text-primary-700</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10">Garis tepi aksen</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">border-primary</code> / <code class="text-xs">border-primary-200</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10">Aksen peringatan / hangat</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">text-secondary</code> = <code class="text-xs">#d97706</code></td>
                            </tr>
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10">Heading gradient header docs</td>
                                <td class="px-4 py-2.5 border border-slate-200 dark:border-white/10"><code class="text-xs">from-primary to-primary-700</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Elemen Visual Lainnya --}}
                <h3 class="font-bold text-base mt-6 mb-3 flex items-center gap-2"><i class="fa-solid fa-shapes text-primary text-sm"></i> Elemen Visual Lainnya</h3>
                <div class="space-y-3 text-sm text-slate-600 dark:text-slate-300">
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-image text-primary mt-0.5 shrink-0"></i>
                        <div><strong>Logo Organisasi</strong> — <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">public/images/logo-yesl.png</code>. Tampil di navbar, footer, dan halaman Tentang.</div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-images text-primary mt-0.5 shrink-0"></i>
                        <div><strong>Gambar Hero (Slider)</strong> — Efek Ken Burns (zoom in/out bergantian). File gambar di <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">resources/views/components/hero.blade.php</code>.</div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-moon text-primary mt-0.5 shrink-0"></i>
                        <div><strong>Mode Gelap</strong> — Diimplementasikan via kelas <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">dark:</code> Tailwind. Preferensi pengguna disimpan di <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">localStorage</code>.</div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-border-all text-primary mt-0.5 shrink-0"></i>
                        <div><strong>Pola Grid Latar</strong> — Tekstur halus pada beberapa section. Gunakan kelas <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">bg-grid-pattern</code> (didefinisikan di <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">app.css</code>).</div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-circle-half-stroke text-primary mt-0.5 shrink-0"></i>
                        <div><strong>Efek Kaca (Glassmorphism)</strong> — Navbar &amp; kartu overlay. Gunakan kelas <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">glass</code> (<code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">bg-white/80 backdrop-blur</code>).</div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <i class="fa-solid fa-vector-square text-primary mt-0.5 shrink-0"></i>
                        <div><strong>Radius Sudut</strong> — Konsisten menggunakan <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">rounded-xl</code> (12 px) untuk kartu kecil dan <code class="text-xs bg-slate-100 dark:bg-white/10 px-1.5 py-0.5 rounded">rounded-2xl</code> (16 px) untuk container section besar.</div>
                    </div>
                </div>
            </section>

            {{-- Manajemen Blog --}}
            <section id="blog" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-newspaper text-primary"></i> Manajemen Blog</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Menu <strong>Blog</strong> digunakan untuk menulis dan mengelola artikel. Setiap artikel dapat
                    memiliki banyak kategori sekaligus.
                </p>
                <ol class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300 list-decimal list-inside">
                    <li>Klik <strong>Tulis Artikel</strong> untuk membuat artikel baru.</li>
                    <li>Isi judul, konten (editor TinyMCE), pilih satu atau beberapa kategori, dan unggah sampul.</li>
                    <li>Atur <strong>status</strong> (draf/terbit) dan <strong>jadwal publikasi</strong> bila diperlukan.</li>
                    <li>Lengkapi kolom <strong>SEO</strong> (meta) agar artikel optimal di mesin pencari.</li>
                    <li>Artikel yang dihapus masuk ke <strong>Sampah</strong> dan dapat dipulihkan atau dihapus permanen.</li>
                    <li>Fitur <strong>Cari artikel</strong> dengan kata kunci terkait</li>
                    <li>Tersedia <strong>Filter Kategori atau Status</strong> untuk menampilkan data sesuai pengelompokan data</li>
                </ol>
            </section>

            {{-- Kategori --}}
            <section id="kategori" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-tags text-primary"></i> Kategori</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Menu <strong>Kategori</strong> mengelola label konten yang dipakai pada artikel maupun album.
                    Buat kategori terlebih dahulu agar bisa dipilih saat membuat artikel atau album.
                </p>
            </section>

            {{-- Album & Galeri --}}
            <section id="album" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-images text-primary"></i> Album &amp; Galeri</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Menu <strong>Album &amp; Galeri</strong> mengelola kumpulan foto yang tampil di halaman galeri publik.
                </p>
                <ol class="mt-4 space-y-2 text-sm text-slate-600 dark:text-slate-300 list-decimal list-inside">
                    <li>Klik <strong>Buat Album</strong>, lalu isi judul dan deskripsi album.</li>
                    <li>Unggah <strong>banyak foto</strong> sekaligus ke dalam album.</li>
                    <li>Hapus foto individual bila diperlukan langsung dari halaman album.</li>
                    <li>Album yang dihapus juga masuk ke <strong>Sampah</strong> dan dapat dipulihkan.</li>
                    <li>Fitur <strong>Cari album</strong> dengan kata kunci terkait</li>
                    <li>Tersedia <strong>Filter Kategori atau Status</strong> untuk menampilkan data sesuai pengelompokan data</li>
                </ol>
            </section>

            {{-- Media & Editor --}}
            <section id="media" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-photo-film text-primary"></i> Media &amp; Editor</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Editor artikel menggunakan <strong>TinyMCE</strong>. Anda dapat
                    mengunggah gambar langsung dari dalam editor; berkas akan disimpan di penyimpanan aplikasi dan
                    otomatis disisipkan ke konten.
                </p>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Gunakan gambar dengan ukuran wajar agar halaman tetap ringan. Aktifkan <em>lazy-loading</em> bawaan
                    dengan menyisipkan gambar melalui editor.
                </p>
            </section>

            {{-- Pengguna --}}
            <section id="pengguna" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-users-gear text-primary"></i> Pengguna <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full bg-primary-50 text-primary-700 dark:bg-primary-500/10 dark:text-primary-300">Admin</span></h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Menu <strong>Pengguna</strong> hanya tersedia untuk <strong>admin</strong>. Di sini admin dapat
                    membuat akun operator, mengubah data, mereset kata sandi, dan menghapus akun.
                </p>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-3">
                    <i class="fa-solid fa-circle-info"></i> Operator tidak melihat menu ini karena keterbatasan hak akses.
                </p>
            </section>

            {{-- Profil & Keamanan --}}
            <section id="profil" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-user-gear text-primary"></i> Profil &amp; Keamanan</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Menu <strong>Profil</strong> memungkinkan setiap pengguna memperbarui nama, email, dan kata sandi
                    sendiri. Demi keamanan, ganti kata sandi bawaan segera setelah login pertama.
                </p>
            </section>

            {{-- Tips & FAQ --}}
            <section id="faq" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-circle-question text-primary"></i> Tips &amp; FAQ</h2>
                <div class="mt-4 space-y-4 text-sm text-slate-600 dark:text-slate-300">
                    <div>
                        <p class="font-semibold text-slate-800 dark:text-slate-100">Bagaimana menampilkan artikel di situs publik?</p>
                        <p class="mt-1">Atur status artikel menjadi <strong>Terbit</strong>. Artikel berstatus draf tidak tampil di halaman publik.</p>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800 dark:text-slate-100">Apakah artikel yang terhapus bisa dikembalikan?</p>
                        <p class="mt-1">Bisa. Buka halaman <strong>Sampah</strong> pada Blog atau Album, lalu pilih <strong>Pulihkan</strong>.</p>
                    </div>
                    <div>
                        <p class="font-semibold text-slate-800 dark:text-slate-100">Bagaimana mengganti tema gelap/terang?</p>
                        <p class="mt-1">Klik ikon bulan/matahari di bilah atas dashboard. Preferensi tersimpan di peramban Anda.</p>
                    </div>
                </div>
            </section>
        </div>

        {{-- Navigasi mengambang (kanan) untuk section dokumentasi --}}
        <aside class="docs-floating-nav hidden xl:block fixed right-6 top-24 z-20 w-56">
            <div class="bg-white/90 dark:bg-slate-900/90 backdrop-blur rounded-2xl border border-slate-200 dark:border-white/10 p-3 shadow-lg">
                <p class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wide text-slate-400">Di halaman ini</p>
                <nav class="space-y-0.5">
                    @foreach ($sections as $s)
                        <a href="#{{ $s['id'] }}"
                            @click="active = @js($s['id'])"
                            :class="active === @js($s['id']) ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5'"
                            class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm font-medium transition">
                            <i class="fa-solid {{ $s['icon'] }} w-4 text-center text-xs"></i>
                            <span>{{ $s['title'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        </aside>
    </div>
@endsection

@push('scripts')
<style>
@media print {
    /* Sembunyikan chrome dashboard: sidebar, topbar, footer */
    body > aside,
    body > div > header,
    body > div > footer,
    /* Sembunyikan navigasi mengambang docs & tombol cetak */
    .docs-floating-nav,
    .no-print {
        display: none !important;
    }

    /* Hapus margin sidebar agar konten full-width */
    .md\:ml-64 {
        margin-left: 0 !important;
    }

    /* Hapus padding main saat cetak */
    body > div > main {
        padding: 0 !important;
    }

    /* Pastikan background putih & teks gelap */
    html, body {
        background-color: #fff !important;
        color: #1e293b !important;
    }

    /* Hindari section terpotong di tengah halaman */
    section {
        break-inside: avoid;
        page-break-inside: avoid;
        margin-bottom: 0.75rem !important;
    }

    /* Ukuran & margin kertas */
    @page {
        size: A4;
        margin: 1.5cm 2cm;
    }
}
</style>
@endpush
