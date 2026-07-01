<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Masuk · {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="{{ asset('images/logo-yesl.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <img src="{{ asset('images/logo-yesl.png') }}" alt="Logo YESL" class="w-12 h-12 object-contain">
                <span class="font-extrabold text-2xl text-primary">YESL</span>
            </a>
            <p class="text-slate-500 dark:text-slate-400 mt-3 text-sm">Masuk ke panel pengelolaan konten</p>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-slate-200 dark:border-white/10 p-8">
            @if ($errors->any())
                <div class="mb-5 rounded-xl bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/30 text-red-700 dark:text-red-300 text-sm px-4 py-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full rounded-xl border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold mb-1.5">Kata Sandi</label>
                    <input id="password" type="password" name="password" required
                        class="w-full rounded-xl border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-slate-800 px-4 py-2.5 focus:ring-2 focus:ring-primary focus:border-primary outline-none">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-primary focus:ring-primary">
                    Ingat saya
                </label>
                <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-700 transition shadow-lg shadow-primary/20">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center mt-6 text-sm text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-primary"><i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke situs</a>
        </p>
    </div>
</body>

</html>
