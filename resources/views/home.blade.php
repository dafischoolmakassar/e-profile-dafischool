<x-layout :title="$setting->school_name . ' - Sekolah Islam Terpadu'" :useSwiper="true" :showBackToTop="false">
    <main class="relative">
        <h1 class="sr-only">{{ $setting->school_name }} - Sekolah Islam Terpadu</h1>

        <!-- Masthead toolbar: full-width gradient scrim (bukan pill kaca terapung), wordmark + text-link -->
        <div class="fixed inset-x-0 top-0 z-40 pointer-events-none bg-gradient-to-b from-black/50 via-black/15 to-transparent">
            <div class="flex items-center justify-between gap-3 px-4 sm:px-6 lg:px-8 pt-[max(0.75rem,env(safe-area-inset-top))] pb-4 sm:pt-6 sm:pb-6">
                <div class="pointer-events-auto flex items-center gap-2.5 sm:gap-3 min-w-0 animate-hero-fade-in">
                    @if ($setting->logo)
                        <img id="hero-logo" src="{{ $setting->logo }}" alt="Logo {{ $setting->school_name }}"
                             class="w-7 h-7 sm:w-9 sm:h-9 object-contain shrink-0 drop-shadow">
                        <span class="hidden sm:block w-px h-5 bg-white/25 shrink-0" aria-hidden="true"></span>
                    @endif
                    <span class="text-white font-display font-semibold text-caption sm:text-body-sm leading-none truncate min-w-0 uppercase tracking-[0.08em] drop-shadow-sm">{{ $setting->school_name }}</span>
                </div>

                <a href="{{ route('levels.index') }}"
                   class="pointer-events-auto group relative inline-flex items-center gap-1.5 shrink-0 min-h-[44px] text-white font-semibold text-caption sm:text-body-sm uppercase tracking-[0.08em] whitespace-nowrap transition animate-hero-fade-in">
                    Lihat Jenjang
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0 text-gold-300 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="absolute left-0 -bottom-1 h-px w-full bg-gold-400 origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300" aria-hidden="true"></span>
                </a>
            </div>
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
