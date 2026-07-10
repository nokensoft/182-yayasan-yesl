@extends('layouts.app')

@section('page_title', 'Blog & Artikel')
@section('meta_description', 'Kumpulan artikel, cerita lapangan, dan kabar terbaru Yayasan Ekologi Sahul Lestari (YESL).')

@section('content')
    <header class="pt-28 pb-10 px-6 bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-white/10">
        <div class="max-w-7xl mx-auto">
            <nav class="text-xs text-slate-400 mb-3">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a> <span class="mx-1">/</span> <span class="text-slate-600 dark:text-slate-300">Blog</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-extrabold">Blog & Artikel</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2 max-w-2xl">Cerita dari lapangan dan perkembangan program pemberdayaan masyarakat adat serta pelestarian lingkungan.</p>
        </div>
    </header>

    <section class="py-10 px-6">
        <div class="max-w-7xl mx-auto">
            @include('partials.content-filters', ['action' => route('blog.index'), 'categories' => $categories])

            <p class="text-sm text-slate-500 mt-6 mb-4">Menampilkan {{ $posts->total() }} artikel.</p>

            @if ($posts->count())
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        <a href="{{ route('blog.show', $post->slug) }}"
                            class="group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex flex-col">
                            <div class="aspect-[3/2] overflow-hidden bg-slate-100 dark:bg-white/5">
                                @if ($post->cover_image)
                                    <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}" loading="lazy"
                                        class="aspect-[3/2] object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <div class="flex flex-wrap gap-1 mb-3">
                                    @foreach ($post->categories as $cat)
                                        <span class="bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $cat->name }}</span>
                                    @endforeach
                                </div>
                                <h2 class="text-lg font-bold mb-2 line-clamp-2 group-hover:text-primary transition-colors">{{ $post->title }}</h2>
                                <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3 flex-1">{{ $post->excerpt }}</p>
                                <div class="flex justify-between items-center pt-3 mt-3 border-t border-slate-200/60 dark:border-white/10 text-xs text-slate-400 font-medium">
                                    <span>{{ $post->published_human }}</span>
                                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> {{ $post->views }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-10">{{ $posts->links() }}</div>
            @else
                <div class="text-center py-20 text-slate-500">
                    <i class="fa-regular fa-folder-open text-5xl mb-4"></i>
                    <p class="font-semibold">Tidak ada artikel yang cocok.</p>
                    <p class="text-sm">Coba ubah kata kunci atau filter Anda.</p>
                </div>
            @endif
        </div>
    </section>

    @include('partials.mari-berkontribusi')
@endsection
