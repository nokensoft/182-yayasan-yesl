@extends('layouts.dashboard')

@section('page_title', 'Dokumentasi Sistem')

@php
    $sections = [
        ['id' => 'ikhtisar', 'icon' => 'fa-circle-info', 'title' => 'Ikhtisar Sistem'],
        ['id' => 'peran', 'icon' => 'fa-user-shield', 'title' => 'Peran & Hak Akses'],
        ['id' => 'blog', 'icon' => 'fa-newspaper', 'title' => 'Manajemen Blog'],
        ['id' => 'kategori', 'icon' => 'fa-tags', 'title' => 'Kategori'],
        ['id' => 'album', 'icon' => 'fa-images', 'title' => 'Album & Galeri'],
        ['id' => 'media', 'icon' => 'fa-photo-film', 'title' => 'Media & Editor'],
        ['id' => 'pengguna', 'icon' => 'fa-users-gear', 'title' => 'Pengguna (Admin)'],
        ['id' => 'profil', 'icon' => 'fa-user-gear', 'title' => 'Profil & Keamanan'],
        ['id' => 'faq', 'icon' => 'fa-circle-question', 'title' => 'Tips & FAQ'],
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
                <p class="text-xs font-bold uppercase tracking-wide text-white/70">Panduan Penggunaan</p>
                <h2 class="text-2xl md:text-3xl font-extrabold mt-1">Dokumentasi Sistem</h2>
                <p class="text-white/90 mt-2 text-sm md:text-base">
                    Panduan penggunaan panel admin {{ config('app.name') }} untuk admin dan operator.
                    Gunakan navigasi di kanan untuk berpindah antar bagian.
                </p>
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

            {{-- Peran & Hak Akses --}}
            <section id="peran" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-user-shield text-primary"></i> Peran &amp; Hak Akses</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3">Terdapat dua peran pengguna dengan cakupan akses berbeda:</p>
                <div class="grid sm:grid-cols-2 gap-4 mt-4">
                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <h3 class="font-bold flex items-center gap-2"><i class="fa-solid fa-crown text-primary"></i> Admin</h3>
                        <ul class="mt-2 space-y-1.5 text-sm text-slate-600 dark:text-slate-300">
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Akses penuh ke seluruh modul.</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Mengelola akun pengguna (operator).</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Mengelola Blog, Kategori, dan Album.</li>
                        </ul>
                    </div>
                    <div class="rounded-xl border border-slate-200 dark:border-white/10 p-4">
                        <h3 class="font-bold flex items-center gap-2"><i class="fa-solid fa-user-pen text-slate-400"></i> Operator</h3>
                        <ul class="mt-2 space-y-1.5 text-sm text-slate-600 dark:text-slate-300">
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Mengelola konten Blog &amp; Album/Galeri.</li>
                            <li class="flex gap-2"><i class="fa-solid fa-check text-primary mt-1"></i> Mengelola Kategori.</li>
                            <li class="flex gap-2"><i class="fa-solid fa-xmark text-red-500 mt-1"></i> Tidak dapat mengelola pengguna.</li>
                        </ul>
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
                </ol>
            </section>

            {{-- Media & Editor --}}
            <section id="media" class="scroll-mt-24 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-6">
                <h2 class="font-bold text-lg flex items-center gap-2"><i class="fa-solid fa-photo-film text-primary"></i> Media &amp; Editor</h2>
                <p class="text-sm text-slate-600 dark:text-slate-300 mt-3 leading-relaxed">
                    Editor artikel menggunakan <strong>TinyMCE</strong> (self-hosted, tanpa API key). Anda dapat
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
        <aside class="hidden xl:block fixed right-6 top-24 z-20 w-56">
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
