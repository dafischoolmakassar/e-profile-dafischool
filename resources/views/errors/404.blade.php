@php
    $previousUrl = url()->previous();
    $backUrl = $previousUrl !== url()->current() ? $previousUrl : route('home');
    $setting = \App\Models\SchoolSetting::current();
@endphp

<x-layout :title="'Halaman Tidak Ditemukan - ' . ($setting->school_name ?? 'Darul Fikri')" description="Halaman yang Anda cari tidak ditemukan.">
    <main class="max-w-xl mx-auto px-4 py-24 text-center">
        <div class="w-20 h-20 rounded-full bg-primary-50 flex items-center justify-center mx-auto mb-5 text-primary-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.5 4.5a7.5 7.5 0 0012.15 12.15z" />
            </svg>
        </div>
        <h1 class="font-display text-2xl font-bold text-primary-800 mb-2">Halaman Tidak Ditemukan</h1>
        <p class="text-slate-500 mb-8">
            Maaf, halaman yang Anda cari tidak tersedia.
        </p>
        <a href="{{ $backUrl }}"
           class="inline-flex items-center justify-center min-h-[44px] px-6 py-3 rounded-full bg-primary-700 hover:bg-primary-800 text-white font-semibold shadow-md transition">
            &larr; Kembali ke Halaman Sebelumnya
        </a>
    </main>
</x-layout>
