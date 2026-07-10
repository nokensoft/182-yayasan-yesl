@props([
    // Daftar URL gambar. Jika kosong, otomatis diambil dari public/images/hero-slider/*
    'images' => [],
    // Jeda antar slide (milidetik)
    'interval' => 6000,
])

@php
    $slides = collect($images)->filter()->values();

    // Auto-discover gambar dari folder public/images/hero-slider bila prop tidak diisi
    if ($slides->isEmpty()) {
        $files = glob(public_path('images/hero-slider/*.{png,jpg,jpeg,png,webp,avif,gif}'), GLOB_BRACE) ?: [];
        sort($files);
        $slides = collect($files)->map(fn ($f) => asset('images/hero-slider/' . basename($f)))->values();
    }

    // Fallback bila folder kosong
    if ($slides->isEmpty()) {
        $slides = collect([asset('images/bg1.png')]);
    }
@endphp

<section id="beranda"
    x-data="heroSlider(@js($slides), {{ (int) $interval }})"
    x-init="init()"
    class="relative min-h-screen flex items-center overflow-hidden pt-28 pb-16">

    {{-- Slider latar dengan efek zoom in / zoom out bergantian --}}
    <div class="absolute inset-0 z-0" aria-hidden="true">
        <template x-for="(image, index) in images" :key="index">
            <div class="absolute inset-0 transition-opacity duration-[1500ms] ease-in-out"
                :class="index === current ? 'opacity-100' : 'opacity-0'">
                <img :src="image" alt=""
                    :loading="index === 0 ? 'eager' : 'lazy'"
                    :fetchpriority="index === 0 ? 'high' : 'auto'"
                    class="w-full h-full object-cover will-change-transform"
                    :class="{
                        'hero-zoom-in': index === current && index % 2 === 0,
                        'hero-zoom-out': index === current && index % 2 !== 0,
                    }">
            </div>
        </template>

        {{-- Overlay gradien (dipertahankan seperti desain semula) --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/75 to-slate-950/30"></div>
        <div class="absolute inset-x-0 top-0 h-44 bg-gradient-to-b from-white/85 via-white/30 to-transparent"></div>
    </div>

    {{-- Konten teks & tombol (tetap) --}}
    <div class="relative z-10 max-w-3xl mx-auto px-6 w-full text-center">
        {{ $slot }}
    </div>
</section>

@once
@push('head')
<script>
    function heroSlider(images = [], interval = 6000) {
        return {
            images: images,
            current: 0,
            timer: null,
            init() {
                if (this.images.length <= 1) return;
                this.timer = setInterval(() => this.next(), interval);
            },
            next() {
                this.current = (this.current + 1) % this.images.length;
            },
        };
    }
</script>
@endpush
@endonce
