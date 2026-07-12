{{-- NILAI --}}
    <section id="nilai" class="relative py-24 bg-slate-50 dark:bg-slate-950 bg-fixed bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg1.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        {{-- Overlay gelap --}}
        <div class="absolute inset-0 bg-slate-900/60 dark:bg-slate-900/70 pointer-events-none"></div>
        <div class="relative z-10 max-w-5xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Nilai Inti</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4 text-white">Nilai-Nilai Organisasi</h2>
                <p class="text-slate-200 leading-relaxed max-w-2xl mx-auto mt-4">Prinsip-prinsip utama yang memandu setiap langkah kerja dan pengambilan keputusan YESL bersama masyarakat adat.</p>
            </div>
            @php
                $nilai = [
                    ['Keberpihakan Masyarakat Adat', 'Menghormati, melindungi, dan memperjuangkan hak-hak serta kearifan lokal masyarakat adat.'],
                    ['Kelestarian Bentang Alam', 'Menjaga keseimbangan ekosistem dan memastikan perlindungan lingkungan hidup yang berkelanjutan.'],
                    ['Kolaboratif', 'Membangun kerja sama yang sinergis, inklusif, dan saling percaya dengan berbagai pihak.'],
                    ['Integritas dan Akuntabilitas', 'Menjunjung tinggi kejujuran, etika kerja, dan tanggung jawab yang transparan dalam setiap tindakan.'],
                    ['Pembelajaran dan Inovatif', 'Terus belajar, beradaptasi dengan perubahan, dan menciptakan solusi baru yang kreatif.'],
                ];
            @endphp
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 justify-center">
                @foreach ($nilai as [$title, $desc])
                    <div class="p-5 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10">
                        <h4 class="font-bold mb-2 flex items-center gap-2"><i class="fa-solid fa-leaf text-primary text-sm"></i> {{ $title }}</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>