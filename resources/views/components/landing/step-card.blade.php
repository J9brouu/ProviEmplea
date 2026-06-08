@props([
    'icon',
    'title',
    'description',
    'background' => 'bg-primary-container',
    'iconColor' => 'text-on-primary-container',
])

<div class="glass-card p-8 rounded-2xl flex flex-col items-start gap-4 hover:shadow-lg transition-all border border-outline-variant">
    <div class="w-12 h-12 rounded-lg {{ $background }} flex items-center justify-center">
        <span class="material-symbols-outlined {{ $iconColor }}" style="font-variation-settings: 'FILL' 1;">{{ $icon }}</span>
    </div>
    <h3 class="font-title-lg text-title-lg text-on-surface">{{ $title }}</h3>
    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $description }}</p>
</div>
