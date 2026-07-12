{{-- BLOG + KATEGORI (dinamis via API + Alpine) --}}
    <section id="blog" class="py-24 px-6 bg-white dark:bg-slate-900"
        x-data="blogSection()" x-init="init()">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8">
                <div>
                    <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Kabar Terbaru</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-3">Blog & Artikel YESL</h2>
                    <p class="text-slate-600 dark:text-slate-400 max-w-2xl">Cerita dari lapangan, catatan refleksi, dan perkembangan program pemberdayaan masyarakat adat serta pelestarian lingkungan.</p>
                </div>
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-primary-700 transition shadow-md shrink-0">
                    Semua Artikel <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            {{-- Filter kategori --}}
            <div class="flex flex-wrap gap-2 mb-8">
                <button @click="filter('')" :class="activeCategory === '' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                    class="px-4 py-1.5 rounded-full text-sm font-semibold transition">Semua</button>
                <template x-for="cat in categories" :key="cat.slug">
                    <button @click="filter(cat.slug)" :class="activeCategory === cat.slug ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
                        class="px-4 py-1.5 rounded-full text-sm font-semibold transition">
                        <span x-text="cat.name"></span>
                    </button>
                </template>
            </div>

            {{-- Loading --}}
            <div x-show="loading" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <template x-for="i in 4" :key="i">
                    <div class="animate-pulse bg-slate-100 dark:bg-white/5 rounded-3xl h-72"></div>
                </template>
            </div>

            {{-- Empty --}}
            <div x-show="!loading && posts.length === 0" class="text-center py-14 text-slate-500">
                <i class="fa-regular fa-folder-open text-4xl mb-3"></i>
                <p>Belum ada artikel yang dipublikasikan.</p>
            </div>

            {{-- Grid --}}
            <div x-show="!loading && posts.length > 0" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <template x-for="post in posts" :key="post.slug">
                    <a :href="post.url" class="group bg-slate-50 dark:bg-slate-800/50 rounded-3xl overflow-hidden border border-slate-200 dark:border-white/10 hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex flex-col">
                        <div class="relative overflow-hidden h-44 bg-slate-100 dark:bg-white/5">
                            <img :src="post.cover_image" :alt="post.title" x-show="post.cover_image" loading="lazy"
                                class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <div class="flex flex-wrap gap-1 mb-3">
                                <template x-for="c in post.categories" :key="c.slug">
                                    <span class="bg-primary-50 dark:bg-primary-500/10 text-primary-700 dark:text-primary-300 text-[10px] font-bold px-2 py-0.5 rounded-full" x-text="c.name"></span>
                                </template>
                            </div>
                            <h3 class="text-base font-bold mb-2 line-clamp-2 group-hover:text-primary transition-colors" x-text="post.title"></h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-3 flex-1" x-text="post.excerpt"></p>
                            <div class="flex justify-between items-center pt-3 mt-3 border-t border-slate-200/60 dark:border-white/10 text-xs text-slate-400 font-medium">
                                <span x-text="post.published_human"></span>
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-eye"></i> <span x-text="post.views"></span></span>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </section>