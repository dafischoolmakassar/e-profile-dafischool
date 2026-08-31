<x-layout :title="$setting->school_name . ' - Sekolah Islam Terpadu'" :useSwiper="true" :showBackToTop="false">
    <main class="relative">
        <h1 class="sr-only">{{ $setting->school_name }} - Sekolah Islam Terpadu</h1>

        <!-- Unified elegant top bar: mobile gutter 16px (container-like), desktop tetap full-bleed -->
        <div class="fixed inset-x-0 top-0 z-40 flex items-center justify-between gap-2 sm:gap-3 px-4 sm:px-6 pt-[max(0.75rem,env(safe-area-inset-top))] sm:pt-6 pointer-events-none">
            <div class="pointer-events-auto inline-flex items-center gap-2 sm:gap-2.5 rounded-full bg-black/30 backdrop-blur-md border border-white/20 pl-1.5 sm:pl-2 pr-3 sm:pr-4 py-1.5 sm:py-2 shadow-md animate-hero-fade-in min-w-0 flex-1 max-w-[calc(100vw-32px-150px)] sm:max-w-[320px] sm:flex-none">
                @if ($setting->logo)
                    <img id="hero-logo" src="{{ $setting->logo }}" alt="Logo {{ $setting->school_name }}"
                         class="w-7 h-7 sm:w-8 sm:h-8 rounded-full object-cover bg-white shadow-sm shrink-0">
                @endif
                <span class="text-white font-display font-semibold text-[12.5px] sm:text-[15px] leading-none truncate min-w-0 uppercase tracking-[0.04em]">{{ $setting->school_name }}</span>
            </div>

            <a href="{{ route('levels.index') }}" id="hero-next-btn"
               class="pointer-events-auto inline-flex items-center justify-center gap-1.5 sm:gap-2 shrink-0 min-h-[36px] sm:min-h-[42px] pl-3.5 pr-3 sm:pl-5 sm:pr-4 py-2 rounded-full bg-black/30 backdrop-blur-md border border-white/20 text-white hover:bg-black/45 shadow-md active:scale-[0.97] font-semibold text-[13px] sm:text-sm whitespace-nowrap transition animate-hero-fade-in uppercase tracking-[0.04em]">
                Lihat Jenjang
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-[18px] sm:h-[18px] shrink-0 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="swiper hero-swiper h-screen w-full">
            <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                    <div class="swiper-slide relative bg-slate-900">
                        @if ($slide->image)
                            <picture class="block w-full h-full">
                                @if ($slide->mobile_image)
                                    <source media="(max-width: 767px)" srcset="{{ $slide->mobile_image }}">
                                @endif
                                <img src="{{ $slide->image }}" alt="{{ $slide->alt }}"
                                     @if ($loop->first) fetchpriority="high" @else loading="lazy" @endif
                                     class="relative w-full h-full object-cover">
                            </picture>
                        @else
                            <x-image-placeholder :label="$slide->alt" class="w-full h-full" />
                        @endif
                        <div class="absolute inset-0 bg-black/40"></div>

                        @if ($slide->alt)
                            <div class="hero-caption absolute bottom-0 left-0 z-30 p-4 sm:p-6 max-w-[calc(100vw-140px)] sm:max-w-xs">
                                <p class="text-white text-sm sm:text-base font-medium leading-snug drop-shadow-lg">
                                    {{ $slide->alt }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="swiper-pagination"></div>
        </div>

        @if ($setting->whatsapp_number)
            <a href="https://wa.me/{{ $setting->whatsapp_number }}" target="_blank" rel="noopener noreferrer"
               class="fixed bottom-5 right-3 sm:right-5 z-40 hidden sm:inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#25D366] hover:bg-[#1ebc59] text-white shadow-lg active:scale-90 transition"
               aria-label="Hubungi {{ $setting->school_name }} via WhatsApp">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12.001 2C6.478 2 2 6.477 2 12c0 1.876.51 3.632 1.397 5.14L2 22l4.98-1.375A9.953 9.953 0 0012.001 22C17.523 22 22 17.523 22 12S17.523 2 12.001 2zm0 18.222a8.19 8.19 0 01-4.176-1.145l-.3-.178-3.106.858.83-3.03-.196-.312A8.201 8.201 0 013.778 12c0-4.535 3.688-8.222 8.223-8.222 4.535 0 8.223 3.687 8.223 8.222 0 4.536-3.688 8.222-8.223 8.222z"/>
                </svg>
            </a>
        @endif
    </main>
</x-layout>
