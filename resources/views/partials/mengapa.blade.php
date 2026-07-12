{{-- MENGAPA YESL --}}
    <section id="mengapa" class="py-24 px-6 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto">
            <div class="max-w-3xl mx-auto text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Mengapa Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Mengapa YESL?</h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Lima alasan utama yang menjadikan YESL mitra tepercaya dalam pelestarian ekologi dan penguatan masyarakat adat. Setiap prinsip mencerminkan cara kami bekerja bersama komunitas di Tanah Papua.</p>
            </div>

            @php
                $mengapaYesl = [
                    ['fa-users', 'Dipimpin oleh Masyarakat Adat', 'Bekerja bersama dan dipimpin oleh masyarakat adat Papua.', 'images/mengapa-yesl/dipimpin-oleh-masyarakat-adat.jpg'],
                    ['fa-mountain-sun', 'Berbasis Bentang Alam', 'Pendekatan bentang alam untuk perlindungan yang berkelanjutan.', 'images/mengapa-yesl/berbasis-bentangan-alam.jpg'],
                    ['fa-magnifying-glass-chart', 'Berbasis Bukti', 'Keputusan berbasis data, riset, dan pengetahuan lokal.', 'images/mengapa-yesl/berbasis-bukti.jpg'],
                    ['fa-handshake', 'Kolaboratif', 'Berkolaborasi dengan pemerintah, komunitas, swasta, akademisi, dan donor.', 'images/mengapa-yesl/kolaboratif.jpg'],
                    ['fa-scale-balanced', 'Akuntabel & Transparan', 'Tata kelola yang baik dan transparansi dalam setiap langkah kami.', 'images/mengapa-yesl/akuntabel-transparant.jpg'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach ($mengapaYesl as [$icon, $title, $desc, $image])
                    <div class="group bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-200 dark:border-white/10 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        <div class="relative aspect-square flex items-center justify-center overflow-hidden">
                            {{-- Gambar background --}}
                            <img src="{{ asset($image) }}" alt="{{ $title }}" loading="lazy"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            {{-- Overlay gelap --}}
                            <div class="absolute inset-0 bg-slate-900/60 group-hover:bg-slate-900/50 transition-colors duration-500"></div>
                            {{-- Icon berwarna --}}
                            <div class="relative z-10 w-20 h-20 rounded-2xl flex items-center justify-center text-4xl shadow-inner backdrop-blur-sm group-hover:scale-110 transition-transform duration-500 {{ $loop->even ? 'bg-secondary/20 text-secondary' : 'bg-primary/20 text-primary' }}">
                                <i class="fa-solid {{ $icon }}"></i>
                            </div>
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-lg font-bold mb-2 leading-snug group-hover:text-primary transition-colors">{{ $title }}</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>