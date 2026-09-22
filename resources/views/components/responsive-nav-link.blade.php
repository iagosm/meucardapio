@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex h-11 w-full items-center rounded-[10px] bg-brand-soft px-3.5 text-sm font-semibold text-brand transition-colors'
    : 'flex h-11 w-full items-center rounded-[10px] px-3.5 text-sm font-semibold text-ink-body transition-colors hover:bg-panel hover:text-ink';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
