@php $inicial = mb_strtoupper(mb_substr($produto->nome, 0, 1)); @endphp

<div class="flex items-center gap-3.5 py-4">
    <div class="w-[52px] h-[52px] rounded-xl bg-brand shrink-0 flex items-center justify-center overflow-hidden">
        @if ($produto->imagem)
            <img src="{{ asset('storage/'.$produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-full object-cover">
        @else
            <span class="text-lg font-extrabold text-white">{{ $inicial }}</span>
        @endif
    </div>

    <div class="flex-1 min-w-0 flex flex-col gap-1">
        @if ($produto->destaque)
            <span class="text-[10.5px] font-bold text-brand tracking-[0.04em]">MAIS PEDIDO</span>
        @endif
        <span class="text-[15px] font-bold text-[#101828]">{{ $produto->nome }}</span>
        @if ($produto->descricao)
            <span class="text-[12.5px] text-[#8A93A3] truncate">{{ $produto->descricao }}</span>
        @endif
    </div>

    <div class="flex flex-col items-end gap-[9px] shrink-0">
        <span class="text-[14.5px] font-bold text-[#101828]">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
        <button
            type="button"
            @click="cart.push({ id: {{ $produto->id }}, preco: {{ $produto->preco }} })"
            aria-label="Adicionar {{ $produto->nome }} ao carrinho"
            class="w-[27px] h-[27px] rounded-full bg-transparent border-[1.5px] border-brand flex items-center justify-center"
        >
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-brand" stroke-width="3" stroke-linecap="round" aria-hidden="true">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </button>
    </div>
</div>
