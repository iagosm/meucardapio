<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex h-11 items-center justify-center rounded-[10px] border-[1.5px] border-line-strong bg-white px-5 text-[13.5px] font-bold text-ink-body transition-colors hover:bg-panel focus:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
