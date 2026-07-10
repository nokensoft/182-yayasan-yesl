@extends('layouts.app')

@php
    $photos = $album->photos->map(fn ($p) => ['src' => asset($p->image_path), 'caption' => $p->caption])->values();
    $cover = $album->cover_image ? asset($album->cover_image) : ($photos[0]['src'] ?? asset('images/logo-yesl.png'));
    $desc = $album->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($album->description), 160);
    $ld = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'ImageGallery',
                'name' => $album->title,
                'description' => $desc,
                'datePublished' => optional($album->published_at)->toIso8601String(),
                'url' => route('gallery.show', $album->slug),
                'image' => $photos->pluck('src')->all(),
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Galeri', 'item' => route('gallery.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $album->title, 'item' => route('gallery.show', $album->slug)],
                ],
            ],
        ],
    ];
@endphp

@section('page_title', $album->meta_title ?: $album->title)
@section('meta_description', $desc)
@section('canonical', route('gallery.show', $album->slug))
@section('og_type', 'article')
@section('og_image', $cover)

@push('head')
<script type="application/ld+json">@json($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <section class="pt-28 pb-16 px-6" x-data="albumGallery({{ \Illuminate\Support\Js::from($photos) }})">
        <div class="max-w-5xl mx-auto">
            <nav class="text-xs text-slate-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a> <span class="mx-1">/</span>
                <a href="{{ route('gallery.index') }}" class="hover:text-primary">Galeri</a> <span class="mx-1">/</span>
                <span class="text-slate-600 dark:text-slate-300">{{ \Illuminate\Support\Str::limit($album->title, 40) }}</span>
            </nav>

            <div class="flex flex-wrap gap-1.5 mb-4">
                @foreach ($album->categories as $cat)
                    <a href="{{ route('gallery.index', ['category' => $cat->slug]) }}"
                        class="bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 text-xs font-bold px-2.5 py-1 rounded-full hover:bg-primary-100 transition">{{ $cat->name }}</a>
                @endforeach
            </div>

            <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-3">{{ $album->title }}</h1>
            <div class="flex items-center gap-4 text-sm text-slate-500 dark:text-slate-400 mb-6">
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i> {{ $album->published_human }}</span>
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-images"></i> {{ $photos->count() }} Foto</span>
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> {{ $album->views }}</span>
            </div>

            <div class="mb-8">
                @include('partials.share', ['url' => route('gallery.show', $album->slug), 'title' => $album->title])
            </div>

            @if ($album->description)
                <div class="article-content text-slate-700 dark:text-slate-300 mb-8 max-w-3xl">{!! nl2br(e($album->description)) !!}</div>
            @endif

            @if ($photos->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach ($album->photos as $photo)
                        <button type="button" @click="openAt({{ $loop->index }})"
                            class="group aspect-3/2 overflow-hidden rounded-2xl border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/5">
                            <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->caption ?: $album->title }}" loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </button>
                    @endforeach
                </div>
            @else
                <p class="text-slate-500 py-10 text-center">Belum ada foto pada album ini.</p>
            @endif

            <div class="mt-10 pt-6 border-t border-slate-100 dark:border-white/10">
                <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Galeri
                </a>
            </div>
        </div>

        {{-- Lightbox --}}
        <div x-show="open" x-cloak @keydown.escape.window="close()" @keydown.arrow-right.window="next()" @keydown.arrow-left.window="prev()"
            class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-slate-950/90" @click="close()"></div>
            <button @click="close()" class="absolute top-5 right-5 z-10 w-11 h-11 rounded-full bg-white/10 text-white grid place-items-center hover:bg-white/20"><i class="fa-solid fa-xmark text-xl"></i></button>
            <button @click="prev()" class="absolute left-4 z-10 w-11 h-11 rounded-full bg-white/10 text-white grid place-items-center hover:bg-white/20"><i class="fa-solid fa-chevron-left"></i></button>
            <button @click="next()" class="absolute right-4 z-10 w-11 h-11 rounded-full bg-white/10 text-white grid place-items-center hover:bg-white/20"><i class="fa-solid fa-chevron-right"></i></button>
            <div class="relative z-0 max-w-4xl w-full text-center">
                <img :src="current.src" :alt="current.caption" class="max-h-[80vh] w-auto mx-auto rounded-xl">
                <p x-show="current.caption" x-text="current.caption" class="text-white/80 text-sm mt-3"></p>
            </div>
        </div>
    </section>
@endsection

@push('head')
<script>
    function albumGallery(photos) {
        return {
            photos: photos,
            open: false,
            index: 0,
            openAt(i) { this.index = i; this.open = true; document.body.style.overflow = 'hidden'; },
            close() { this.open = false; document.body.style.overflow = ''; },
            next() { if (this.photos.length) this.index = (this.index + 1) % this.photos.length; },
            prev() { if (this.photos.length) this.index = (this.index - 1 + this.photos.length) % this.photos.length; },
            get current() { return this.photos[this.index] || { src: '', caption: '' }; },
        };
    }
</script>
@endpush
