{{-- DAMPAK KAMI — 5 box mengambang di antara Hero & Kabar Terbaru --}}
    <section aria-labelledby="dampak-heading" class="relative z-20 px-6 py-1 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto -mt-20 md:-mt-28">
            <div class="text-center mb-8">
                <span id="dampak-heading" class="inline-block px-4 py-1.5 bg-primary text-white rounded-full text-xs font-bold tracking-wide uppercase shadow-lg shadow-primary/30">Dampak Kami Hingga 2024</span>
            </div>

            @php
                $dampak = [
                    ['fa-map-location-dot', '114.941', 'Ha', 'Wilayah Dampingan'],
                    ['fa-hand-holding-heart', '3.843', null, 'Penerima Manfaat'],
                    ['fa-people-group', '9', null, 'Komunitas Adat'],
                    ['fa-handshake-angle', '5', null, 'Donor Strategis'],
                    ['fa-calendar-check', '5', null, 'Tahun Pengalaman'],
                ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach ($dampak as [$icon, $value, $unit, $label])
                    <div class="group bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-white/10 shadow-xl shadow-slate-900/5 p-6 text-center hover:-translate-y-1 hover:shadow-2xl transition-all duration-300 {{ $loop->last ? 'col-span-2 sm:col-span-1' : '' }}">
                        <div class="w-12 h-12 mx-auto rounded-2xl flex items-center justify-center text-xl mb-4 shadow-inner {{ $loop->even ? 'bg-secondary/10 text-secondary' : 'bg-primary/10 text-primary' }}">
                            <i class="fa-solid {{ $icon }}"></i>
                        </div>
                        <div class="text-3xl md:text-4xl font-extrabold text-slate-800 dark:text-white leading-none">
                            {{ $value }}@if ($unit)<span class="text-lg md:text-xl text-primary font-bold ml-1">{{ $unit }}</span>@endif
                        </div>
                        <p class="mt-2 text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $label }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>