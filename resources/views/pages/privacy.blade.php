@extends('layouts.app')

@section('page_title', 'Kebijakan Privasi')
@section('meta_description', 'Kebijakan privasi Yayasan Ekologi Sahul Lestari (YESL) mengenai pengumpulan dan penggunaan data pengunjung situs.')

@section('content')
    <header class="pt-28 pb-8 px-6 bg-slate-50 dark:bg-slate-950 border-b border-slate-100 dark:border-white/10">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-extrabold">Kebijakan Privasi</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm">Terakhir diperbarui: {{ now()->locale('id')->translatedFormat('d F Y') }}</p>
        </div>
    </header>

    <section class="py-12 px-6">
        <div class="max-w-3xl mx-auto article-content text-slate-700 dark:text-slate-300">
            <p>Yayasan Ekologi Sahul Lestari ("YESL", "kami") menghormati privasi setiap pengunjung situs ini. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.</p>

            <h2>Informasi yang Kami Kumpulkan</h2>
            <p>Kami dapat mengumpulkan informasi yang Anda berikan secara sukarela (misalnya saat menghubungi kami melalui email atau WhatsApp) serta data teknis non-pribadi seperti jenis perangkat dan halaman yang dikunjungi untuk keperluan analitik.</p>

            <h2>Penggunaan Informasi</h2>
            <ul>
                <li>Menanggapi pertanyaan, permintaan, dan kolaborasi.</li>
                <li>Meningkatkan kualitas konten dan layanan situs.</li>
                <li>Menjaga keamanan serta mencegah penyalahgunaan.</li>
            </ul>

            <h2>Perlindungan Data</h2>
            <p>Kami menerapkan langkah-langkah teknis dan organisasi yang wajar untuk melindungi data Anda dari akses tidak sah, kehilangan, atau penyalahgunaan.</p>

            <h2>Cookie</h2>
            <p>Situs ini dapat menggunakan cookie atau penyimpanan lokal (localStorage) untuk menyimpan preferensi seperti mode tampilan (terang/gelap). Anda dapat menonaktifkannya melalui pengaturan peramban.</p>

            <h2>Hubungi Kami</h2>
            <p>Untuk pertanyaan mengenai kebijakan privasi ini, silakan hubungi kami di <a href="mailto:info@yesl.or.id">info@yesl.or.id</a>.</p>
        </div>
    </section>
@endsection
