{{-- MITRA KERJA --}}
<section id="mitra" class="py-24 px-6 bg-white dark:bg-slate-900">
    <div class="max-w-7xl mx-auto">
        <div class="max-w-3xl mx-auto text-center mb-14">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Mitra Kerja</span>
            <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Mitra Kerja Kami</h2>
            <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Berbagai lembaga pemerintah, akademik, dan organisasi yang berkolaborasi bersama YESL dalam pelestarian ekologi dan penguatan masyarakat adat di Tanah Papua.</p>
        </div>

        @php
            $mitraKerja = [
                ['logo' => 'images/patners/logo-brin.png', 'name' => 'BRIN'],
                ['logo' => 'images/patners/logo-econusa.png', 'name' => 'EcoNusa'],
                ['logo' => 'images/patners/logo-kabupaten-mimika.jpg', 'name' => 'Kabupaten Mimika'],
                ['logo' => 'images/patners/logo-konservasi-indonesia.png', 'name' => 'Konservasi Indonesia'],
                ['logo' => 'images/patners/logo-learning-transforms-lives.png', 'name' => 'Learning Transforms Lives'],
                ['logo' => 'images/patners/logo-packard-foundation.png', 'name' => 'Packard Foundation'],
                ['logo' => 'images/patners/logo-the-asia-foundation.png', 'name' => 'The Asia Foundation'],
            ];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($mitraKerja as $mitra)
                <div class="aspect-[3/2] flex items-center justify-center bg-white rounded-3xl border border-slate-200 dark:border-white/10 p-6 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset($mitra['logo']) }}" alt="{{ $mitra['name'] }}" loading="lazy"
                        class="max-w-full max-h-full object-contain">
                </div>
            @endforeach
        </div>
    </div>
</section>
