@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-xs font-semibold text-ink-body']) }}>
    {{ $value ?? $slot }}
</label>
