@extends('layouts.app')

@php
    $desc = $post->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->body), 160);
    $cover = $post->cover_image ? asset($post->cover_image) : asset('images/logo-yesl.png');
    $ld = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Article',
                'headline' => $post->title,
                'description' => $desc,
                'image' => $cover,
                'datePublished' => optional($post->published_at)->toIso8601String(),
                'dateModified' => optional($post->updated_at)->toIso8601String(),
                'author' => ['@type' => 'Organization', 'name' => config('app.name')],
                'publisher' => [
                    '@type' => 'Organization',
                    'name' => config('app.name'),
                    'logo' => ['@type' => 'ImageObject', 'url' => asset('images/logo-yesl.png')],
                ],
                'mainEntityOfPage' => route('blog.show', $post->slug),
            ],
            [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog.index')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => route('blog.show', $post->slug)],
                ],
            ],
        ],
    ];
@endphp

@section('page_title', $post->meta_title ?: $post->title)
@section('meta_description', $desc)
@section('canonical', route('blog.show', $post->slug))
@section('og_type', 'article')
@section('og_image', $cover)

@push('head')
<script type="application/ld+json">@json($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)</script>
@endpush

@section('content')
    <article class="pt-28 pb-16 px-6">
        <div class="max-w-3xl mx-auto">
            <nav class="text-xs text-slate-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-primary">Beranda</a> <span class="mx-1">/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-primary">Blog</a> <span class="mx-1">/</span>
                <span class="text-slate-600 dark:text-slate-300">{{ \Illuminate\Support\Str::limit($post->title, 40) }}</span>
            </nav>

            <div class="flex flex-wrap gap-1.5 mb-4">
                @foreach ($post->categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                        class="bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 text-xs font-bold px-2.5 py-1 rounded-full hover:bg-primary-100 transition">{{ $cat->name }}</a>
                @endforeach
            </div>

            <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">{{ $post->title }}</h1>

            <div class="flex items-center gap-4 text-sm text-slate-500 dark:text-slate-400 mb-8">
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar"></i> {{ $post->published_human }}</span>
                <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> {{ $post->views }} kali dilihat</span>
            </div>

            @if ($post->cover_image)
                <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}"
                    class="aspect-[3/2] rounded-3xl shadow-lg mb-8 object-cover">
            @endif

            <div class="article-content text-slate-700 dark:text-slate-300">
                {!! $post->body !!}
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-white/10">
                @include('partials.share', ['url' => route('blog.show', $post->slug), 'title' => $post->title])
            </div>

            <div class="mt-6">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Blog
                </a>
            </div>
        </div>

        @if ($related->count())
            <div class="max-w-7xl mx-auto mt-16">
                <h2 class="text-2xl font-extrabold mb-6">Artikel Terkait</h2>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach ($related as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}"
                            class="group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition">
                            <div class="aspect-[3/2] overflow-hidden bg-slate-100 dark:bg-white/5">
                                @if ($rel->cover_image)
                                    <img src="{{ asset($rel->cover_image) }}" alt="{{ $rel->title }}" loading="lazy"
                                        class="aspect-[3/2] object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold line-clamp-2 group-hover:text-primary transition-colors">{{ $rel->title }}</h3>
                                <p class="text-xs text-slate-400 mt-2">{{ $rel->published_human }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
@endsection
