@props(['eyebrow', 'title'])

<div class="mb-6 sm:mb-8">
    <p class="text-caption text-gold-600 font-bold uppercase tracking-[0.2em] mb-2">{{ $eyebrow }}</p>
    <div class="flex items-center gap-4">
        <h2 class="font-display text-h3 sm:text-h2 font-bold text-primary-800">{{ $title }}</h2>
        <span class="flex-1 h-px bg-primary-100"></span>
    </div>
</div>
