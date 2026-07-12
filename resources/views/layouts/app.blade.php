<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Hindari flash of unstyled dark mode --}}
    <script>
        (function () {
            try {
                const t = localStorage.getItem('theme');
                if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                }
                if (localStorage.getItem('devNoticeDismissed') === '1') {
                    document.documentElement.classList.add('notice-dismissed');
                }
            } catch (e) {}
        })();
    </script>

    <title>@yield('page_title', 'Beranda') · {{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta_description', 'Yayasan Ekologi Sahul Lestari (YESL) berkomitmen pada pelestarian ekologi, konservasi, dan penguatan hak masyarakat adat di Tanah Papua.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <link rel="icon" type="image/png" href="{{ asset('images/logo-yesl.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-yesl.png') }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="@yield('page_title', config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', 'Pelestarian ekologi & penguatan masyarakat adat Papua.')">
    <meta property="og:url" content="@yield('canonical', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/logo-yesl.png'))">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('page_title', config('app.name'))">
    <meta name="twitter:description" content="@yield('meta_description', 'Pelestarian ekologi & penguatan masyarakat adat Papua.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/logo-yesl.png'))">

    {{-- Fonts & icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>

<body class="font-sans bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 antialiased overflow-x-hidden">

    @include('partials.dev-notice')
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Google Translate (custom) — widget disembunyikan, dikontrol via toggle ID/EN di navbar --}}
    <div id="google_translate_element" class="hidden" aria-hidden="true"></div>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en',
                autoDisplay: false,
            }, 'google_translate_element');
        }
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>

</html>
