@extends('layouts.app')

@section('page_title', 'Peta Situs')
@section('meta_description', 'Peta situs Yayasan Ekologi Sahul Lestari (YESL) — daftar seluruh halaman, artikel, dan album.')

@section('content')
    <header class="pt-28 pb-8 px-6 bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-white/10">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-extrabold">Peta Situs</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2">Daftar seluruh halaman utama, artikel, dan album di situs ini.</p>
        </div>
    </header>

    <section class="py-12 px-6">
        <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-10">
            <div>
                <h2 class="font-bold text-lg mb-4 flex items-center gap-2"><i class="fa-solid fa-compass text-primary"></i> Halaman</h2>
                <ul class="space-y-2 text-slate-600 dark:text-slate-300">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary">Blog</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-primary">Galeri</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-primary">FAQ</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="hover:text-primary">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div>
                <h2 class="font-bold text-lg mb-4 flex items-center gap-2"><i class="fa-solid fa-newspaper text-primary"></i> Artikel</h2>
                <ul class="space-y-2 text-slate-600 dark:text-slate-300">
                    @forelse ($posts as $post)
                        <li><a href="{{ route('blog.show', $post->slug) }}" class="hover:text-primary line-clamp-1">{{ $post->title }}</a></li>
                    @empty
                        <li class="text-slate-400 text-sm">Belum ada artikel.</li>
                    @endforelse
                </ul>
            </div>

            <div>
                <h2 class="font-bold text-lg mb-4 flex items-center gap-2"><i class="fa-solid fa-images text-primary"></i> Album</h2>
                <ul class="space-y-2 text-slate-600 dark:text-slate-300">
                    @forelse ($albums as $album)
                        <li><a href="{{ route('gallery.show', $album->slug) }}" class="hover:text-primary line-clamp-1">{{ $album->title }}</a></li>
                    @empty
                        <li class="text-slate-400 text-sm">Belum ada album.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>
@endsection
