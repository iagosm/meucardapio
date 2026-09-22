@php $inicial = mb_strtoupper(mb_substr($produto->nome, 0, 1)); @endphp

<div class="bg-white border border-[#EEF1F5] rounded-2xl p-4 flex flex-col gap-2.5">
    <div class="w-full h-[120px] rounded-xl bg-brand flex items-center justify-center overflow-hidden">
        @if ($produto->imagem)
            <img src="{{ asset('storage/'.$produto->imagem) }}" alt="{{ $produto->nome }}" class="w-full h-full object-cover">
        @else
            <span class="text-2xl font-extrabold text-white">{{ $inicial }}</span>
        @endif
    </div>

    @if ($produto->destaque)
        <span class="text-[10.5px] font-bold text-brand tracking-[0.04em]">MAIS PEDIDO</span>
    @endif

    <span class="text-[14.5px] font-bold text-[#101828]">{{ $produto->nome }}</span>

    @if ($produto->descricao)
        <span class="text-xs text-[#8A93A3] truncate">{{ $produto->descricao }}</span>
    @endif

    <div class="flex items-center justify-between mt-1">
        <span class="text-sm font-bold text-[#101828]">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
        <button
            type="button"
            @click="cart.push({ id: {{ $produto->id }}, preco: {{ $produto->preco }} })"
            aria-label="Adicionar {{ $produto->nome }} ao carrinho"
            class="w-7 h-7 rounded-full bg-transparent border-[1.5px] border-brand flex items-center justify-center"
        >
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-brand" stroke-width="3" stroke-linecap="round" aria-hidden="true">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </button>
    </div>
</div>
