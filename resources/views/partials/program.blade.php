{{-- PROGRAM PRIORITAS --}}
    <section id="program" class="py-24 px-6 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto">
            <div class="max-w-3xl mx-auto text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Program Prioritas</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Empat Pilar Program Prioritas</h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Program prioritas YESL menjadi pilar utama dalam mewujudkan tata kelola sumber daya alam yang adil dan berkelanjutan di Tanah Papua. Keempat program ini saling terhubung untuk memperkuat pengetahuan, ekonomi, kapasitas, serta pembiayaan bagi masyarakat adat.</p>
            </div>

            @php
                $programPrioritas = [
                    ['fa-book-open', 'Kajian dan Pengelolaan Pengetahuan dan Media', 'Mendokumentasikan kearifan lokal serta mengelola data dan media sebagai basis advokasi kebijakan dan edukasi publik.', 'images/proram-prioritas/kajian-media.jpg'],
                    ['fa-arrow-trend-up', 'Transformasi Ekonomi Masyarakat Adat', 'Mengembangkan model ekonomi berbasis potensi lokal yang inklusif, adil, dan menjaga kelestarian bentang alam.', 'images/proram-prioritas/transformasi-ekonomi.jpg'],
                    ['fa-people-group', 'Pemberdayaan Masyarakat Adat', 'Memperkuat kapasitas, hak, dan kelembagaan adat agar masyarakat mandiri mengelola wilayah dan sumber penghidupannya.', 'images/proram-prioritas/masyarakat-adat.jpg'],
                    ['fa-hand-holding-dollar', 'Pembiayaan Inovatif', 'Merancang skema pendanaan kreatif dan berkelanjutan untuk mendukung konservasi dan kesejahteraan masyarakat adat.', 'images/proram-prioritas/pembiayaan-inovatif.jpg'],
                ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($programPrioritas as [$icon, $title, $desc, $image])
                    <div class="group relative overflow-hidden p-8 rounded-3xl border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        {{-- Gambar background --}}
                        <img src="{{ asset($image) }}" alt="{{ $title }}" loading="lazy"
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        {{-- Overlay gelap --}}
                        <div class="absolute inset-0 bg-slate-900/70 group-hover:bg-slate-900/60 transition-colors duration-500"></div>
                        {{-- Konten --}}
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-4xl mb-6 shadow-inner {{ $loop->even ? 'bg-secondary/10 text-secondary' : 'bg-primary/10 text-primary' }}">
                                <i class="fa-solid {{ $icon }}"></i>
                            </div>
                            <h3 class="text-lg font-bold mb-2 leading-snug text-white">{{ $title }}</h3>
                            <p class="text-sm text-slate-200 leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('pages.program') }}"
                    class="inline-flex items-center gap-2 px-7 py-3.5 mt-6 rounded-2xl bg-primary text-white font-bold hover:bg-primary-700 transition shadow-md shadow-primary/20">
                    Lihat Perjalanan Program Kami <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </section>