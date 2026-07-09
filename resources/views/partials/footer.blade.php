<footer id="kontak" class="bg-white dark:bg-slate-900 pt-16 pb-10 px-6 border-t border-slate-100 dark:border-white/10">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-14">
            {{-- Kolom Kiri: Brand --}}
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <img src="{{ asset('images/logo-yesl.png') }}" alt="Logo YESL" class="w-9 h-9 object-contain">
                    <span class="font-extrabold text-lg tracking-tight text-slate-800 dark:text-slate-100">Yayasan Ekologi Sahul Lestari</span>
                </div>
                <p class="text-slate-500 dark:text-slate-400 max-w-md mb-6 leading-relaxed text-sm">
                    Organisasi nirlaba yang bergerak di bidang pelestarian ekologi, perlindungan keanekaragaman hayati, dan penguatan hak-hak masyarakat adat di Tanah Papua.
                </p>
                <div class="flex gap-3">
                    @foreach ([['instagram','fa-instagram'], ['facebook','fa-facebook-f'], ['youtube','fa-youtube'], ['whatsapp','fa-whatsapp']] as [$net, $icon])
                        <a href="#" target="_blank" rel="noopener" title="{{ ucfirst($net) }}"
                            class="w-10 h-10 bg-slate-100 dark:bg-white/5 rounded-full flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition">
                            <i class="fa-brands {{ $icon }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Kolom Tengah: Tautan (termasuk Kebijakan Privasi, dll) --}}
            <div>
                <h5 class="font-bold mb-5 uppercase tracking-widest text-xs text-slate-400">Tautan</h5>
                <ul class="space-y-3 font-semibold text-sm text-slate-600 dark:text-slate-300">
                    <li><a href="{{ route('home') }}#tentang" class="hover:text-primary transition">Tentang Kami</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary transition">Blog & Artikel</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-primary transition">Galeri Kegiatan</a></li>
                    <li><a href="{{ route('pages.faq') }}" class="hover:text-primary transition">FAQ</a></li>
                    <li><a href="{{ route('pages.privacy') }}" class="hover:text-primary transition">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('pages.sitemap') }}" class="hover:text-primary transition">Peta Situs</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-primary transition">Masuk</a></li>
                </ul>
            </div>

            {{-- Kolom Kanan: Kantor --}}
            <div>
                <h5 class="font-bold mb-5 uppercase tracking-widest text-xs text-slate-400">Kantor</h5>
                <div class="text-sm text-slate-600 dark:text-slate-300 font-medium leading-relaxed space-y-2">
                    <p class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot text-primary mt-1"></i>
                        <span>Kota Timika, Kabupaten Mimika,<br>Papua Tengah 99910</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-primary"></i>
                        <a href="mailto:info@yesl.or.id" class="hover:text-primary transition">info@yesl.or.id</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-100 dark:border-white/10 pt-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                {{-- Kolom Kiri: copyright --}}
                <div class="text-center md:text-left">
                    <p class="text-slate-400 text-sm">&copy; {{ date('Y') }} {{ config('app.name') }}. Seluruh hak cipta dilindungi.</p>
                    <p class="text-slate-400 text-xs mt-2 font-medium">Powered by
                        <a href="https://nokensoft.com" target="_blank" rel="noopener" class="font-bold text-slate-500 dark:text-slate-300 hover:text-primary transition">Nokensoft.com</a>
                    </p>
                </div>

                {{-- Kolom Kanan: logo NGO Source --}}
                <div class="flex-shrink-0">
                    <a href="https://www.ngosource.org/ed-made-easy/how-it-works" target="_blank" rel="noopener"
                        title="Verified by NGO Source">
                        <img src="{{ asset('images/ngo-source.png') }}" alt="NGO Source Verified"
                            class="h-16 w-auto object-contain opacity-90 hover:opacity-100 transition">
                    </a>
                </div>

            </div>
        </div>
    </div>
</footer>

{{-- Tombol Kembali ke Atas --}}
<button id="backToTop"
    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
    aria-label="Kembali ke atas"
    class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-primary text-white rounded-full shadow-lg
           flex items-center justify-center
           opacity-0 invisible transition-all duration-300
           hover:bg-primary/90 hover:scale-110">
    <i class="fa-solid fa-chevron-up text-sm"></i>
</button>

<script>
    (function () {
        const btn = document.getElementById('backToTop');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                btn.classList.remove('opacity-0', 'invisible');
                btn.classList.add('opacity-100', 'visible');
            } else {
                btn.classList.add('opacity-0', 'invisible');
                btn.classList.remove('opacity-100', 'visible');
            }
        }, { passive: true });
    })();
</script>
