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
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/75 to-slate-950/30"></div>
            <div class="absolute inset-x-0 top-0 h-44 bg-gradient-to-b from-white/85 via-white/30 to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-3xl mx-auto px-6 w-full text-center">
            <span class="inline-block px-4 py-1.5 bg-primary-500/20 border border-primary-400/30 text-primary-300 rounded-full text-xs font-bold mb-6 tracking-wide uppercase">Organisasi Nirlaba Ekologi & Masyarakat Adat Papua</span>
            <h1 class="text-4xl md:text-6xl font-extrabold leading-[1.1] mb-6 text-white">
                Menjaga <span class="text-primary-300">Ekologi Sahul</span> untuk Kedaulatan Masyarakat Adat.
            </h1>
            <p class="text-lg text-slate-200 mb-8 max-w-2xl mx-auto leading-relaxed">
                Yayasan Ekologi Sahul Lestari (YESL) hadir di Tanah Papua sejak 2019 untuk melindungi kedaulatan masyarakat adat dalam pengelolaan daratan dan perairan secara berkelanjutan.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="#tentang" class="px-7 py-3.5 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/25 hover:-translate-y-0.5 transition">Pelajari Lebih Lanjut</a>
                <a href="{{ route('blog.index') }}" class="px-7 py-3.5 bg-white/10 text-white border border-white/25 rounded-2xl font-bold hover:bg-white/20 transition flex items-center gap-2 backdrop-blur-sm">
                    <i class="fa-solid fa-newspaper text-primary-300"></i> Baca Blog
                </a>
            </div>
        </div>
    </section>

    {{-- BLOG + KATEGORI (dinamis via API + Alpine) --}}
    <section id="blog" class="py-24 px-6 bg-white dark:bg-slate-900"
        x-data="blogSection()" x-init="init()">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Kabar Terbaru</span>
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
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Profil Organisasi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4">Tentang <span class="text-primary">YESL</span></h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed mt-4">Mengenal lebih dekat jati diri, makna nama dan logo, serta komitmen YESL dalam mendampingi masyarakat adat di Tanah Papua.</p>
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
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm overflow-hidden">
                        <button type="button" @click="open = (open === 1 ? null : 1)" class="w-full flex items-center gap-3 p-4 text-left hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <span class="w-11 h-11 bg-primary-50 dark:bg-primary-500/10 rounded-xl flex items-center justify-center text-primary shrink-0"><i class="fa-solid fa-seedling"></i></span>
                            <span class="font-bold flex-1">Arti Nama YESL</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 transition-transform duration-300" :class="open === 1 && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === 1" x-transition class="px-4 pb-4">
                            <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Ekologi berarti relasi makhluk hidup dan lingkungannya, Sahul merujuk bentang biogeografi Australia-Papua, dan Lestari menegaskan komitmen menjaga keberlanjutan.</p>
                        </div>
                    </div>

                    {{-- Filosofi Logo --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm overflow-hidden">
                        <button type="button" @click="open = (open === 2 ? null : 2)" class="w-full flex items-center gap-3 p-4 text-left hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <span class="w-11 h-11 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary shrink-0"><i class="fa-solid fa-shapes"></i></span>
                            <span class="font-bold flex-1">Filosofi Logo</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 transition-transform duration-300" :class="open === 2 && 'rotate-180'"></i>
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
                </div>
            </div>

            {{-- KOLOM KANAN: DESKRIPSI YAYASAN --}}
            <div class="space-y-6 pt-2 md:pt-6">
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify">
                    <strong>Yayasan Ekologi Sahul Lestari (YESL)</strong> merupakan organisasi nirlaba yang hadir di Tanah Papua sejak tahun 2019 dan berkedudukan di Kabupaten Mimika Provinsi Papua Tengah. Memiliki misi melindungi kedaulatan masyarakat adat dalam pengelolaan daratan dan perairan sebagai identitas jati diri dan sumber penghidupan secara berkelanjutan.
                </p>
                    
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify">
                    Sejan terbentuk, Yayasan Ekologi Sahul Lestari telah bekerja sama dengan komunitas dan kelembagaan adat di wilayah Tanah Papua sebagai pemberi mandat dalam pendokumentasian bersama Profil Masyarakat Adat, baik sejarah, wilayah pengelolaan sumber daya alam dalam konteks Sumber penghidupan sehari-hari maupun sebagai identitas jati diri. Pendokumentian bersama terkait struktur dan kelembagaan adat, hukum adat, harta kekayaan adat, dan keanekaragaman hayati yang penting bagi pelestarian nilai budaya setempat. 
                </p>

                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify">
                    Hasil pendukumentasian Profil Masyarakat Adat ini kemudian diadvokasi menjadi arahan kebijakan regulasi, perencanaan dan program kegiatan bersama Masyarakat adat sebagai pemegang mandat dengan Dukungan kolaborasi mitra pembangunan baik pemerintah pusat dan daerah, mitra donor, mitra cso dan sektor swasta.
                </p>
                    
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify">
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




    {{-- SECTION VISI MISI --}}
    <section id="struktur" class="relative py-24 px-6 overflow-hidden bg-white dark:bg-slate-900">
        {{-- Dekorasi latar --}}
        <div class="absolute top-0 -left-24 w-72 h-72 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 -right-24 w-72 h-72 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Header Kontainer Visi --}}
        <div class="relative z-10 max-w-5xl mx-auto text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Arah Organisasi</span>
            <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Visi & Misi</h2>
            <p class="text-slate-600 dark:text-slate-400 leading-relaxed max-w-2xl mx-auto">Landasan arah dan komitmen YESL dalam mewujudkan tata kelola sumber daya alam yang berkelanjutan, berkeadilan, dan kolaboratif di Tanah Papua.</p>
            {{-- Visi Utama --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-primary/10 via-primary/5 to-transparent dark:from-primary/20 dark:via-primary/10 dark:to-transparent p-8 md:p-10 rounded-3xl border border-primary/15 max-w-3xl mx-auto mt-8 shadow-sm">
                <i class="fa-solid fa-quote-left absolute -top-4 left-4 text-7xl text-primary/10 dark:text-primary/15 pointer-events-none select-none"></i>
                <div class="relative">
                    <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-primary mb-3">
                        <i class="fa-solid fa-eye"></i> Visi Kami
                    </span>
                    <p class="text-slate-700 dark:text-slate-200 text-lg md:text-xl font-medium leading-relaxed">
                        Terwujudnya bentang alam yang lestari dan kemandirian masyarakat adat melalui tata kelola sumberdaya alam yang berkelanjutan, berkeadilan dan kolaboratif di Tanah Papua.
                    </p>
                </div>
            </div>
        </div>

        @php
            $misiPoin = [
                'Melindungi dan mengelola bentang alam dan keanekaragaman hayati secara berkelanjutan.',
                'Memperkuat kapasitas hak dan ketahanan masyarakat dalam mengelola sumber daya alam secara mandiri dan berkelanjutan.',
                'Mengembangkan model pemberdayaan ekonomi yang inklusif dan berkelanjutan dalam meningkatkan kesejahteraan masyarakat adat.',
                'Mendorong kolaborasi multi pihak dan kebijakan dalam mendukung perlindungan dan pengelolaan bentang alam dan pemberdayaan ekonomi berbasis masyarakat adat yang berkelanjutan.',
                'Membangun organisasi yang profesional, akuntabel, inovatif dan berkelanjutan.'
            ];
        @endphp

        {{-- Grid Misi & Wilayah Kerja --}}
        <div class="relative z-10 grid lg:grid-cols-3 gap-6 max-w-5xl mx-auto items-start">
            
            {{-- Kolom Misi (2 Kolom) --}}
            <div class="lg:col-span-2 bg-slate-50 dark:bg-slate-800/50 p-8 md:p-10 rounded-3xl border border-slate-200 dark:border-white/10 shadow-sm">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary text-xl shadow-inner shrink-0">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h3 class="text-2xl font-bold">Misi Yayasan</h3>
                </div>
                
                <ul class="space-y-1">
                    @foreach ($misiPoin as $index => $misi)
                        <li class="group flex items-start gap-4 p-3 -mx-3 rounded-2xl hover:bg-white dark:hover:bg-white/5 transition-colors">
                            <span class="w-8 h-8 bg-primary text-white text-sm font-bold rounded-full flex items-center justify-center shrink-0 shadow-sm shadow-primary/30 group-hover:scale-110 transition-transform">
                                {{ $index + 1 }}
                            </span>
                            <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed pt-0.5">{{ $misi }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Kolom Lokasi (1 Kolom) --}}
            <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-200 dark:border-white/10 shadow-sm h-full flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary text-xl mb-6 shadow-inner">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Wilayah Kerja & Kedudukan</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                        Berkedudukan di Kabupaten Mimika, Provinsi Papua Tengah, serta bekerja bersama komunitas adat di berbagai wilayah bentang alam Tanah Papua.
                    </p>
                </div>
                
                <div class="mt-8 pt-6 border-t border-slate-200/60 dark:border-white/5 text-xs text-slate-400 dark:text-slate-500 flex items-center gap-2">
                    <i class="fa-solid fa-building-flag text-primary"></i> Sekretariat Utama • Mimika
                </div>
            </div>

        </div>
    </section>



    {{-- NILAI --}}
    <section id="nilai" class="py-24 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Nilai Inti</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4">Nilai-Nilai Organisasi</h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed max-w-2xl mx-auto mt-4">Prinsip-prinsip utama yang memandu setiap langkah kerja dan pengambilan keputusan YESL bersama masyarakat adat.</p>
            </div>
            @php
                $nilai = [
                    ['Keberpihakan Masyarakat Adat', 'Menghormati, melindungi, dan memperjuangkan hak-hak serta kearifan lokal masyarakat adat.'],
                    ['Kelestarian Bentang Alam', 'Menjaga keseimbangan ekosistem dan memastikan perlindungan lingkungan hidup yang berkelanjutan.'],
                    ['Kolaboratif', 'Membangun kerja sama yang sinergis, inklusif, dan saling percaya dengan berbagai pihak.'],
                    ['Integritas dan Akuntabilitas', 'Menjunjung tinggi kejujuran, etika kerja, dan tanggung jawab yang transparan dalam setiap tindakan.'],
                    ['Pembelajaran dan Inovatif', 'Terus belajar, beradaptasi dengan perubahan, dan menciptakan solusi baru yang kreatif.'],
                ];
            @endphp
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-center">
                @foreach ($nilai as [$title, $desc])
                    <div class="p-5 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10">
                        <h4 class="font-bold mb-2 flex items-center gap-2"><i class="fa-solid fa-leaf text-primary text-sm"></i> {{ $title }}</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PROGRAM PRIORITAS --}}
    <section id="program" class="py-24 px-6 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto">
            <div class="max-w-3xl mx-auto text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Program Prioritas</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Empat Pilar Program Prioritas</h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Program prioritas YESL menjadi pilar utama dalam mewujudkan tata kelola sumber daya alam yang adil dan berkelanjutan di Tanah Papua. Keempat program ini saling terhubung untuk memperkuat pengetahuan, ekonomi, kapasitas, serta pembiayaan bagi masyarakat adat.</p>
            </div>

            @php
                $programPrioritas = [
                    ['fa-book-open', 'Kajian dan Pengelolaan Pengetahuan dan Media', 'Mendokumentasikan kearifan lokal serta mengelola data dan media sebagai basis advokasi kebijakan dan edukasi publik.'],
                    ['fa-arrow-trend-up', 'Transformasi Ekonomi Masyarakat Adat', 'Mengembangkan model ekonomi berbasis potensi lokal yang inklusif, adil, dan menjaga kelestarian bentang alam.'],
                    ['fa-people-group', 'Pemberdayaan Masyarakat Adat', 'Memperkuat kapasitas, hak, dan kelembagaan adat agar masyarakat mandiri mengelola wilayah dan sumber penghidupannya.'],
                    ['fa-hand-holding-dollar', 'Pembiayaan Inovatif', 'Merancang skema pendanaan kreatif dan berkelanjutan untuk mendukung konservasi dan kesejahteraan masyarakat adat.'],
                ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($programPrioritas as [$icon, $title, $desc])
                    <div class="group bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-4xl mb-6 shadow-inner {{ $loop->even ? 'bg-secondary/10 text-secondary' : 'bg-primary/10 text-primary' }}">
                            <i class="fa-solid {{ $icon }}"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-2 leading-snug">{{ $title }}</h3>
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- GALERI (dinamis via API + Alpine) --}}
    <section id="galeri" class="py-24 px-6 bg-slate-50 dark:bg-slate-950" x-data="gallerySection()" x-init="init()">
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
                    <a :href="album.url" class="group bg-white dark:bg-slate-900 p-4 rounded-3xl border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
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

    {{-- MENGAPA YESL --}}
    <section id="mengapa" class="py-24 px-6 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto">
            <div class="max-w-3xl mx-auto text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Mengapa Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Mengapa YESL?</h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Lima alasan utama yang menjadikan YESL mitra tepercaya dalam pelestarian ekologi dan penguatan masyarakat adat. Setiap prinsip mencerminkan cara kami bekerja bersama komunitas di Tanah Papua.</p>
            </div>

            @php
                $mengapaYesl = [
                    ['fa-users', 'Dipimpin oleh Masyarakat Adat', 'Bekerja bersama dan dipimpin oleh masyarakat adat Papua.'],
                    ['fa-mountain-sun', 'Berbasis Bentang Alam', 'Pendekatan bentang alam untuk perlindungan yang berkelanjutan.'],
                    ['fa-magnifying-glass-chart', 'Berbasis Bukti', 'Keputusan berbasis data, riset, dan pengetahuan lokal.'],
                    ['fa-handshake', 'Kolaboratif', 'Berkolaborasi dengan pemerintah, komunitas, swasta, akademisi, dan donor.'],
                    ['fa-scale-balanced', 'Akuntabel & Transparan', 'Tata kelola yang baik dan transparansi dalam setiap langkah kami.'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach ($mengapaYesl as [$icon, $title, $desc])
                    <div class="group bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-200 dark:border-white/10 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        <div class="aspect-square flex items-center justify-center {{ $loop->even ? 'bg-secondary/10 text-secondary' : 'bg-primary/10 text-primary' }}">
                            <i class="fa-solid {{ $icon }} text-7xl group-hover:scale-110 transition-transform duration-500"></i>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-2 leading-snug group-hover:text-primary transition-colors">{{ $title }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TIM YSEL --}}
    <section id="tim" class="py-24 px-6 bg-slate-50 dark:bg-slate-950"
        x-data="{
            groups: [
                {
                    label: 'Pembina & Pengawas',
                    members: [
                        { name: 'Netty Bakkara', role: 'Pembina', photo: '{{ asset('images/team/netty.jpg') }}' },
                        { name: 'Maryana J. E. Hamadi', role: 'Pengawas', photo: '{{ asset('images/team/maryana.jpg') }}' },
                    ],
                },
                {
                    label: 'Staf',
                    members: [
                        { name: 'Rintho G. Maturbongs', role: 'Direktur', photo: '{{ asset('images/team/rintho.jpg') }}' },
                        { name: 'Prasetyo', role: 'Manager Program', photo: '{{ asset('images/team/prasetyo.jpg') }}' },
                        { name: 'Nadhiya Tamrin', role: 'Staf Keuangan', photo: '{{ asset('images/team/nadhiya.jpg') }}' },
                        { name: 'Eka Januarita Kafiar', role: 'Fasilitator Lokal', photo: '{{ asset('images/team/januarita.jpg') }}' },
                    ],
                },
            ],
            initials(name) {
                return name.split(' ').filter(Boolean).slice(0, 2).map(w => w[0]).join('').toUpperCase();
            }
        }">
        <div class="max-w-7xl mx-auto">
            <div class="max-w-3xl mx-auto text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Tim Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Tim YSEL</h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Orang-orang di balik YESL yang berkomitmen mendampingi masyarakat adat dan menjaga kelestarian bentang alam di Tanah Papua.</p>
            </div>

            <template x-for="group in groups" :key="group.label">
                <div class="mb-14 last:mb-0">
                    {{-- Judul baris --}}
                    <div class="flex items-center justify-center gap-4 mb-8">
                        <span class="h-px w-8 bg-slate-300 dark:bg-white/15"></span>
                        <h3 class="text-sm font-bold uppercase tracking-widest text-primary" x-text="group.label"></h3>
                        <span class="h-px w-8 bg-slate-300 dark:bg-white/15"></span>
                    </div>

                    {{-- Kartu anggota (rata tengah) --}}
                    <div class="flex flex-wrap justify-center gap-6">
                        <template x-for="(m, i) in group.members" :key="m.name">
                            <div class="group w-full sm:w-56 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-white/10 overflow-hidden text-center hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                                <div class="relative aspect-square flex items-center justify-center"
                                    :class="(i % 2 === 0) ? 'bg-primary/10 text-primary' : 'bg-secondary/10 text-secondary'">
                                    <span class="text-4xl font-extrabold" x-text="initials(m.name)"></span>
                                    <img :src="m.photo" :alt="m.name" loading="lazy" x-on:error="$el.style.display = 'none'"
                                        class="absolute inset-0 w-full h-full object-cover">
                                </div>
                                <div class="p-5">
                                    <h4 class="font-bold leading-snug group-hover:text-primary transition-colors" x-text="m.name"></h4>
                                    <p class="text-sm text-primary font-semibold mt-1" x-text="m.role"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </section>

    {{-- DONASI --}}
    <section id="donasi" class="py-24 px-6 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative h-64 sm:h-80 lg:h-full rounded-3xl overflow-hidden border border-white/10 shadow-2xl">
                <img src="{{ asset('images/pemetaan-profil-adat.jpg') }}" alt="Dukung Aksi Ekologi YESL" class="w-full h-full object-cover" loading="lazy">
            </div>
            <div x-data="{ showRekening: false, copied: false }">
                <span class="inline-block px-3.5 py-1.5 bg-primary-500/20 border border-primary-400/30 text-primary-300 rounded-full text-xs font-bold tracking-wider uppercase mb-4">Mari Berkontribusi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-6">Dukung Aksi Nyata Pelestarian Ekologi & Masyarakat Adat Papua</h2>
                <p class="text-slate-300 mb-8 leading-relaxed">Setiap dukungan Anda dialokasikan langsung untuk pemetaan partisipatif wilayah adat, penguatan perempuan pengelola hutan desa, dan kajian ekosobling di garda terdepan Papua.</p>

                {{-- Tombol Aksi --}}
                <div class="flex flex-wrap items-center gap-3">
                    <a href="https://wa.me/62811490000" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-3 px-7 py-3.5 bg-primary text-white font-bold rounded-2xl hover:bg-primary-600 transition shadow-xl">
                        <i class="fa-brands fa-whatsapp text-xl"></i> Hubungi via WhatsApp
                    </a>
                    <button type="button" @click="showRekening = !showRekening"
                        :aria-expanded="showRekening" aria-controls="info-rekening-donasi"
                        class="inline-flex items-center gap-3 px-7 py-3.5 border border-white/25 text-white font-bold rounded-2xl hover:bg-white/10 transition">
                        <i class="fa-solid fa-building-columns text-lg"></i> Informasi Rekening
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-300" :class="showRekening && 'rotate-180'"></i>
                    </button>
                </div>

                {{-- Panel Informasi Rekening Donasi --}}
                <div id="info-rekening-donasi" x-show="showRekening" x-cloak x-transition
                    class="mt-6 rounded-3xl border border-white/10 bg-white/5 p-6 sm:p-7">
                    <h3 class="flex items-center gap-2 text-lg font-bold mb-5">
                        <i class="fa-solid fa-hand-holding-heart text-primary-300"></i> Rekening Donasi
                    </h3>

                    {{-- Detail Rekening --}}
                    <dl class="space-y-3 text-sm">
                        <div class="flex items-start justify-between gap-4">
                            <dt class="text-slate-400 shrink-0">Nama Pemegang Rekening</dt>
                            <dd class="font-semibold text-right">EKOLOGI SAHUL LESTARI</dd>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <dt class="text-slate-400 shrink-0">Nomor Rekening</dt>
                            <dd class="flex items-center gap-2 font-semibold">
                                <span class="tracking-wider">056101002563303</span>
                                <button type="button" aria-label="Salin nomor rekening"
                                    @click="navigator.clipboard.writeText('056101002563303').then(() => { copied = true; setTimeout(() => copied = false, 2000); })"
                                    class="w-8 h-8 grid place-items-center rounded-lg bg-white/10 hover:bg-white/20 transition shrink-0">
                                    <i class="fa-solid" :class="copied ? 'fa-check text-primary-300' : 'fa-copy'"></i>
                                </button>
                            </dd>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <dt class="text-slate-400 shrink-0">Nama Bank</dt>
                            <dd class="font-semibold text-right">Bank Rakyat Indonesia (BRI)</dd>
                        </div>
                        <div class="flex items-start justify-between gap-4">
                            <dt class="text-slate-400 shrink-0">Cabang</dt>
                            <dd class="font-semibold text-right">Cabang Timika</dd>
                        </div>
                    </dl>

                    {{-- Instruksi Donasi --}}
                    <div class="mt-6 pt-6 border-t border-white/10">
                        <p class="text-sm font-bold mb-3">Cara Berdonasi</p>
                        <ol class="space-y-2 text-sm text-slate-300 list-decimal ps-5 marker:font-bold marker:text-primary-300">
                            <li>Kirim donasi Anda ke nomor rekening di atas.</li>
                            <li>Simpan bukti transfer Anda.</li>
                            <li>Kirim bukti transfer kepada kami melalui tombol WhatsApp di bawah.</li>
                        </ol>
                        <a href="{{ 'https://wa.me/62811490000?text=' . rawurlencode('Halo YESL, saya telah melakukan donasi ke rekening BRI a.n. EKOLOGI SAHUL LESTARI. Berikut saya lampirkan bukti transfernya. Terima kasih.') }}"
                            target="_blank" rel="noopener"
                            class="mt-5 inline-flex items-center gap-3 px-6 py-3 bg-primary text-white font-bold rounded-2xl hover:bg-primary-600 transition shadow-lg">
                            <i class="fa-brands fa-whatsapp text-xl"></i> Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 px-6 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-7xl mx-auto relative overflow-hidden bg-primary rounded-[2.5rem] p-12 md:p-16 text-center">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="relative z-10">
                <span class="inline-block px-4 py-1.5 bg-white/15 border border-white/25 text-white rounded-full text-xs font-bold tracking-wide uppercase mb-5">Mari Bergabung</span>
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
