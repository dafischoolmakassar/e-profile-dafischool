<x-layout :title="'Pilihan Jenjang - ' . $setting->school_name" :description="'Pilih jenjang pendidikan di Sekolah Islam ' . $setting->school_name . ': RTK, TK, SD, SMP, dan SMA.'" :showFooter="true">
    <main>
        <div class="relative bg-primary-900">
            <a href="{{ route('home') }}"
               class="group absolute top-4 left-4 sm:top-6 sm:left-6 z-10 inline-flex items-center gap-1.5 min-h-[44px] text-white font-semibold text-body-sm uppercase tracking-[0.08em] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gold-300 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
                <span class="absolute left-0 -bottom-1 h-px w-full bg-gold-400 origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300" aria-hidden="true"></span>
            </a>

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-center">
                <span class="inline-flex items-center gap-2 text-gold-300 text-caption font-bold uppercase tracking-[0.2em] mb-3">
                    <span class="w-6 h-px bg-gold-400"></span> {{ $setting->school_name }} <span class="w-6 h-px bg-gold-400"></span>
                </span>
                <h1 class="font-display text-h3 sm:text-h2 font-extrabold text-white">Pilihan Jenjang Pendidikan</h1>
                <p class="text-body sm:text-lead text-primary-100 mt-3 max-w-xl mx-auto">
                    {{ $setting->school_name }} menyediakan jenjang pendidikan lengkap mulai dari usia dini hingga
                    menengah atas, dengan kurikulum yang menyatukan akademik dan nilai-nilai Islami.
                </p>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 sm:-mt-10 pb-16 sm:pb-24">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
                @foreach ($levels as $level)
                    <x-level-card :level="$level" />
                @endforeach
            </div>
        </div>
    </main>
</x-layout>
