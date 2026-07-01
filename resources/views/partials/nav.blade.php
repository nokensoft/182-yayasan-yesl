@php($isHome = request()->routeIs('home'))
<nav x-data="{ open: false, scrolled: false, solid: {{ $isHome ? 'false' : 'true' }} }"
    @scroll.window="scrolled = window.pageYOffset > 20"
    :class="(scrolled || solid) ? 'glass shadow-sm py-3 dark:border-b dark:border-white/10' : 'bg-transparent py-5'"
    class="site-nav fixed w-full z-50 transition-all duration-300 px-5">
    <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo-yesl.png') }}" alt="Logo YESL" class="w-10 h-10 object-contain">
            <div class="flex flex-col">
                <span class="font-extrabold text-xl tracking-tight leading-none text-primary">YESL</span>
                <span class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 tracking-wide uppercase hidden sm:block mt-0.5">Yayasan Ekologi Sahul Lestari</span>
            </div>
        </a>

        <div class="hidden md:flex items-center gap-7 font-medium text-slate-700 dark:text-slate-200">
            <a href="{{ route('home') }}" class="hover:text-primary transition">Beranda</a>
            <a href="{{ route('home') }}#tentang" class="hover:text-primary transition">Tentang</a>
            <a href="{{ route('blog.index') }}" class="hover:text-primary transition {{ request()->routeIs('blog.*') ? 'text-primary' : '' }}">Blog</a>
            <a href="{{ route('gallery.index') }}" class="hover:text-primary transition {{ request()->routeIs('gallery.*') ? 'text-primary' : '' }}">Galeri</a>
            <a href="{{ route('home') }}#kontak" class="hover:text-primary transition">Kontak</a>

            <button @click="$store.theme.toggle()" title="Ganti tema"
                class="w-9 h-9 rounded-full grid place-items-center text-slate-600 dark:text-slate-300 hover:bg-slate-200/60 dark:hover:bg-white/10 transition">
                <i class="fa-solid" :class="$store.theme.dark ? 'fa-sun' : 'fa-moon'"></i>
            </button>

            <a href="{{ route('home') }}#donasi"
                class="bg-primary text-white px-5 py-2 rounded-full hover:bg-primary-700 transition shadow-md shadow-primary/20">Donasi</a>
        </div>

        <div class="flex items-center gap-2 md:hidden">
            <button @click="$store.theme.toggle()" title="Ganti tema"
                class="w-9 h-9 rounded-full grid place-items-center text-slate-600 dark:text-slate-300 hover:bg-slate-200/60 dark:hover:bg-white/10 transition">
                <i class="fa-solid" :class="$store.theme.dark ? 'fa-sun' : 'fa-moon'"></i>
            </button>
            <button @click="open = !open" class="text-2xl text-primary focus:outline-none w-9 h-9 grid place-items-center">
                <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak @click.away="open = false"
        class="md:hidden absolute top-full left-0 w-full bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-white/10 p-6 space-y-3 shadow-xl">
        <a href="{{ route('home') }}" @click="open = false" class="block font-medium hover:text-primary py-1">Beranda</a>
        <a href="{{ route('home') }}#tentang" @click="open = false" class="block font-medium hover:text-primary py-1">Tentang</a>
        <a href="{{ route('blog.index') }}" @click="open = false" class="block font-medium hover:text-primary py-1">Blog</a>
        <a href="{{ route('gallery.index') }}" @click="open = false" class="block font-medium hover:text-primary py-1">Galeri</a>
        <a href="{{ route('home') }}#kontak" @click="open = false" class="block font-medium hover:text-primary py-1">Kontak</a>
        <a href="{{ route('home') }}#donasi" @click="open = false"
            class="block bg-primary text-white text-center py-2.5 rounded-xl font-medium hover:bg-primary-700 transition">Donasi</a>
    </div>
</nav>
