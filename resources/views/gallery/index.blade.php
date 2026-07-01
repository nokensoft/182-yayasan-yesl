@extends('layouts.app')

@section('page_title', 'Galeri & Album')
@section('meta_description', 'Dokumentasi kegiatan dan album foto program Yayasan Ekologi Sahul Lestari (YESL) di Tanah Papua.')

@section('content')
    <header class="pt-28 pb-10 px-6 bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-white/10">
        <div class="max-w-7xl mx-auto">
            <nav class="text-xs text-slate-400 mb-3">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a> <span class="mx-1">/</span> <span class="text-slate-600 dark:text-slate-300">Galeri</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-extrabold">Galeri & Album</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2 max-w-2xl">Dokumentasi capaian program dari pemetaan partisipatif hingga perhutanan sosial di Tanah Papua.</p>
        </div>
    </header>

    <section class="py-10 px-6">
        <div class="max-w-7xl mx-auto">
            @include('partials.content-filters', ['action' => route('gallery.index'), 'categories' => $categories])

            <p class="text-sm text-slate-500 mt-6 mb-4">Menampilkan {{ $albums->total() }} album.</p>

            @if ($albums->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($albums as $album)
                        <a href="{{ route('gallery.show', $album->slug) }}"
                            class="group bg-white dark:bg-slate-900 p-4 rounded-3xl border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                            <div class="aspect-[1.91/1] overflow-hidden rounded-2xl border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/5">
                                @if ($album->cover_image)
                                    <img src="{{ asset($album->cover_image) }}" alt="{{ $album->title }}" loading="lazy"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="flex flex-wrap gap-1 mt-4">
                                @foreach ($album->categories as $cat)
                                    <span class="bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $cat->name }}</span>
                                @endforeach
                            </div>
                            <p class="mt-2 text-base font-bold leading-snug group-hover:text-primary transition-colors">{{ $album->title }}</p>
                            <div class="mt-3 pt-3 border-t border-slate-200/60 dark:border-white/10 flex items-center justify-between text-xs text-slate-400 font-medium">
                                <span class="flex items-center gap-1.5 bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 px-2.5 py-1 rounded-md text-[11px] font-bold">
                                    <i class="fa-regular fa-images"></i> {{ $album->photos_count }} Foto
                                </span>
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> {{ $album->views }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10">{{ $albums->links() }}</div>
            @else
                <div class="text-center py-20 text-slate-500">
                    <i class="fa-regular fa-images text-5xl mb-4"></i>
                    <p class="font-semibold">Tidak ada album yang cocok.</p>
                    <p class="text-sm">Coba ubah kata kunci atau filter Anda.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
