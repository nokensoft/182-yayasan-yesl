{{-- TIM YSEL --}}
    <section id="tim" class="py-24 px-6 bg-slate-50 dark:bg-slate-950"
        x-data="{
            groups: [
                {
                    label: 'Pembina & Pengawas',
                    members: [
                        { name: 'Netty Bakkara', role: 'Pembina', photo: '{{ asset('images/team/netty.jpg') }}', linkedin: '', email: '' },
                        { name: 'Maryana J. E. Hamadi', role: 'Pengawas', photo: '{{ asset('images/team/maryana.jpg') }}', linkedin: '', email: '' },
                    ],
                },
                {
                    label: 'Staf',
                    members: [
                        { name: 'Rintho G. Maturbongs', role: 'Direktur', photo: '{{ asset('images/team/rintho.jpg') }}', linkedin: '', email: '' },
                        { name: 'Prasetyo', role: 'Manager Program', photo: '{{ asset('images/team/prasetyo.jpg') }}', linkedin: '', email: '' },
                        { name: 'Nadhiya Tamrin', role: 'Staf Keuangan', photo: '{{ asset('images/team/nadhiya.jpg') }}', linkedin: '', email: '' },
                        { name: 'Eka Januarita Kafiar', role: 'Fasilitator Lokal', photo: '{{ asset('images/team/januarita.jpg') }}', linkedin: '', email: '' },
                        { name: 'Selfi J. Demotekay', role: 'Junior Field Officer', photo: '{{ asset('images/team/selfi.jpg') }}', linkedin: '', email: '' },
                    ],
                },
            ],
            initials(name) {
                return name.split(' ').filter(Boolean).slice(0, 2).map(w => w[0]).join('').toUpperCase();
            }
        }">
        <div class="max-w-7xl mx-auto">
            <div class="max-w-3xl mx-auto text-center mb-14">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Tim Kami</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4 mb-4">Tim YSEL</h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Orang-orang di balik YESL yang berkomitmen mendampingi masyarakat adat dan menjaga kelestarian bentang alam di Tanah Papua.</p>
            </div>

            <template x-for="group in groups" :key="group.label">
                <div class="mb-14 last:mb-0">
                    {{-- Judul baris --}}
                    <div class="flex items-center justify-center gap-4 mb-8">
                        <span class="h-px w-8 bg-slate-300 dark:bg-white/15"></span>
                        <h3 class="text-sm font-bold uppercase tracking-widest text-primary" x-text="group.label"></h3>
                        <span class="h-px w-8 bg-slate-300 dark:bg-white/15"></span>
                    </div>

                    {{-- Kartu anggota (rata tengah) --}}
                    <div class="flex flex-wrap justify-center gap-6">
                        <template x-for="(m, i) in group.members" :key="m.name">
                            <div class="group w-full sm:w-56 bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-white/10 overflow-hidden text-center hover:-translate-y-1 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                                <div>
                                    <div class="relative aspect-square flex items-center justify-center"
                                        :class="(i % 2 === 0) ? 'bg-primary/10 text-primary' : 'bg-secondary/10 text-secondary'">
                                        <span class="text-4xl font-extrabold" x-text="initials(m.name)"></span>
                                        <img :src="m.photo" :alt="m.name" loading="lazy" x-on:error="$el.style.display = 'none'"
                                            class="absolute inset-0 w-full h-full object-cover">
                                    </div>
                                    <div class="p-5 pb-3">
                                        <h4 class="font-bold leading-snug group-hover:text-primary transition-colors" x-text="m.name"></h4>
                                        <p class="text-sm text-primary font-semibold mt-1" x-text="m.role"></p>
                                    </div>
                                </div>

                                {{-- Media Sosial (Bagian Bawah) --}}
                                <div class="flex justify-center gap-4 pb-5 pt-2 border-t border-slate-100 dark:border-white/5 mx-5">
                                    <!-- Linkedin -->
                                    <a :href="m.linkedin" target="_blank" rel="noopener noreferrer" 
                                    x-show="m.linkedin"
                                    class="text-slate-400 hover:text-[#0077b5] dark:hover:text-[#0077b5] transition-colors text-lg"
                                    title="LinkedIn">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                    
                                    <!-- Mail -->
                                    <a :href="'mailto:' + m.email" 
                                    x-show="m.email"
                                    class="text-slate-400 hover:text-primary transition-colors text-lg"
                                    title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </template>
                    </div>
                    
                </div>
            </template>
        </div>
    </section>