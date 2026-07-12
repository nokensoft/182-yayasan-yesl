{{-- GALERI (dinamis via API + Alpine) --}}
    <section id="galeri" class="py-24 px-6 bg-slate-50 dark:bg-slate-950" x-data="gallerySection()" x-init="init()">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Dokumentasi</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-3">Album & Galeri Kegiatan</h2>
                    <p class="text-slate-600 dark:text-slate-400 max-w-2xl">Ringkasan capaian program dari pemetaan partisipatif, kajian masyarakat adat, hingga perhutanan sosial di Tanah Papua.</p>
                </div>
                <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-primary-700 transition shadow-md shrink-0">
                    Semua Album <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            <div x-show="loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="i in 3" :key="i"><div class="animate-pulse bg-slate-100 dark:bg-white/5 rounded-3xl h-60"></div></template>
            </div>

            <div x-show="!loading && albums.length === 0" class="text-center py-14 text-slate-500">
                <i class="fa-regular fa-images text-4xl mb-3"></i>
                <p>Belum ada album yang dipublikasikan.</p>
            </div>

            <div x-show="!loading && albums.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="album in albums" :key="album.slug">
                    <a :href="album.url" class="group bg-white dark:bg-slate-900 p-4 rounded-3xl border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                        <div class="aspect-[1.91/1] overflow-hidden rounded-2xl border border-slate-200 dark:border-white/10 bg-slate-100 dark:bg-white/5">
                            <img :src="album.cover_image" :alt="album.title" x-show="album.cover_image" loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <p class="mt-4 text-base font-bold leading-snug group-hover:text-primary transition-colors" x-text="album.title"></p>
                        <div class="mt-3 pt-3 border-t border-slate-200/60 dark:border-white/10 flex items-center justify-between text-xs text-slate-400 font-medium">
                            <span class="flex items-center gap-1.5 bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 px-2.5 py-1 rounded-md text-[11px] font-bold">
                                <i class="fa-regular fa-images"></i> <span x-text="album.photos_count + ' Foto'"></span>
                            </span>
                            <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> <span x-text="album.views"></span></span>
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </section>