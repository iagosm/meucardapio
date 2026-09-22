@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'h-11 rounded-[10px] border-[1.5px] border-line-strong bg-white px-3.5 text-[13.5px] text-ink shadow-none placeholder:text-ink-faint focus:border-brand focus:ring-2 focus:ring-brand/20 disabled:bg-panel disabled:text-ink-faint']) }}>
