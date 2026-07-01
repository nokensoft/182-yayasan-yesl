@php($inputClass = 'w-full rounded-xl border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-800 px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none')
<form method="GET" action="{{ $action }}"
    class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-white/10 rounded-2xl p-4 md:p-5 grid gap-3 md:grid-cols-12 md:items-end">
    <div class="md:col-span-4">
        <label class="block text-xs font-semibold text-slate-500 mb-1">Pencarian</label>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul / isi..." class="{{ $inputClass }}">
    </div>
    <div class="md:col-span-3">
        <label class="block text-xs font-semibold text-slate-500 mb-1">Kategori</label>
        <select name="category" class="{{ $inputClass }}">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $c)
                <option value="{{ $c->slug }}" @selected(request('category') === $c->slug)>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="md:col-span-2">
        <label class="block text-xs font-semibold text-slate-500 mb-1">Urutkan</label>
        <select name="sort" class="{{ $inputClass }}">
            <option value="latest" @selected(request('sort', 'latest') === 'latest')>Terbaru</option>
            <option value="oldest" @selected(request('sort') === 'oldest')>Terlama</option>
            <option value="az" @selected(request('sort') === 'az')>Judul A → Z</option>
            <option value="za" @selected(request('sort') === 'za')>Judul Z → A</option>
        </select>
    </div>
    <div class="md:col-span-3 grid grid-cols-2 gap-2">
        <div>
            <label class="block text-xs font-semibold text-slate-500 mb-1">Dari</label>
            <input type="date" name="from" value="{{ request('from') }}" class="{{ $inputClass }}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 mb-1">Sampai</label>
            <input type="date" name="to" value="{{ request('to') }}" class="{{ $inputClass }}">
        </div>
    </div>
    <div class="md:col-span-12 flex flex-wrap gap-2 pt-1">
        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary-700 transition">
            <i class="fa-solid fa-magnifying-glass text-xs"></i> Terapkan Filter
        </button>
        <a href="{{ $action }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 text-sm font-semibold hover:bg-slate-200 dark:hover:bg-white/10 transition">
            <i class="fa-solid fa-rotate-left text-xs"></i> Reset
        </a>
    </div>
</form>
