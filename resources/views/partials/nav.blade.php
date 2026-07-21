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
            <div class="relative" x-data="{ dropdown: false }" @mouseenter="dropdown = true" @mouseleave="dropdown = false">
                <button type="button" @click="dropdown = !dropdown" class="flex items-center gap-1.5 hover:text-primary transition">
                    Tentang
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200" :class="dropdown && 'rotate-180'"></i>
                </button>
                <div x-show="dropdown" x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-1"
                    class="absolute left-0 top-full pt-3 w-64">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-white/10 shadow-xl shadow-slate-900/5 p-2">
                        <a href="{{ route('pages.tentang') }}#tentang" @click="dropdown = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-500/10 hover:text-primary transition">
                            <i class="fa-solid fa-circle-info w-5 text-center text-primary"></i> Tentang YESL
                        </a>
                        <a href="{{ route('pages.tentang') }}#struktur" @click="dropdown = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-500/10 hover:text-primary transition">
                            <i class="fa-solid fa-bullseye w-5 text-center text-primary"></i> Visi & Misi
                        </a>
                        <a href="{{ route('pages.tentang') }}#nilai" @click="dropdown = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-500/10 hover:text-primary transition">
                            <i class="fa-solid fa-leaf w-5 text-center text-primary"></i> Nilai Organisasi
                        </a>
                        <a href="{{ route('pages.tentang') }}#program" @click="dropdown = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-500/10 hover:text-primary transition">
                            <i class="fa-solid fa-diagram-project w-5 text-center text-primary"></i> Program
                        </a>
                        <a href="{{ route('pages.tentang') }}#tim" @click="dropdown = false" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-primary-50 dark:hover:bg-primary-500/10 hover:text-primary transition">
                            <i class="fa-solid fa-user-group w-5 text-center text-primary"></i> Tim YSEL
                        </a>
                    </div>
                </div>
            </div>
            <a href="{{ route('pages.program') }}" class="hover:text-primary transition {{ request()->routeIs('pages.program') ? 'text-primary' : '' }}">Perjalanan Program</a>
            <a href="{{ route('blog.index') }}" class="hover:text-primary transition {{ request()->routeIs('blog.*') ? 'text-primary' : '' }}">Blog</a>
            <a href="{{ route('gallery.index') }}" class="hover:text-primary transition {{ request()->routeIs('gallery.*') ? 'text-primary' : '' }}">Galeri</a>
            <a href="{{ route('pages.tentang') }}#mitra" class="hover:text-primary transition">Mitra</a>
            <a href="{{ route('home') }}#kontak" class="hover:text-primary transition">Kontak</a>

            <button @click="$store.theme.toggle()" title="Ganti tema"
                class="w-9 h-9 rounded-full grid place-items-center text-slate-600 dark:text-slate-300 hover:bg-slate-200/60 dark:hover:bg-white/10 transition">
                <i class="fa-solid" :class="$store.theme.dark ? 'fa-sun' : 'fa-moon'"></i>
            </button>

            <div class="notranslate flex items-center rounded-full border border-slate-300 dark:border-white/15 overflow-hidden text-xs font-bold" translate="no" title="Pilih bahasa">
                <button type="button" @click="$store.lang.set('id')"
                    :class="$store.lang.current === 'id' ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-200/60 dark:hover:bg-white/10'"
                    class="px-2.5 py-1.5 leading-none transition">ID</button>
                <button type="button" @click="$store.lang.set('en')"
                    :class="$store.lang.current === 'en' ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-200/60 dark:hover:bg-white/10'"
                    class="px-2.5 py-1.5 leading-none transition">EN</button>
            </div>

            <a href="{{ route('home') }}#donasi"
                class="bg-primary text-white px-5 py-2 rounded-full hover:bg-primary-700 transition shadow-md shadow-primary/20">Donasi</a>
        </div>

        <div class="flex items-center gap-2 md:hidden">
            <button @click="$store.theme.toggle()" title="Ganti tema"
                class="w-9 h-9 rounded-full grid place-items-center text-slate-600 dark:text-slate-300 hover:bg-slate-200/60 dark:hover:bg-white/10 transition">
                <i class="fa-solid" :class="$store.theme.dark ? 'fa-sun' : 'fa-moon'"></i>
            </button>

            <div class="notranslate flex items-center rounded-full border border-slate-300 dark:border-white/15 overflow-hidden text-xs font-bold" translate="no" title="Pilih bahasa">
                <button type="button" @click="$store.lang.set('id')"
                    :class="$store.lang.current === 'id' ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-200/60 dark:hover:bg-white/10'"
                    class="px-2.5 py-1.5 leading-none transition">ID</button>
                <button type="button" @click="$store.lang.set('en')"
                    :class="$store.lang.current === 'en' ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-200/60 dark:hover:bg-white/10'"
                    class="px-2.5 py-1.5 leading-none transition">EN</button>
            </div>
            <button @click="open = !open" class="text-2xl text-primary focus:outline-none w-9 h-9 grid place-items-center">
                <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak @click.away="open = false"
        class="md:hidden absolute top-full left-0 w-full bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-white/10 p-6 space-y-3 shadow-xl">
        <a href="{{ route('home') }}" @click="open = false" class="block font-medium hover:text-primary py-1">Beranda</a>
        <div x-data="{ sub: false }">
            <button type="button" @click="sub = !sub" class="w-full flex items-center justify-between font-medium hover:text-primary py-1">
                Tentang
                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="sub && 'rotate-180'"></i>
            </button>
            <div x-show="sub" x-cloak x-transition class="mt-1 mb-1 ml-2 pl-3 border-l border-slate-200 dark:border-white/10 space-y-1">
                <a href="{{ route('pages.tentang') }}#tentang" @click="open = false" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-primary py-1.5">Tentang YESL</a>
                <a href="{{ route('pages.tentang') }}#struktur" @click="open = false" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-primary py-1.5">Visi & Misi</a>
                <a href="{{ route('pages.tentang') }}#nilai" @click="open = false" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-primary py-1.5">Nilai Organisasi</a>
                <a href="{{ route('pages.tentang') }}#program" @click="open = false" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-primary py-1.5">Program</a>
                <a href="{{ route('pages.tentang') }}#tim" @click="open = false" class="block text-sm text-slate-600 dark:text-slate-300 hover:text-primary py-1.5">Tim YSEL</a>
            </div>
        </div>
        <a href="{{ route('pages.program') }}" @click="open = false" class="block font-medium hover:text-primary py-1">Perjalanan Program</a>
        <a href="{{ route('blog.index') }}" @click="open = false" class="block font-medium hover:text-primary py-1">Blog</a>
        <a href="{{ route('gallery.index') }}" @click="open = false" class="block font-medium hover:text-primary py-1">Galeri</a>
        <a href="{{ route('pages.tentang') }}#mitra" @click="open = false" class="block font-medium hover:text-primary py-1">Mitra</a>
        <a href="{{ route('home') }}#kontak" @click="open = false" class="block font-medium hover:text-primary py-1">Kontak</a>
        <a href="{{ route('home') }}#donasi" @click="open = false"
            class="block bg-primary text-white text-center py-2.5 rounded-xl font-medium hover:bg-primary-700 transition">Donasi</a>
    </div>
</nav>
