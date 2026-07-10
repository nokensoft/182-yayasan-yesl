@extends('layouts.app')

@php
    $timeline = [
        [
            'year' => '2020',
            'items' => [
                'Kerja sama pemetaan partisipatif wilayah tangkap nelayan Orang Asli Papua Suku Kamoro di 21 kampung yang tersebar di Distrik Mimika Barat Jauh, Distrik Mimika Tengah, Distrik Amar, dan Distrik Iwaka, Kabupaten Mimika, bersama Dinas Perikanan Kabupaten Mimika.',
                'Kerja sama kajian Profil Hukum Adat Kampung Kamora, Distrik Mimika Tengah, Kabupaten Mimika, bersama Yayasan Hutan Biru.',
            ],
            'partners' => [],
        ],
        [
            'year' => '2021',
            'items' => [
                'Pemetaan partisipatif wilayah tangkap nelayan Orang Asli Papua Suku Kamoro di 7 kampung, Distrik Mimika Barat, Kabupaten Mimika.',
                'Kerja sama Program Bank of America Racial and Environmental Justice di Indonesia dan Filipina bersama Education Development Center melalui pengembangan modul pelatihan dan fasilitasi Pelatihan Pemandu Lokal Ekowisata Mangrove Pomako.',
                'Kerja sama Program Desa Berinovasi bersama Badan Riset dan Inovasi Nasional (BRIN).',
                'Kerja sama kajian dan pemetaan wilayah tangkap Orang Asli Papua serta Profil Hukum Adat Kampung Kamora, Distrik Mimika Tengah, Kabupaten Mimika, bersama Yayasan Hutan Biru.',
            ],
            'partners' => [
                ['logo' => 'images/patners/logo-kabupaten-mimika.jpg', 'name' => 'Kabupaten Mimika'],
                ['logo' => 'images/patners/logo-learning-transforms-lives.png', 'name' => 'Education Development Center'],
                ['logo' => 'images/patners/logo-brin.png', 'name' => 'BRIN'],
            ],
        ],
        [
            'year' => '2022–2023',
            'items' => [
                'Kerja sama Kajian Ekonomi, Sosial, Budaya, dan Lingkungan (EKOSOBLING) serta Kajian Profil Masyarakat Hukum Adat Sub-suku Absya dan Sub-suku Nakna di Kampung Bariat dan Kampung Nakna, Distrik Konda, Kabupaten Sorong Selatan, bersama Yayasan Konservasi Cakrawala Indonesia (YKCI).',
                'Kerja sama Kajian Ekonomi, Sosial, Budaya, dan Lingkungan (EKOSOBLING) serta Kajian Profil Masyarakat Hukum Adat Sub-suku Absya, Sub-suku Nakna, dan Suku Yaben di Kampung Wamargege, Kampung Konda, Kampung Demen, Kampung Onipia, dan Kampung Simora, Distrik Konda, Kabupaten Sorong Selatan, bersama Yayasan Konservasi Cakrawala Indonesia (YKCI).',
                'Kerja sama Program Perhutanan Sosial bagi Perempuan dan Generasi Muda di Tanah Papua Fase I melalui revitalisasi tata kelola kelembagaan pengelola Hutan Desa Kampung Pigapu bersama The Asia Foundation.',
                'Kerja sama peningkatan kapasitas organisasi bersama Packard Foundation melalui pendanaan dukungan umum.',
            ],
            'partners' => [
                ['logo' => 'images/patners/logo-konservasi-indonesia.png', 'name' => 'Konservasi Indonesia'],
                ['logo' => 'images/patners/logo-packard-foundation.png', 'name' => 'Packard Foundation'],
                ['logo' => 'images/patners/logo-the-asia-foundation.png', 'name' => 'The Asia Foundation'],
            ],
        ],
        [
            'year' => '2024',
            'items' => [
                'Kerja sama Program Perhutanan Sosial – Perempuan dan Generasi Muda (PS-PGM) Papua Fase II: Meningkatkan peran perempuan dan penggerak muda melalui pengelolaan Hutan Desa Pigapu yang berkelanjutan di Kampung Pigapu bersama The Asia Foundation.',
                'Kerja sama program Manajemen dan Operasi Proyek, Pembelajaran, serta Penggabungan Prinsip-Prinsip Pembangunan Berkelanjutan bersama Packard Foundation.',
            ],
            'partners' => [
                ['logo' => 'images/patners/logo-packard-foundation.png', 'name' => 'Packard Foundation'],
                ['logo' => 'images/patners/logo-the-asia-foundation.png', 'name' => 'The Asia Foundation'],
            ],
        ],
        [
            'year' => '2025–2026',
            'items' => [
                'Kerja sama peningkatan kapasitas organisasi bersama Packard Foundation melalui pendanaan dukungan umum.',
                'Kerja sama Program Perhutanan Sosial – Perempuan dan Generasi Muda: Meningkatkan peran perempuan dan penggerak muda melalui pengelolaan Hutan Desa Yefu, Hutan Desa Wagi, dan Hutan Desa Sagare yang berkelanjutan di Kabupaten Asmat, Provinsi Papua Selatan.',
            ],
            'partners' => [
                ['logo' => 'images/patners/logo-packard-foundation.png', 'name' => 'Packard Foundation'],
                ['logo' => 'images/patners/logo-econusa.png', 'name' => 'EcoNusa'],
            ],
        ],
    ];
@endphp

@section('page_title', 'Program Berjalan')
@section('meta_description', 'Perjalanan program Yayasan Ekologi Sahul Lestari (YESL) dari tahun ke tahun bersama masyarakat adat dan mitra pembangunan di Tanah Papua.')

@section('content')
    <header class="pt-28 pb-10 px-6 bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-white/10">
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Program Berjalan</span>
            <h1 class="text-3xl md:text-4xl font-extrabold mt-4">Perjalanan Program dalam Beberapa Tahun Terakhir</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-4 leading-relaxed">
                Rekam jejak kolaborasi dan capaian program YESL bersama masyarakat adat serta mitra pembangunan di Tanah Papua dari tahun ke tahun.
            </p>
        </div>
    </header>

    <section class="py-16 px-6">
        <div class="max-w-3xl mx-auto">
            <div class="relative">
                {{-- Garis vertikal timeline --}}
                <div class="absolute left-5 md:left-6 top-2 bottom-2 w-px bg-slate-200 dark:bg-white/10" aria-hidden="true"></div>

                <div class="space-y-10">
                    @foreach ($timeline as $entry)
                        <div class="relative pl-16 md:pl-20">
                            {{-- Indikator tahun --}}
                            <div class="absolute left-0 top-0 flex items-center justify-center">
                                <span class="relative z-10 flex items-center justify-center w-10 md:w-12 h-10 md:h-12 rounded-full bg-primary text-white shadow-lg shadow-primary/30 ring-4 ring-white dark:ring-slate-950">
                                    <i class="fa-solid fa-flag text-sm md:text-base"></i>
                                </span>
                            </div>

                            <div class="mb-4">
                                <span class="inline-flex items-center gap-2 text-primary font-extrabold text-2xl md:text-3xl">{{ $entry['year'] }}</span>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ count($entry['items']) }} program &amp; kerja sama</p>
                            </div>

                            {{-- Accordion detail per kegiatan --}}
                            <div class="space-y-3">
                                @foreach ($entry['items'] as $i => $item)
                                    @php($title = \Illuminate\Support\Str::of($item)->before(' bersama')->before(' melalui')->limit(80))
                                    <div x-data="{ open: {{ $loop->parent->first && $i === 0 ? 'true' : 'false' }} }"
                                        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 rounded-2xl overflow-hidden">
                                        <button type="button" @click="open = !open"
                                            class="w-full flex items-center justify-between gap-4 p-5 text-left"
                                            :aria-expanded="open">
                                            <span class="flex items-start gap-3 font-semibold text-slate-800 dark:text-slate-100">
                                                <span class="mt-0.5 flex items-center justify-center w-6 h-6 rounded-full bg-primary-100 dark:bg-primary-500/15 text-primary-700 dark:text-primary-300 text-xs font-bold shrink-0">{{ $i + 1 }}</span>
                                                <span class="leading-snug">{{ $title }}</span>
                                            </span>
                                            <i class="fa-solid fa-chevron-down text-primary transition-transform shrink-0" :class="open && 'rotate-180'"></i>
                                        </button>
                                        <div x-show="open" x-cloak x-transition class="px-5 pb-5 pl-14 text-slate-600 dark:text-slate-400 leading-relaxed">
                                            {{ $item }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Logo mitra kerja --}}
                            @if (! empty($entry['partners']))
                                <div class="mt-5">
                                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400 dark:text-slate-500 mb-3">Mitra Kerja</p>
                                    <div class="flex flex-wrap gap-4">
                                        @foreach ($entry['partners'] as $partner)
                                            <div class="h-16 w-32 flex items-center justify-center bg-white rounded-2xl border border-slate-200 dark:border-white/10 p-3">
                                                <img src="{{ asset($partner['logo']) }}" alt="{{ $partner['name'] }}" loading="lazy"
                                                    class="max-w-full max-h-full object-contain">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA kembali --}}
            <div class="mt-16 text-center">
                <a href="{{ route('home') }}#program"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-primary text-white font-semibold hover:bg-primary-700 transition shadow-md">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Program Prioritas
                </a>
            </div>
        </div>
    </section>
@endsection
