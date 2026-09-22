@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex h-10 items-center rounded-[10px] bg-brand-soft px-3.5 text-[13px] font-semibold text-brand transition-colors'
    : 'inline-flex h-10 items-center rounded-[10px] px-3.5 text-[13px] font-semibold text-ink-body transition-colors hover:bg-panel hover:text-ink';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
