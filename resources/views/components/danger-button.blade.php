<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex h-11 items-center justify-center rounded-[10px] bg-danger px-5 text-[13.5px] font-bold text-white transition-colors hover:bg-danger/90 focus:outline-none focus-visible:ring-2 focus-visible:ring-danger focus-visible:ring-offset-2 disabled:opacity-50']) }}>
    {{ $slot }}
</button>
