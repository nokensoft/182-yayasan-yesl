@extends('layouts.app')

@php
    $faqs = [
        ['Apa itu Yayasan Ekologi Sahul Lestari (YESL)?', 'YESL adalah organisasi nirlaba yang berdiri sejak 2019 di Kabupaten Mimika, Papua Tengah, berfokus pada pelestarian ekologi dan penguatan hak masyarakat adat.'],
        ['Di mana wilayah kerja YESL?', 'YESL berkedudukan di Kota Timika, Kabupaten Mimika, dan bekerja bersama komunitas adat di berbagai wilayah Tanah Papua.'],
        ['Bagaimana cara berdonasi atau berkolaborasi?', 'Anda dapat menghubungi kami melalui WhatsApp atau email resmi di info@yesl.or.id. Kami terbuka untuk kolaborasi program dan dukungan.'],
        ['Apakah laporan program tersedia untuk publik?', 'Ya, transparansi adalah prioritas kami. Laporan penyaluran dan capaian program dilaporkan secara berkala kepada publik dan mitra.'],
    ];

    $faqLd = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => collect($faqs)->map(fn ($f) => [
            '@type' => 'Question',
            'name' => $f[0],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
        ])->all(),
    ];
@endphp

@section('page_title', 'FAQ')
@section('meta_description', 'Pertanyaan yang sering diajukan seputar Yayasan Ekologi Sahul Lestari (YESL).')

@push('head')
<script type="application/ld+json">@json($faqLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <header class="pt-28 pb-8 px-6 bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-white/10">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-extrabold">FAQ — Tanya Jawab</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2">Pertanyaan yang sering diajukan seputar YESL.</p>
        </div>
    </header>

    <section class="py-12 px-6">
        <div class="max-w-3xl mx-auto space-y-3">
            @foreach ($faqs as $i => $faq)
                <div x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }"
                    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 rounded-2xl overflow-hidden">
                    <button @click="open = !open" class="w-full flex items-center justify-between gap-4 p-5 text-left font-bold">
                        <span>{{ $faq[0] }}</span>
                        <i class="fa-solid fa-chevron-down text-primary transition-transform" :class="open && 'rotate-180'"></i>
                    </button>
                    <div x-show="open" x-cloak x-transition class="px-5 pb-5 text-slate-600 dark:text-slate-400 leading-relaxed">
                        {{ $faq[1] }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
