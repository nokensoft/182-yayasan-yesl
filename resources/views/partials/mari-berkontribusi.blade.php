{{-- DONASI / MARI BERKONTRIBUSI --}}
<section id="donasi" class="py-24 px-6 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="relative h-64 sm:h-80 lg:h-full rounded-3xl overflow-hidden border border-white/10 shadow-2xl">
            <img src="{{ asset('images/pemetaan-profil-adat.jpg') }}" alt="Dukung Aksi Ekologi YESL" class="w-full h-full object-cover" loading="lazy">
        </div>
        <div x-data="{ showRekening: false, copied: false }">
            <span class="inline-block px-3.5 py-1.5 bg-primary-500/20 border border-primary-400/30 text-primary-300 rounded-full text-xs font-bold tracking-wider uppercase mb-4">Mari Berkontribusi</span>
            <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-6">Dukung Aksi Nyata Pelestarian Ekologi & Masyarakat Adat Papua</h2>
            <p class="text-slate-300 mb-8 leading-relaxed">Setiap dukungan Anda dialokasikan langsung untuk pemetaan partisipatif wilayah adat, penguatan perempuan pengelola hutan desa, dan kajian ekosobling di garda terdepan Papua.</p>

            {{-- Tombol Aksi --}}
            <div class="flex flex-wrap items-center gap-3">
                <a href="https://wa.me/62811490000" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-3 px-7 py-3.5 bg-primary text-white font-bold rounded-2xl hover:bg-primary-600 transition shadow-xl">
                    <i class="fa-brands fa-whatsapp text-xl"></i> Hubungi via WhatsApp
                </a>
                <button type="button" @click="showRekening = !showRekening"
                    :aria-expanded="showRekening" aria-controls="info-rekening-donasi"
                    class="inline-flex items-center gap-3 px-7 py-3.5 border border-white/25 text-white font-bold rounded-2xl hover:bg-white/10 transition">
                    <i class="fa-solid fa-building-columns text-lg"></i> Informasi Rekening
                    <i class="fa-solid fa-chevron-down text-sm transition-transform duration-300" :class="showRekening && 'rotate-180'"></i>
                </button>
            </div>

            {{-- Panel Informasi Rekening Donasi --}}
            <div id="info-rekening-donasi" x-show="showRekening" x-cloak x-transition
                class="mt-6 rounded-3xl border border-white/10 bg-white/5 p-6 sm:p-7">
                <h3 class="flex items-center gap-2 text-lg font-bold mb-5">
                    <i class="fa-solid fa-hand-holding-heart text-primary-300"></i> Rekening Donasi
                </h3>

                {{-- Detail Rekening --}}
                <dl class="space-y-3 text-sm">
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-slate-400 shrink-0">Nama Pemegang Rekening</dt>
                        <dd class="font-semibold text-right">EKOLOGI SAHUL LESTARI</dd>
                    </div>
                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-slate-400 shrink-0">Nomor Rekening</dt>
                        <dd class="flex items-center gap-2 font-semibold">
                            <span class="tracking-wider">056101002563303</span>
                            <button type="button" aria-label="Salin nomor rekening"
                                @click="navigator.clipboard.writeText('056101002563303').then(() => { copied = true; setTimeout(() => copied = false, 2000); })"
                                class="w-8 h-8 grid place-items-center rounded-lg bg-white/10 hover:bg-white/20 transition shrink-0">
                                <i class="fa-solid" :class="copied ? 'fa-check text-primary-300' : 'fa-copy'"></i>
                            </button>
                        </dd>
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-slate-400 shrink-0">Nama Bank</dt>
                        <dd class="font-semibold text-right">Bank Rakyat Indonesia (BRI)</dd>
                    </div>
                    <div class="flex items-start justify-between gap-4">
                        <dt class="text-slate-400 shrink-0">Cabang</dt>
                        <dd class="font-semibold text-right">Cabang Timika</dd>
                    </div>
                </dl>

                {{-- Instruksi Donasi --}}
                <div class="mt-6 pt-6 border-t border-white/10">
                    <p class="text-sm font-bold mb-3">Cara Berdonasi</p>
                    <ol class="space-y-2 text-sm text-slate-300 list-decimal ps-5 marker:font-bold marker:text-primary-300">
                        <li>Kirim donasi Anda ke nomor rekening di atas.</li>
                        <li>Simpan bukti transfer Anda.</li>
                        <li>Kirim bukti transfer kepada kami melalui tombol WhatsApp di bawah.</li>
                    </ol>
                    <a href="{{ 'https://wa.me/62811490000?text=' . rawurlencode('Halo YESL, saya telah melakukan donasi ke rekening BRI a.n. EKOLOGI SAHUL LESTARI. Berikut saya lampirkan bukti transfernya. Terima kasih.') }}"
                        target="_blank" rel="noopener"
                        class="mt-5 inline-flex items-center gap-3 px-6 py-3 bg-primary text-white font-bold rounded-2xl hover:bg-primary-600 transition shadow-lg">
                        <i class="fa-brands fa-whatsapp text-xl"></i> Hubungi via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
