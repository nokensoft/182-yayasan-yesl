{{-- TENTANG --}}
    <section id="tentang" class="relative py-24 px-6 overflow-hidden bg-slate-50 dark:bg-slate-950">
        <div class="absolute inset-0 bg-grid-pattern pointer-events-none opacity-70"></div>
        <div class="max-w-7xl mx-auto relative z-10 grid md:grid-cols-2 gap-x-14 gap-y-10 items-start">
            
            {{-- Judul Besar Section --}}
            <div class="md:col-span-2 text-center max-w-3xl mx-auto mb-4">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300 rounded-full text-xs font-bold tracking-wide uppercase">Profil Organisasi</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-4">Tentang <span class="text-primary">YESL</span></h2>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed mt-4">Mengenal lebih dekat jati diri, makna nama dan logo, serta komitmen YESL dalam mendampingi masyarakat adat di Tanah Papua.</p>
            </div>

            {{-- KOLOM KIRI: LOGO & INFORMASI DETIL (Arti nama, Logo, Program Kerja) --}}
            <div class="space-y-6">

                @php
                    $programKerja = [
                        ['Pemetaan Partisipatif Wilayah Adat', 'Mendampingi komunitas memetakan ruang darat dan perairan sebagai dasar pengakuan serta tata kelola wilayah adat.'],
                        ['Penguatan Ekonomi Lokal Berkelanjutan', 'Mengembangkan potensi komoditas dan usaha komunitas yang adil tanpa merusak kelestarian alam.'],
                        ['Perhutanan Sosial & Konservasi Komunitas', 'Mendorong pengelolaan hutan desa serta pelibatan perempuan dan generasi muda dalam upaya konservasi.'],
                    ];
                @endphp

                {{-- Akordion Informasi Detil --}}
                <div x-data="{ open: 1 }" class="space-y-3">

                    {{-- Arti Nama YESL --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm overflow-hidden">
                        <button type="button" @click="open = (open === 1 ? null : 1)" class="w-full flex items-center gap-3 p-4 text-left hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <span class="w-11 h-11 bg-primary-50 dark:bg-primary-500/10 rounded-xl flex items-center justify-center text-primary shrink-0"><i class="fa-solid fa-seedling"></i></span>
                            <span class="font-bold flex-1">Arti Nama YESL</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 transition-transform duration-300" :class="open === 1 && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === 1" x-transition class="px-4 pb-4">
                            <div class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed space-y-3">
                                <p><strong>Ekologi</strong> mencerminkan interaksi harmonis antara makhluk hidup dengan sesamanya serta lingkungan sekitar. </p>
                                <p><strong>Sahul</strong> merujuk pada landas kontinen yang menghubungkan Papua dan Australia, melambangkan ruang geografis yang kaya.  </p>
                                <p><strong>Lestari</strong> menegaskan komitmen untuk menjaga segala kebaikan ini tetap bertahan, kekal, dan tidak berubah demi masa depan. </p>
                                <p>
                                    <img src="{{ asset('images/map-ekologi-sahul-lestari.png') }}" alt="Peta Ekologi Sahul" />
                                </p>
                            </div>
                        </div>
                    </div>


                    {{-- Filosofi Logo --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm overflow-hidden">
                        <button type="button" @click="open = (open === 2 ? null : 2)" class="w-full flex items-center gap-3 p-4 text-left hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <span class="w-11 h-11 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary shrink-0"><i class="fa-solid fa-shapes"></i></span>
                            <span class="font-bold flex-1">Filosofi Logo</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 transition-transform duration-300" :class="open === 2 && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === 2" x-cloak x-transition class="px-4 pb-4">
                            <div class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed space-y-3">
                                <p>
                                    <img src="{{ asset('images/logo-yesl.png') }}" />
                                </p>
                                <p><strong>Dasar Warna Putih:</strong> Mencerminkan kasih yang tulus dan saling membangun kepercayaan untuk bekerja sama dalam membangun tanah Papua.</p>
                                <p><strong>Warna Hijau:</strong> Memberikan makna keberlanjutan tanah dan Manusia Papua secara mandiri dan berkeadilan.</p>
                                <p><strong>Gambar Pulau Papua & Corak Daun:</strong> Menggambarkan tingginya keanekaragaman bentang alam serta keanekaragaman hayati dan keberagaman sosial budaya wilayah adat yang ada di Tanah Papua.</p>
                                <p><strong>Lingkaran yang Terputus:</strong> Mengartikan sejarah biogeografi pulau Papua yang terputus dari benua Australia, di mana dulunya merupakan satu kesatuan daratan yang disebut dengan Paparan Sahul.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Status Legalitas Organisasi --}}
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-white/10 shadow-sm overflow-hidden">
                        <button type="button" @click="open = (open === 3 ? null : 3)" class="w-full flex items-center gap-3 p-4 text-left hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <span class="w-11 h-11 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary shrink-0"><i class="fa-solid fa-scale-balanced"></i></span>
                            <span class="font-bold flex-1">Status Legalitas Organisasi</span>
                            <i class="fa-solid fa-chevron-down text-slate-400 transition-transform duration-300" :class="open === 2 && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === 3" x-cloak x-transition class="px-4 pb-4">
                            <div class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed overflow-x-auto">
                                <table class="w-full min-w-[400px] border-collapse">
                                    <tbody>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300 w-1/3">Nama</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400 font-bold">YAYASAN EKOLOGI SAHUL LESTARI</td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">Alamat Sekretariat</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400">Jln. Patimura Ujung, Kelurahan Pasar Sentral Distrik Mimika Baru Kabupaten Mimika Provinsi Papua Tengah</td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">No. Telepon</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400 space-y-0.5">
                                                <div>+62821-9977-8738 <span class="text-xs text-slate-400 dark:text-slate-500">(Kantor)</span></div>
                                                <div>+62 813-4093-2910 <span class="text-xs text-slate-400 dark:text-slate-500">(Direktur)</span></div>
                                                <div>+62 822-3868-2030 <span class="text-xs text-slate-400 dark:text-slate-500">(Sekretaris)</span></div>
                                            </td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">E-Mail</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400">ekologisahullestari@gmail.com</td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">No SIUP</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400">510/2743-DPMPTSP/UM/2020</td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">Nomor Induk Berusaha</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400">0246000940676</td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">Akta Notaris</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400">Nomor 03 Tanggal 11 Agustus 2020</td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">Akta Perubahan</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400">Nomor 79 Tanggal 22 Desember 2025</td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">Keputusan KEMENKUMHAM</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400">Nomor AHU-0013911.AH.01.04. Tahun 2020</td>
                                        </tr>
                                        <tr class="align-top">
                                            <td class="py-1.5 pr-4 font-semibold text-slate-700 dark:text-slate-300">Nomor Pajak</td>
                                            <td class="py-1.5 px-2 text-slate-400">:</td>
                                            <td class="py-1.5 text-slate-600 dark:text-slate-400">97.796.482.8.953.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- KOLOM KANAN: DESKRIPSI YAYASAN --}}
            <div class="space-y-6 pt-2 md:pt-6">
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify">
                    <strong>Yayasan Ekologi Sahul Lestari (YESL)</strong> merupakan organisasi nirlaba yang hadir di Tanah Papua sejak tahun 2019 dan berkedudukan di Kabupaten Mimika Provinsi Papua Tengah. Memiliki misi melindungi kedaulatan masyarakat adat dalam pengelolaan daratan dan perairan sebagai identitas jati diri dan sumber penghidupan secara berkelanjutan.
                </p>
                    
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify">
                    Sejan terbentuk, Yayasan Ekologi Sahul Lestari telah bekerja sama dengan komunitas dan kelembagaan adat di wilayah Tanah Papua sebagai pemberi mandat dalam pendokumentasian bersama Profil Masyarakat Adat, baik sejarah, wilayah pengelolaan sumber daya alam dalam konteks Sumber penghidupan sehari-hari maupun sebagai identitas jati diri. Pendokumentian bersama terkait struktur dan kelembagaan adat, hukum adat, harta kekayaan adat, dan keanekaragaman hayati yang penting bagi pelestarian nilai budaya setempat. 
                </p>

                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify">
                    Hasil pendukumentasian Profil Masyarakat Adat ini kemudian diadvokasi menjadi arahan kebijakan regulasi, perencanaan dan program kegiatan bersama Masyarakat adat sebagai pemegang mandat dengan Dukungan kolaborasi mitra pembangunan baik pemerintah pusat dan daerah, mitra donor, mitra cso dan sektor swasta.
                </p>
                    
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed text-justify">
                    Kami memberikan solusi inovatif untuk mewujudkan pembangunan berkelanjutan melalui tata kelola sumber daya alam yang efektif berbasis kearifan lokal, mengutamakan pendekatan kesetaraan gender, serta membangun kolaborasi bersama semua pihak demi masa depan yang lestari.
                </p>
            </div>

            {{-- Tombol aksi ke Visi & Misi dan Nilai Inti --}}
            <div class="md:col-span-2 flex flex-wrap justify-center gap-3 pt-6 w-full">
                <a href="#struktur" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-primary text-white font-semibold hover:bg-primary-700 transition shadow-md shadow-primary/20">
                    <i class="fa-solid fa-bullseye"></i> Visi & Misi
                </a>
                <a href="#nilai" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-white/10 font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                    <i class="fa-solid fa-leaf text-primary"></i> Nilai Inti
                </a>
            </div>
        </div>
    </section>