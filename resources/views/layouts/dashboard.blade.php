<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        (function () {
            try {
                const t = localStorage.getItem('theme');
                if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
            } catch (e) {}
        })();
    </script>
    <title>@yield('page_title', 'Dashboard') · {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-yesl.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased"
    x-data="{ sidebar: false }">

    @php
        $nav = [
            ['route' => 'dashboard', 'active' => 'dashboard', 'icon' => 'fa-gauge-high', 'label' => 'Dashboard'],
            ['route' => 'dashboard.posts.index', 'active' => 'dashboard.posts.*', 'icon' => 'fa-newspaper', 'label' => 'Blog'],
            ['route' => 'dashboard.categories.index', 'active' => 'dashboard.categories.*', 'icon' => 'fa-tags', 'label' => 'Kategori'],
            ['route' => 'dashboard.albums.index', 'active' => 'dashboard.albums.*', 'icon' => 'fa-images', 'label' => 'Album & Galeri'],
        ];
    @endphp

    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-white dark:bg-slate-900 border-r border-slate-200 dark:border-white/10 transform transition-transform md:translate-x-0"
        :class="sidebar ? 'translate-x-0' : '-translate-x-full'">
        <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-200 dark:border-white/10">
            <img src="{{ asset('images/logo-yesl.png') }}" alt="YESL" class="w-8 h-8 object-contain">
            <span class="font-extrabold text-lg text-primary">YESL Admin</span>
        </div>
        <nav class="p-4 space-y-1">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium transition {{ request()->routeIs($item['active']) ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
                    <i class="fa-solid {{ $item['icon'] }} w-5 text-center"></i> {{ $item['label'] }}
                </a>
            @endforeach

            @if (auth()->user()->isAdmin())
                <a href="{{ route('dashboard.users.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('dashboard.users.*') ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
                    <i class="fa-solid fa-users-gear w-5 text-center"></i> Pengguna
                </a>
            @endif

            <div class="pt-4 mt-4 border-t border-slate-200 dark:border-white/10 space-y-1">
                <a href="{{ route('dashboard.profile.edit') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium transition {{ request()->routeIs('dashboard.profile.*') ? 'bg-primary text-white' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5' }}">
                    <i class="fa-solid fa-user-gear w-5 text-center"></i> Profil
                </a>
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5 transition">
                    <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center"></i> Lihat Situs
                </a>
            </div>
        </nav>
    </aside>

    <div x-show="sidebar" x-cloak @click="sidebar = false" class="fixed inset-0 z-30 bg-slate-900/50 md:hidden"></div>

    {{-- Main --}}
    <div class="md:ml-64 flex flex-col min-h-screen">
        <header class="h-16 sticky top-0 z-20 bg-white/80 dark:bg-slate-900/80 backdrop-blur border-b border-slate-200 dark:border-white/10 flex items-center justify-between px-4 md:px-8">
            <div class="flex items-center gap-3">
                <button @click="sidebar = !sidebar" class="md:hidden w-9 h-9 grid place-items-center rounded-lg hover:bg-slate-100 dark:hover:bg-white/5">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h1 class="font-bold text-lg">@yield('page_title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-2">
                <button @click="$store.theme.toggle()" title="Ganti tema"
                    class="w-9 h-9 rounded-full grid place-items-center text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5">
                    <i class="fa-solid" :class="$store.theme.dark ? 'fa-sun' : 'fa-moon'"></i>
                </button>
                <div class="hidden sm:flex flex-col items-end leading-tight mr-1">
                    <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] uppercase tracking-wide font-bold {{ auth()->user()->isAdmin() ? 'text-primary' : 'text-slate-400' }}">{{ auth()->user()->role }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-9 h-9 rounded-full grid place-items-center text-slate-600 dark:text-slate-300 hover:bg-red-50 hover:text-red-600 dark:hover:bg-red-500/10 transition" title="Keluar">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-4 md:p-8">
            @include('partials.flash')
            @yield('content')
        </main>

        <footer class="px-4 md:px-8 py-6 border-t border-slate-200 dark:border-white/10 text-center text-xs text-slate-400">
            &copy; {{ date('Y') }} {{ config('app.name') }} · Panel Admin
            <span class="mx-1">·</span>
            Powered by <a href="https://nokensoft.com" target="_blank" rel="noopener" class="font-semibold text-slate-500 dark:text-slate-300 hover:text-primary transition">Nokensoft.com</a>
        </footer>
    </div>

    @include('partials.confirm-modal')

    @stack('scripts')
</body>

</html>
