@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-[10px] bg-ok/10 px-3.5 py-2.5 text-xs font-medium leading-relaxed text-ok']) }}>
        {{ $status }}
    </div>
@endif
