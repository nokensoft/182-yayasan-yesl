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
    <x-hero>
        <span class="inline-block px-4 py-1.5 bg-primary-500/20 border border-primary-400/30 text-primary-300 rounded-full text-xs font-bold mb-6 tracking-wide uppercase">Organisasi Nirlaba Ekologi & Masyarakat Adat Papua</span>
        <h1 class="text-4xl md:text-6xl font-extrabold leading-[1.1] mb-6 text-white">
            Menjaga <span class="text-primary-300">Ekologi Sahul</span> untuk Kedaulatan Masyarakat Adat.
        </h1>
        <p class="text-lg text-slate-200 mb-8 max-w-2xl mx-auto leading-relaxed">
            Yayasan Ekologi Sahul Lestari (YESL) hadir di Tanah Papua sejak 2019 untuk melindungi kedaulatan masyarakat adat dalam pengelolaan daratan dan perairan secara berkelanjutan.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('pages.tentang') }}" class="px-7 py-3.5 bg-primary text-white rounded-2xl font-bold shadow-lg shadow-primary/25 hover:-translate-y-0.5 transition">Pelajari Lebih Lanjut</a>
            <a href="{{ route('blog.index') }}" class="px-7 py-3.5 bg-white/10 text-white border border-white/25 rounded-2xl font-bold hover:bg-white/20 transition flex items-center gap-2 backdrop-blur-sm">
                <i class="fa-solid fa-newspaper text-primary-300"></i> Baca Blog
            </a>
        </div>
    </x-hero>

    @include('partials.dampak')

    @include('partials.blog')

    @include('partials.galeri')

    @include('partials.mari-berkontribusi')

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
