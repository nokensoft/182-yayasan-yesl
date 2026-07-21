@extends('layouts.app')

@section('page_title', 'Tentang Kami')
@section('meta_description', 'Profil Yayasan Ekologi Sahul Lestari (YESL): jati diri organisasi, visi & misi, nilai inti, program prioritas, dan tim yang mendampingi masyarakat adat di Tanah Papua.')

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

    <header class="pt-28 pb-10 px-6 bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-white/10">
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Tentang Kami</span>
            <h1 class="text-3xl md:text-4xl font-extrabold mt-4">Mengenal Yayasan Ekologi Sahul Lestari</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-4 leading-relaxed">
                Profil organisasi, arah visi & misi, nilai inti, program prioritas, dan tim yang mendampingi masyarakat adat di Tanah Papua.
            </p>
        </div>
    </header>

    @include('partials.tentang')

    @include('partials.visi-misi')

    @include('partials.nilai')

    @include('partials.program')

    @include('partials.tim')

    @include('partials.mengapa')

    @include('partials.mitra-kerja')

    @include('partials.cta')

@endsection
