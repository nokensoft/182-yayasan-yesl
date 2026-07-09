@extends('layouts.app')

@section('page_title', 'Beranda')
@section('meta_description', 'Yayasan Ekologi Sahul Lestari (YESL) — organisasi nirlaba untuk pelestarian ekologi, konservasi keanekaragaman hayati, dan penguatan hak masyarakat adat di Tanah Papua sejak 2019.')

@php
    $orgLd = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'Yayasan Ekologi Sahul Lestari',
        'alternateName' => 'YESL',
        'url' => route('home'),
        'logo' => asset('images/logo-yesl.png'),
        'foundingDate' => '2019',
        'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Timika', 'addressRegion' => 'Papua Tengah', 'addressCountry' => 'ID'],
        'email' => 'info@yesl.or.id',
    ];
@endphp
@push('head')
<script type="application/ld+json">@json($orgLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')

    {{-- HERO --}}
    <section id="beranda" class="relative min-h-screen flex items-center overflow-hidden pt-28 pb-16">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/bg1.png') }}" class="w-full h-full object-cover" alt="Kegiatan YESL di Tanah Papua" fetchpriority="high">
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-white/30 dark:from-slate-950 dark:via-slate-950/90 dark:to-slate-950/40"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold mb-6 tracking-wide uppercase">Organisasi Nirlaba Ekologi & Masyarakat Adat Papua</span>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-[1.1] mb-6">
                    Menjaga <span class="text-primary">Ekologi Sahul</span> untuk Kedaulatan Masyarakat Adat.
                </h1>
                <p class="text-lg text-slate-600 dark:text-slate-300 mb-8 max-w-lg leading-relaxed">
                    Yayasan Ekologi Sahul Lestari (YESL) hadir di Tanah Papua sejak 2019 untuk melindungi kedaulatan masyarakat adat dalam pengelolaan daratan dan perairan secara berkelanjutan.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#tentang" class="px-7 py-3.5 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/25 hover:-translate-y-0.5 transition">Pelajari Lebih Lanjut</a>
                    <a href="{{ route('blog.index') }}" class="px-7 py-3.5 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-100 border border-slate-200 dark:border-white/10 rounded-2xl font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-newspaper text-primary"></i> Baca Blog
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="bg-white dark:bg-slate-900 p-8 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-white/10">
                    <div class="flex justify-center mb-6 pb-6 border-b border-slate-100 dark:border-white/10">
                        <img src="{{ asset('images/logo-yesl.png') }}" alt="Logo utama YESL" class="h-36 w-auto object-contain" loading="lazy">
                    </div>
                    <div class="grid grid-cols-2 gap-6 text-center">
                        <div>
                            <p class="text-3xl font-extrabold text-primary mb-1">2019</p>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tahun Berdiri</p>
                        </div>
                        <div>
                            <p class="text-3xl font-extrabold text-primary mb-1">Mimika</p>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pusat Operasional</p>
                        </div>
                        <div class="col-span-2 border-t border-slate-100 dark:border-white/10 pt-5">
                            <p class="text-3xl font-extrabold text-secondary mb-1">Tanah Papua</p>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Jangkauan Program</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- BLOG + KATEGORI (dinamis via API + Alpine) --}}
    <section id="blog" class="py-20 px-6 bg-white dark:bg-slate-900"
        x-data="blogSection()" x-init="init()">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 rounded-full text-xs font-bold tracking-wide uppercase">Kabar Terbaru</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-3">Blog & Artikel YESL</h2>
                    <p class="text-slate-600 dark:text-slate-400 max-w-2xl">Cerita dari lapangan, catatan refleksi, dan perkembangan program pemberdayaan masyarakat adat serta pelestarian lingkungan.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-primary-700 transition shadow-md shrink-0">
                    Semua Artikel <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            {{-- Filter kategori --}}
            <div class="flex flex-wrap gap-2 mb-8">
                <button @click="filter('')" :class="activeCategory === '' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                    class="px-4 py-1.5 rounded-full text-sm font-semibold transition">Semua</button>
                <template x-for="cat in categories" :key="cat.slug">
                    <button @click="filter(cat.slug)" :class="activeCategory === cat.slug ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                        class="px-4 py-1.5 rounded-full text-sm font-semibold transition">
                        <span x-text="cat.name"></span>
                    </button>
                </template>
            </div>

            {{-- Loading --}}
            <div x-show="loading" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <template x-for="i in 4" :key="i">
                    <div class="animate-pulse bg-slate-100 dark:bg-white/5 rounded-3xl h-72"></div>
                </template>
            </div>

            {{-- Empty --}}
            <div x-show="!loading && posts.length === 0" class="text-center py-14 text-slate-500">
                <i class="fa-regular fa-folder-open text-4xl mb-3"></i>
                <p>Belum ada artikel yang dipublikasikan.</p>
            </div>

            {{-- Grid --}}
            <div x-show="!loading && posts.length > 0" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <template x-for="post in posts" :key="post.slug">
                    <a :href="post.url" class="group bg-slate-50 dark:bg-slate-800/50 rounded-3xl overflow-hidden border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex flex-col">
                        <div class="relative overflow-hidden h-44 bg-slate-100 dark:bg-white/5">
                            <img :src="post.cover_image" :alt="post.title" x-show="post.cover_image" loading="lazy"
                                class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex flex-wrap gap-1 mb-3">
                                <template x-for="c in post.categories" :key="c.slug">
                                    <span class="bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 text-[10px] font-bold px-2 py-0.5 rounded-full" x-text="c.name"></span>
                                </template>
                            </div>
                            <h3 class="text-base font-bold mb-2 line-clamp-2 group-hover:text-primary transition-colors" x-text="post.title"></h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3 flex-1" x-text="post.excerpt"></p>
                            <div class="flex justify-between items-center pt-3 mt-3 border-t border-slate-200/60 dark:border-white/10 text-xs text-slate-400 font-medium">
                                <span x-text="post.published_human"></span>
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> <span x-text="post.views"></span></span>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </section>

    
    {{-- TENTANG --}}
    <section id="tentang" class="relative py-24 px-6 overflow-hidden bg-slate-50 dark:bg-slate-950">
        <div class="absolute inset-0 bg-grid-pattern pointer-events-none opacity-70"></div>
        <div class="max-w-7xl mx-auto relative z-10 grid md:grid-cols-2 gap-x-14 gap-y-10 items-start">
            
            {{-- Judul Besar Section --}}
            <div class="md:col-span-2 text-center max-w-3xl mx-auto mb-4">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Tentang <span class="text-primary">YESL</span></h2>
            </div>

            {{-- KOLOM KIRI: LOGO & INFORMASI DETIL (Arti nama, Logo, Program Kerja) --}}
            <div class="space-y-6">
                {{-- Box Logo --}}
                <div class="relative bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-2xl border border-slate-100 dark:border-white/10 p-10 md:p-16 flex items-center justify-center overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
                    <img src="{{ asset('images/logo-yesl.png') }}" alt="Logo Yayasan Ekologi Sahul Lestari (YESL)" class="relative w-full max-w-xs h-auto object-contain" loading="lazy">
                </div>

                @php
                    $programKerja = [
                        ['Pemetaan Partisipatif Wilayah Adat', 'Mendampingi komunitas memetakan ruang darat dan perairan sebagai dasar pengakuan serta tata kelola wilayah adat.'],
                        ['Penguatan Ekonomi Lokal Berkelanjutan', 'Mengembangkan potensi komoditas dan usaha komunitas yang adil tanpa merusak kelestarian alam.'],
                        ['Perhutanan Sosial & Konservasi Komunitas', 'Mendorong pengelolaan hutan desa serta pelibatan perempuan dan generasi muda dalam upaya konservasi.'],
                    ];
                @endphp

                {{-- Akordion Informasi Detil --}}
                <div x-data="{ open: 1 }" class="space-y-3">
                    {{-- Arti Nama YESL --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/10 overflow-hidden">
                        <button type="button" @click="open = (open === 1 ? null : 1)" class="w-full flex items-center gap-3 p-4 text-left">
                            <span class="w-11 h-11 bg-primary-50 dark:bg-primary-500/10 rounded-xl flex items-center justify-center text-primary shrink-0"><i class="fa-solid fa-seedling"></i></span>
                            <span class="font-bold flex-1">Arti Nama YESL</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 transition-transform" :class="open === 1 && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === 1" x-transition class="px-4 pb-4">
                            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Ekologi berarti relasi makhluk hidup dan lingkungannya, Sahul merujuk bentang biogeografi Australia-Papua, dan Lestari menegaskan komitmen menjaga keberlanjutan.</p>
                        </div>
                    </div>

                    {{-- Filosofi Logo --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/10 overflow-hidden">
                        <button type="button" @click="open = (open === 2 ? null : 2)" class="w-full flex items-center gap-3 p-4 text-left">
                            <span class="w-11 h-11 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary shrink-0"><i class="fa-solid fa-shapes"></i></span>
                            <span class="font-bold flex-1">Filosofi Logo</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 transition-transform" :class="open === 2 && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === 2" x-cloak x-transition class="px-4 pb-4">
                            <div class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed space-y-3">
                                <p><strong>Dasar Warna Putih:</strong> Mencerminkan kasih yang tulus dan saling membangun kepercayaan untuk bekerja sama dalam membangun tanah Papua.</p>
                                <p><strong>Warna Hijau:</strong> Memberikan makna keberlanjutan tanah dan Manusia Papua secara mandiri dan berkeadilan.</p>
                                <p><strong>Gambar Pulau Papua & Corak Daun:</strong> Menggambarkan tingginya keanekaragaman bentang alam serta keanekaragaman hayati dan keberagaman sosial budaya wilayah adat yang ada di Tanah Papua.</p>
                                <p><strong>Lingkaran yang Terputus:</strong> Mengartikan sejarah biogeografi pulau Papua yang terputus dari benua Australia, di mana dulunya merupakan satu kesatuan daratan yang disebut dengan Paparan Sahul.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Program Kerja --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/10 overflow-hidden">
                        <button type="button" @click="open = (open === 3 ? null : 3)" class="w-full flex items-center gap-3 p-4 text-left">
                            <span class="w-11 h-11 bg-primary-50 dark:bg-primary-500/10 rounded-xl flex items-center justify-center text-primary shrink-0"><i class="fa-solid fa-diagram-project"></i></span>
                            <span class="font-bold flex-1">Focus Program Kerja</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 transition-transform" :class="open === 3 && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === 3" x-cloak x-transition class="px-4 pb-4">
                            <ul class="space-y-3">
                                @foreach ($programKerja as [$judul, $ket])
                                    <li class="flex items-start gap-3">
                                        <i class="fa-solid fa-circle-check text-primary mt-1 text-xs shrink-0"></i>
                                        <div>
                                            <p class="font-semibold text-sm">{{ $judul }}</p>
                                            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">{{ $ket }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: DESKRIPSI YAYASAN --}}
            <div class="space-y-6 pt-2 md:pt-6">
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify mb-3" style="text-align: justify;">
                    <strong>Yayasan Ekologi Sahul Lestari (YESL)</strong> merupakan organisasi nirlaba yang hadir di Tanah Papua sejak tahun 2019 dan berkedudukan di Kabupaten Mimika Provinsi Papua Tengah. Memiliki misi melindungi kedaulatan masyarakat adat dalam pengelolaan daratan dan perairan sebagai identitas jati diri dan sumber penghidupan secara berkelanjutan.
                </p>
                    
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify mb-3" style="text-align: justify;">
                    Sejan terbentuk, Yayasan Ekologi Sahul Lestari telah bekerja sama dengan komunitas dan kelembagaan adat di wilayah Tanah Papua sebagai pemberi mandat dalam pendokumentasian bersama Profil Masyarakat Adat, baik sejarah, wilayah pengelolaan sumber daya alam dalam konteks Sumber penghidupan sehari-hari maupun sebagai identitas jati diri. Pendokumentian bersama terkait struktur dan kelembagaan adat, hukum adat, harta kekayaan adat, dan keanekaragaman hayati yang penting bagi pelestarian nilai budaya setempat. 
                </p>

                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify mb-3" style="text-align: justify;">
                    Hasil pendukumentasian Profil Masyarakat Adat ini kemudian diadvokasi menjadi arahan kebijakan regulasi, perencanaan dan program kegiatan bersama Masyarakat adat sebagai pemegang mandat dengan Dukungan kolaborasi mitra pembangunan baik pemerintah pusat dan daerah, mitra donor, mitra cso dan sektor swasta.
                </p>
                    
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify mb-3" style="text-align: justify;">
                    Kami memberikan solusi inovatif untuk mewujudkan pembangunan berkelanjutan melalui tata kelola sumber daya alam yang efektif berbasis kearifan lokal, mengutamakan pendekatan kesetaraan gender, serta membangun kolaborasi bersama semua pihak demi masa depan yang lestari.
                </p>
            </div>

            {{-- Tombol aksi ke Visi & Misi dan Nilai Inti --}}
            <div class="md:col-span-2 flex flex-wrap justify-center gap-3 pt-6 w-full">
                <a href="#struktur" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-primary text-white font-semibold hover:bg-primary-700 transition shadow-md shadow-primary/20">
                    <i class="fa-solid fa-bullseye"></i> Visi & Misi
                </a>
                <a href="#nilai" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-white/10 font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    <i class="fa-solid fa-leaf text-primary"></i> Nilai Inti
                </a>
            </div>
        </div>
    </section>



    {{-- VISI MISI --}}
    <section id="struktur" class="py-24 px-6 bg-white dark:bg-slate-900">
        <div class="max-w-3xl mx-auto text-center mb-14">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Visi & Misi</h2>
            <p class="text-slate-500 dark:text-slate-400">"Terwujudnya tata kelola sumber daya alam yang adil dan lestari bagi komunitas adat di Tanah Papua."</p>
        </div>
        @php
            $visiMisi = [
                ['fa-bullseye', 'Visi', 'Tata kelola sumber daya alam yang adil dan lestari bagi komunitas adat di Tanah Papua.'],
                ['fa-list-check', 'Misi', 'Memperkuat kapasitas masyarakat adat, mendorong pengakuan hukum wilayah adat, serta mengembangkan ekonomi lokal berkelanjutan.'],
                ['fa-location-dot', 'Lokasi', 'Berkedudukan di Kabupaten Mimika, Papua Tengah, bekerja bersama komunitas adat di berbagai wilayah Papua.'],
            ];
        @endphp
        <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach ($visiMisi as [$icon, $title, $desc])
                <div class="group bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-100 dark:border-white/10 hover:shadow-xl transition">
                    <div class="w-14 h-14 bg-primary-50 dark:bg-primary-500/10 rounded-2xl flex items-center justify-center text-primary text-2xl mb-5 group-hover:scale-110 transition"><i class="fa-solid {{ $icon }}"></i></div>
                    <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- NILAI --}}
    <section id="nilai" class="py-24 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Nilai Inti</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4">Nilai-Nilai Organisasi</h2>
            </div>
            @php
                $nilai = [
                    ['Menghormati HAM', 'Mengutamakan nilai Hak Asasi Manusia dalam sikap, tindakan, dan pengambilan keputusan.'],
                    ['Demokratis', 'Melibatkan konstituen secara aktif dan setara dalam proses keputusan kolektif.'],
                    ['Keadilan Gender', 'Menjamin hak atas kehidupan dan lingkungan layak tanpa diskriminasi.'],
                    ['Keadilan Generasi', 'Menjaga kesamaan hak antar generasi melalui perlibatan konstituen.'],
                    ['Keadilan Ekologis', 'Memastikan akses manfaat sumber daya alam dan keragaman cara pengelolaan.'],
                    ['Anti Kekerasan', 'Menolak segala bentuk praktik kekerasan oleh individu, kelompok, modal, maupun negara.'],
                ];
            @endphp
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($nilai as [$title, $desc])
                    <div class="p-5 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10">
                        <h4 class="font-bold mb-2 flex items-center gap-2"><i class="fa-solid fa-leaf text-primary text-sm"></i> {{ $title }}</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- GALERI (dinamis via API + Alpine) --}}
    <section id="galeri" class="py-24 px-6 bg-white dark:bg-slate-900" x-data="gallerySection()" x-init="init()">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Dokumentasi</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-3">Album & Galeri Kegiatan</h2>
                    <p class="text-slate-600 dark:text-slate-400 max-w-2xl">Ringkasan capaian program dari pemetaan partisipatif, kajian masyarakat adat, hingga perhutanan sosial di Tanah Papua.</p>
                </div>
                <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-primary-700 transition shadow-md shrink-0">
                    Semua Album <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div x-show="loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="i in 3" :key="i"><div class="animate-pulse bg-slate-100 dark:bg-white/5 rounded-3xl h-60"></div></template>
            </div>

            <div x-show="!loading && albums.length === 0" class="text-center py-14 text-slate-500">
                <i class="fa-regular fa-images text-4xl mb-3"></i>
                <p>Belum ada album yang dipublikasikan.</p>
            </div>

            <div x-show="!loading && albums.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="album in albums" :key="album.slug">
                    <a :href="album.url" class="group bg-slate-50 dark:bg-slate-800/50 p-4 rounded-3xl border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        <div class="aspect-[1.91/1] overflow-hidden rounded-2xl border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/5">
                            <img :src="album.cover_image" :alt="album.title" x-show="album.cover_image" loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <p class="mt-4 text-base font-bold leading-snug group-hover:text-primary transition-colors" x-text="album.title"></p>
                        <div class="mt-3 pt-3 border-t border-slate-200/60 dark:border-white/10 flex items-center justify-between text-xs text-slate-400 font-medium">
                            <span class="flex items-center gap-1.5 bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 px-2.5 py-1 rounded-md text-[11px] font-bold">
                                <i class="fa-regular fa-images"></i> <span x-text="album.photos_count + ' Foto'"></span>
                            </span>
                            <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> <span x-text="album.views"></span></span>
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </section>

    {{-- DONASI --}}
    <section id="donasi" class="py-24 px-6 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative h-full rounded-3xl overflow-hidden border border-white/10 shadow-2xl">
                <img src="{{ asset('images/pemetaan-profil-adat.jpg') }}" alt="Dukung Aksi Ekologi YESL" class="w-full h-full object-cover" loading="lazy">
            </div>
            <div>
                <span class="inline-block px-3.5 py-1.5 bg-primary-500/20 border border-primary-400/30 text-primary-300 rounded-full text-xs font-bold tracking-wider uppercase mb-4">Mari Berkontribusi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-6">Dukung Aksi Nyata Pelestarian Ekologi & Masyarakat Adat Papua</h2>
                <p class="text-slate-300 mb-8 leading-relaxed">Setiap dukungan Anda dialokasikan langsung untuk pemetaan partisipatif wilayah adat, penguatan perempuan pengelola hutan desa, dan kajian ekosobling di garda terdepan Papua.</p>
                <a href="https://wa.me/62811490000" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-3 px-7 py-3.5 bg-primary text-white font-bold rounded-2xl hover:bg-primary-600 transition shadow-xl">
                    <i class="fa-brands fa-whatsapp text-xl"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-7xl mx-auto relative overflow-hidden bg-primary rounded-[2.5rem] p-12 md:p-16 text-center">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-5">Siap Berkolaborasi untuk Tata Kelola SDA yang Adil?</h2>
                <p class="text-primary-50 mb-8 max-w-xl mx-auto">Bersama YESL, mari memperkuat kapasitas masyarakat adat, perlindungan wilayah adat, dan ekonomi lokal berkelanjutan.</p>
                <a href="#kontak" class="bg-white text-primary-700 px-8 py-3.5 rounded-2xl font-extrabold hover:bg-slate-100 transition shadow-xl">Hubungi YESL</a>
            </div>
        </div>
    </section>

@endsection

@push('head')
<script>
    function blogSection() {
        return {
            posts: [], categories: [], activeCategory: '', loading: true,
            async init() {
                await this.loadCategories();
                await this.loadPosts();
            },
            async loadCategories() {
                try {
                    const res = await fetch('{{ route('api.categories') }}');
                    const json = await res.json();
                    this.categories = (json.data || []).filter(c => c.posts_count > 0);
                } catch (e) { this.categories = []; }
            },
            async loadPosts() {
                this.loading = true;
                try {
                    const url = new URL('{{ route('api.posts') }}');
                    url.searchParams.set('per_page', '8');
                    if (this.activeCategory) url.searchParams.set('category', this.activeCategory);
                    const res = await fetch(url);
                    const json = await res.json();
                    this.posts = json.data || [];
                } catch (e) { this.posts = []; }
                this.loading = false;
            },
            filter(slug) { this.activeCategory = slug; this.loadPosts(); },
        };
    }

    function gallerySection() {
        return {
            albums: [], loading: true,
            async init() {
                try {
                    const res = await fetch('{{ route('api.albums') }}?per_page=6');
                    const json = await res.json();
                    this.albums = json.data || [];
                } catch (e) { this.albums = []; }
                this.loading = false;
            },
        };
    }
</script>
@endpush
