@php $inicial = mb_strtoupper(mb_substr($produto->nome, 0, 1)); @endphp

{{-- Cartão em linha (texto à esquerda, miniatura à direita) em todas as larguras: o nome
     e o preço ficam sempre na mesma coluna, o que torna a varredura da lista mais rápida.
     h-full + mt-auto mantêm os preços alinhados na base quando a grade tem 2 ou 3 colunas. --}}
<article class="flex h-full w-full gap-3 rounded-2xl border border-line bg-white p-3.5 transition-colors hover:border-brand/30 sm:gap-3.5 sm:p-4">
    <div class="flex min-w-0 flex-1 flex-col">
        @if ($produto->destaque)
            <span class="mb-1.5 inline-flex h-5 w-fit items-center rounded-full bg-brand-soft px-2 text-[10px] font-bold tracking-[0.04em] text-brand">
                MAIS PEDIDO
            </span>
        @endif

        <h3 class="text-[14.5px] font-bold leading-snug text-ink">{{ $produto->nome }}</h3>

        @if ($produto->descricao)
            <p class="mt-1 line-clamp-2 text-[12.5px] leading-relaxed text-ink-faint">{{ $produto->descricao }}</p>
        @endif

        <p class="mt-auto pt-2.5 text-[15px] font-extrabold text-ink">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
    </div>

    <div class="relative shrink-0 self-start">
        <div class="h-[88px] w-[88px] overflow-hidden rounded-xl bg-brand-soft sm:h-24 sm:w-24">
            @if ($produto->imagem)
                <img src="{{ asset('storage/'.$produto->imagem) }}" alt="{{ $produto->nome }}" class="h-full w-full object-cover" loading="lazy">
            @else
                <div class="flex h-full w-full items-center justify-center text-2xl font-extrabold text-brand">{{ $inicial }}</div>
            @endif
        </div>

        {{-- Botão sobre o canto da miniatura: fica no mesmo lugar em todo cartão e mostra
             a quantidade já adicionada, confirmando a ação sem tirar o cliente da lista. --}}
        <button
            type="button"
            @click="adicionar({{ $produto->id }}, {{ $produto->preco }})"
            aria-label="Adicionar {{ $produto->nome }} ao carrinho"
            class="absolute -bottom-2 -right-2 flex h-10 w-10 items-center justify-center rounded-full border-2 border-white bg-brand text-white shadow-sm transition-colors hover:bg-brand-dark"
        >
            <svg x-show="quantidade({{ $produto->id }}) === 0" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" aria-hidden="true">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span x-show="quantidade({{ $produto->id }}) > 0" x-cloak class="text-[13px] font-extrabold" x-text="quantidade({{ $produto->id }})"></span>
        </button>
    </div>
</article>
