{{-- SECTION VISI MISI --}}
    <section id="struktur" class="relative py-24 px-6 overflow-hidden bg-white dark:bg-slate-900">
        {{-- Dekorasi latar --}}
        <div class="absolute top-0 -left-24 w-72 h-72 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 -right-24 w-72 h-72 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Header Kontainer Visi --}}
        <div class="relative z-10 max-w-5xl mx-auto text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Arah Organisasi</span>
            <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Visi & Misi</h2>
            <p class="text-slate-600 dark:text-slate-400 leading-relaxed max-w-2xl mx-auto">Landasan arah dan komitmen YESL dalam mewujudkan tata kelola sumber daya alam yang berkelanjutan, berkeadilan, dan kolaboratif di Tanah Papua.</p>
            {{-- Visi Utama --}}
            <div class="relative overflow-hidden bg-gradient-to-br from-primary/10 via-primary/5 to-transparent dark:from-primary/20 dark:via-primary/10 dark:to-transparent p-8 md:p-10 rounded-3xl border border-primary/15 max-w-3xl mx-auto mt-8 shadow-sm">
                <i class="fa-solid fa-quote-left absolute -top-4 left-4 text-7xl text-primary/10 dark:text-primary/15 pointer-events-none select-none"></i>
                <div class="relative">
                    <span class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-primary mb-3">
                        <i class="fa-solid fa-eye"></i> Visi Kami
                    </span>
                    <p class="text-slate-700 dark:text-slate-200 text-lg md:text-xl font-medium leading-relaxed">
                        Terwujudnya bentang alam yang lestari dan kemandirian masyarakat adat melalui tata kelola sumberdaya alam yang berkelanjutan, berkeadilan dan kolaboratif di Tanah Papua.
                    </p>
                </div>
            </div>
        </div>

        @php
            $misiPoin = [
                'Melindungi dan mengelola bentang alam dan keanekaragaman hayati secara berkelanjutan.',
                'Memperkuat kapasitas hak dan ketahanan masyarakat dalam mengelola sumber daya alam secara mandiri dan berkelanjutan.',
                'Mengembangkan model pemberdayaan ekonomi yang inklusif dan berkelanjutan dalam meningkatkan kesejahteraan masyarakat adat.',
                'Mendorong kolaborasi multi pihak dan kebijakan dalam mendukung perlindungan dan pengelolaan bentang alam dan pemberdayaan ekonomi berbasis masyarakat adat yang berkelanjutan.',
                'Membangun organisasi yang profesional, akuntabel, inovatif dan berkelanjutan.'
            ];
        @endphp

        {{-- Grid Misi & Wilayah Kerja --}}
        <div class="relative z-10 grid lg:grid-cols-3 gap-6 max-w-5xl mx-auto items-start">
            
            {{-- Kolom Misi (2 Kolom) --}}
            <div class="lg:col-span-2 bg-slate-50 dark:bg-slate-800/50 p-8 md:p-10 rounded-3xl border border-slate-200 dark:border-white/10 shadow-sm">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary text-xl shadow-inner shrink-0">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h3 class="text-2xl font-bold">Misi Yayasan</h3>
                </div>
                
                <ul class="space-y-1">
                    @foreach ($misiPoin as $index => $misi)
                        <li class="group flex items-start gap-4 p-3 -mx-3 rounded-2xl hover:bg-white dark:hover:bg-white/5 transition-colors">
                            <span class="w-8 h-8 bg-primary text-white text-sm font-bold rounded-full flex items-center justify-center shrink-0 shadow-sm shadow-primary/30 group-hover:scale-110 transition-transform">
                                {{ $index + 1 }}
                            </span>
                            <p class="text-slate-600 dark:text-slate-300 text-base leading-relaxed pt-0.5">{{ $misi }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Kolom Lokasi (1 Kolom) --}}
            <div class="bg-slate-50 dark:bg-slate-800/50 p-8 rounded-3xl border border-slate-200 dark:border-white/10 shadow-sm h-full flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary text-xl mb-6 shadow-inner">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Wilayah Kerja & Kedudukan</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                        Berkedudukan di Kabupaten Mimika, Provinsi Papua Tengah, serta bekerja bersama komunitas adat di berbagai wilayah bentang alam Tanah Papua.
                    </p>
                </div>
                
                <div class="mt-8 pt-6 border-t border-slate-200/60 dark:border-white/5 text-xs text-slate-400 dark:text-slate-500 flex items-center gap-2">
                    <i class="fa-solid fa-building-flag text-primary"></i> Sekretariat Utama • Mimika
                </div>
            </div>

        </div>
    </section>