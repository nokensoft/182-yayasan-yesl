@extends('layouts.dashboard')

@section('page_title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @php
            $cards = [
                ['label' => 'Total Artikel', 'value' => $stats['posts'], 'icon' => 'fa-newspaper', 'sub' => $stats['published_posts'].' terbit'],
                ['label' => 'Album', 'value' => $stats['albums'], 'icon' => 'fa-images', 'sub' => 'galeri'],
                ['label' => 'Kategori', 'value' => $stats['categories'], 'icon' => 'fa-tags', 'sub' => 'label konten'],
                ['label' => 'Pengguna', 'value' => $stats['users'], 'icon' => 'fa-users', 'sub' => 'admin & operator'],
            ];
        @endphp
        @foreach ($cards as $c)
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500 dark:text-slate-400 text-sm font-medium">{{ $c['label'] }}</span>
                    <span class="w-9 h-9 rounded-xl bg-primary-50 dark:bg-primary-500/10 text-primary grid place-items-center"><i class="fa-solid {{ $c['icon'] }}"></i></span>
                </div>
                <p class="text-3xl font-extrabold mt-3">{{ $c['value'] }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $c['sub'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="flex flex-wrap gap-3 mb-8">
        <a href="{{ route('dashboard.posts.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-plus"></i> Tulis Artikel</a>
        <a href="{{ route('dashboard.albums.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-800 dark:bg-white/10 text-white text-sm font-semibold hover:opacity-90 transition"><i class="fa-solid fa-plus"></i> Buat Album</a>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold">Artikel Terbaru</h2>
                <a href="{{ route('dashboard.posts.index') }}" class="text-sm text-primary hover:underline">Lihat semua</a>
            </div>
            <ul class="divide-y divide-slate-100 dark:divide-white/10">
                @forelse ($recentPosts as $post)
                    <li class="py-3 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-medium truncate">{{ $post->title }}</p>
                            <p class="text-xs text-slate-400">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="shrink-0 text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $post->status === 'published' ? 'bg-primary-50 text-primary-700 dark:bg-primary-500/10 dark:text-primary-300' : 'bg-slate-100 text-slate-500 dark:bg-white/5' }}">{{ $post->status }}</span>
                    </li>
                @empty
                    <li class="py-6 text-center text-slate-400 text-sm">Belum ada artikel.</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold">Album Terbaru</h2>
                <a href="{{ route('dashboard.albums.index') }}" class="text-sm text-primary hover:underline">Lihat semua</a>
            </div>
            <ul class="divide-y divide-slate-100 dark:divide-white/10">
                @forelse ($recentAlbums as $album)
                    <li class="py-3 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="font-medium truncate">{{ $album->title }}</p>
                            <p class="text-xs text-slate-400">{{ $album->photos_count }} foto</p>
                        </div>
                        <span class="shrink-0 text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $album->status === 'published' ? 'bg-primary-50 text-primary-700 dark:bg-primary-500/10 dark:text-primary-300' : 'bg-slate-100 text-slate-500 dark:bg-white/5' }}">{{ $album->status }}</span>
                    </li>
                @empty
                    <li class="py-6 text-center text-slate-400 text-sm">Belum ada album.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
