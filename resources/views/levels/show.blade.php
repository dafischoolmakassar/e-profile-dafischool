<x-layout :title="$level->name . ' - ' . $setting->school_name" :description="$level->tagline" :showFooter="true">
    <main>
        <!-- Hero section -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="relative rounded-2xl overflow-hidden shadow-lg">
                @if ($level->image)
                    <img src="{{ $level->image }}" alt="{{ $level->name }}" fetchpriority="high"
                         class="w-full h-64 sm:h-96 object-cover">
                @else
                    <x-image-placeholder :label="$level->name" class="w-full h-64 sm:h-96" />
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end">
                    <div class="p-5 sm:p-8">
                        <span class="inline-block text-caption text-gold-300 font-bold uppercase tracking-[0.2em] mb-2">Jenjang Pendidikan</span>
                        <h1 class="font-display text-h3 sm:text-h2 text-white font-extrabold">{{ $level->name }}</h1>
                        <p class="text-body-sm sm:text-body text-gold-100 mt-1">{{ $level->tagline }}</p>
                    </div>
                </div>
                <div class="absolute inset-x-0 top-0 h-20 bg-gradient-to-b from-black/50 to-transparent pointer-events-none" aria-hidden="true"></div>

                <a href="{{ route('levels.index') }}"
                   class="group absolute top-4 left-4 sm:top-6 sm:left-6 inline-flex items-center gap-1.5 min-h-[44px] text-white font-semibold text-body-sm uppercase tracking-[0.08em] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gold-300 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                    <span class="absolute left-0 -bottom-1 h-px w-full bg-gold-400 origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300" aria-hidden="true"></span>
                </a>
            </div>
        </section>

        <!-- Sticky nav: lompat ke bagian + pindah jenjang, sejajar dalam satu baris — selalu bisa diakses tanpa scroll balik ke atas -->
        <div class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-slate-100 mt-6">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-2.5 flex flex-col sm:flex-row sm:items-center gap-2 sm:justify-between">
                <nav aria-label="Navigasi bagian jenjang" class="flex gap-1.5 overflow-x-auto sm:min-w-0">
                    <a href="#program" class="shrink-0 px-3 py-1.5 rounded-full text-body-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-primary-700 transition">Program</a>
                    <a href="#fasilitas-sekolah" class="shrink-0 px-3 py-1.5 rounded-full text-body-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-primary-700 transition">Fasilitas</a>
                    <a href="#fasilitas-kelas" class="shrink-0 px-3 py-1.5 rounded-full text-body-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-primary-700 transition">Kelas</a>
                    @if ($level->show_extracurriculars)
                        <a href="#ekstrakurikuler" class="shrink-0 px-3 py-1.5 rounded-full text-body-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-primary-700 transition">Ekskul</a>
                    @endif
                    <a href="#aktivitas-belajar" class="shrink-0 px-3 py-1.5 rounded-full text-body-sm font-medium text-slate-600 hover:bg-slate-100 hover:text-primary-700 transition">Aktivitas</a>
                </nav>
                <div class="shrink-0 overflow-x-auto">
                    <x-level-switcher :current="$level" :all="$allLevels" />
                </div>
            </div>
        </div>

        <!-- Program -->
        <section id="program" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 scroll-mt-20">
            <x-section-heading eyebrow="Kurikulum & Pendekatan" title="Program" />
            <div class="rounded-xl bg-white shadow-sm ring-1 ring-slate-900/5 p-5 sm:p-6">
                <div class="rich-text-content text-body text-slate-600 leading-relaxed">{!! $level->program !!}</div>
            </div>
        </section>

        <!-- Facilities -->
        <x-level-section eyebrow="Sarana & Prasarana" title="Fasilitas Jenjang" :items="$level->facilities"
                          empty-message="Fasilitas jenjang belum ditambahkan.">
            @foreach ($level->facilities as $facility)
                <x-image-card :item="$facility" />
            @endforeach
        </x-level-section>

        <!-- Class Facilities -->
        <x-level-section eyebrow="{{ $isInklusi ? 'Sarana Terapi' : ($isBoarding ? 'Sarana Boarding' : 'Sarana Belajar') }}" title="{{ $isInklusi ? 'Fasilitas Terapi' : ($isBoarding ? 'Fasilitas Boarding' : 'Fasilitas Kelas') }}" :items="$level->classStats"
                          empty-message="{{ $isInklusi ? 'Fasilitas terapi belum ditambahkan.' : ($isBoarding ? 'Fasilitas boarding belum ditambahkan.' : 'Fasilitas kelas belum ditambahkan.') }}">
            @foreach ($level->classStats as $stat)
                <x-image-card :item="$stat" />
            @endforeach
        </x-level-section>

        <!-- Extracurriculars -->
        @if ($level->show_extracurriculars)
            <x-level-section eyebrow="Minat & Bakat" title="Ekstrakurikuler" :items="$level->extracurriculars"
                              empty-message="Ekstrakurikuler belum ditambahkan.">
                @foreach ($level->extracurriculars as $extracurricular)
                    <x-image-card :item="$extracurricular" />
                @endforeach
            </x-level-section>
        @endif

        <!-- Activities -->
        <x-level-section eyebrow="{{ $isInklusi ? 'Kegiatan Terapi' : ($isBoarding ? 'Keseharian di Asrama' : 'Keseharian di Sekolah') }}" title="{{ $isInklusi ? 'Aktivitas Terapi' : ($isBoarding ? 'Aktivitas Boarding' : 'Aktivitas Belajar') }}" :items="$level->activities"
                          empty-message="{{ $isInklusi ? 'Aktivitas terapi belum ditambahkan.' : ($isBoarding ? 'Aktivitas boarding belum ditambahkan.' : 'Aktivitas belajar belum ditambahkan.') }}">
            @foreach ($level->activities as $activity)
                <x-activity-card :activity="$activity" />
            @endforeach
        </x-level-section>

        <!-- Testimonials (hanya unit SMAIT) -->
        @if ($isSmait && $level->testimonials->isNotEmpty())
            <section id="testimoni-alumni" class="mt-16 scroll-mt-20">
                <div class="border-y border-slate-100 py-16">
                    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                        <x-section-heading eyebrow="Kata Mereka" title="Testimoni Alumni" />
                        <div class="swiper testimonial-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($level->testimonials as $testimonial)
                                    <div class="swiper-slide h-full">
                                        <x-testimonial-card :testimonial="$testimonial" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="testimonial-swiper-pagination swiper-pagination !static mt-8"></div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Informasi Pendaftaran: panel tenang, konsisten dengan home -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 mb-16 sm:mb-24">
            <div class="rounded-2xl border border-primary-100 bg-primary-50 px-6 py-8 sm:px-12 sm:py-12 flex flex-col sm:flex-row sm:items-center gap-6 sm:gap-8">
                <div class="flex-1">
                    <p class="text-caption text-gold-600 font-bold uppercase tracking-[0.2em] mb-2">Informasi Pendaftaran</p>
                    <h2 class="font-display text-h3 sm:text-h2 font-bold text-primary-800">Tertarik bergabung di jenjang {{ $level->name }}?</h2>
                    <p class="text-body sm:text-lead text-slate-600 mt-3 max-w-xl">
                        Tim kami siap membantu menjelaskan program dan proses pendaftaran untuk jenjang {{ $level->name }}.
                    </p>
                </div>
                <div class="flex flex-col sm:items-stretch gap-3 shrink-0 sm:w-56">
                    <a href="{{ $level->whatsapp_url }}"
                       target="_blank" rel="noopener"
                       class="inline-flex items-center justify-center min-h-[44px] px-6 py-3 rounded-full bg-primary-800 hover:bg-primary-900 text-white font-semibold text-body-sm transition">
                        Daftar Sekarang &rarr;
                    </a>
                    <a href="{{ route('levels.index') }}"
                       class="inline-flex items-center justify-center min-h-[44px] px-6 py-3 rounded-full border border-primary-200 text-primary-700 hover:bg-white font-semibold text-body-sm transition">
                        Lihat Jenjang Lain
                    </a>
                </div>
            </div>
        </section>
    </main>
</x-layout>
