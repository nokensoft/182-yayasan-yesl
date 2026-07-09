@extends('layouts.dashboard')

@section('page_title', 'Album & Galeri')

@section('content')
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 mb-6">
        <form method="GET" class="flex flex-wrap items-center gap-2 w-full lg:max-w-3xl">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari album..."
                class="flex-1 min-w-[9rem] rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 px-4 py-2 text-sm focus:ring-2 focus:ring-primary outline-none">
            <select name="category" onchange="this.form.submit()"
                class="rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 px-3 py-2 text-sm focus:ring-2 focus:ring-primary outline-none">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select name="status" onchange="this.form.submit()"
                class="rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 px-3 py-2 text-sm focus:ring-2 focus:ring-primary outline-none">
                <option value="">Semua Status</option>
                <option value="published" @selected(request('status') === 'published')>Terbit</option>
                <option value="draft" @selected(request('status') === 'draft')>Draf</option>
            </select>
            <button class="px-4 py-2 rounded-xl bg-slate-800 dark:bg-white/10 text-white text-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
            @if (request()->hasAny(['q', 'category', 'status']))
                <a href="{{ route('dashboard.albums.index') }}" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm text-slate-500 hover:text-primary transition" title="Reset filter"><i class="fa-solid fa-xmark"></i> Reset</a>
            @endif
        </form>
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('dashboard.albums.trash') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-white/10 transition"><i class="fa-solid fa-trash-can"></i> Sampah ({{ $trashedCount }})</a>
            <a href="{{ route('dashboard.albums.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition"><i class="fa-solid fa-plus"></i> Buat Album</a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 dark:bg-white/5 text-slate-500 text-left">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Album</th>
                        <th class="px-5 py-3 font-semibold text-center">Foto</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold hidden sm:table-cell">Tanggal</th>
                        <th class="px-5 py-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/10">
                    @forelse ($albums as $album)
                        <tr class="hover:bg-slate-50 dark:hover:bg-white/5">
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden bg-slate-100 dark:bg-white/5 shrink-0">
                                        @if ($album->cover_image)
                                            <img src="{{ asset($album->cover_image) }}" alt="" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <span class="font-semibold">{{ $album->title }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-center">{{ $album->photos_count }}</td>
                            <td class="px-5 py-3">
                                <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded-full {{ $album->status === 'published' ? 'bg-primary-50 text-primary-700 dark:bg-primary-500/10 dark:text-primary-300' : 'bg-slate-100 text-slate-500 dark:bg-white/5' }}">{{ $album->status }}</span>
                            </td>
                            <td class="px-5 py-3 hidden sm:table-cell text-slate-500">{{ $album->published_human ?? '—' }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('dashboard.albums.edit', $album) }}" class="w-8 h-8 grid place-items-center rounded-lg text-slate-500 hover:bg-slate-100 dark:hover:bg-white/5"><i class="fa-solid fa-pen"></i></a>
                                    <form method="POST" action="{{ route('dashboard.albums.destroy', $album) }}">
                                        @csrf @method('DELETE')
                                        <button type="button" title="Hapus"
                                            @click="$store.confirm.ask($el.closest('form'), { title: 'Pindahkan ke Sampah', message: 'Album ini akan dipindahkan ke tempat sampah. Anda bisa memulihkannya nanti.', confirmText: 'Pindahkan' })"
                                            class="w-8 h-8 grid place-items-center rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-12 text-center text-slate-400">
                            @if (request()->hasAny(['q', 'category', 'status']))
                                Tidak ada album yang cocok dengan filter. <a href="{{ route('dashboard.albums.index') }}" class="text-primary font-semibold">Atur ulang filter</a>.
                            @else
                                Belum ada album. <a href="{{ route('dashboard.albums.create') }}" class="text-primary font-semibold">Buat album</a>.
                            @endif
                        </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $albums->links() }}</div>
@endsection
