<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Cardápio') }} — Cardápio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-cardapio antialiased bg-[#FAFBFC]" x-data="{
        categoriaAtiva: {{ $categorias->first()?->id ?? 'null' }},
        mostrarInfo: false,
        cart: [],
        get totalCarrinho() {
            return this.cart.reduce((total, item) => total + item.preco, 0);
        },
    }">

    <div class="relative h-[120px] md:h-[200px] bg-brand overflow-hidden">
        @if ($bannerLoja ?? null)
            <img src="{{ asset('storage/'.$bannerLoja) }}" alt="Banner da loja" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-[#101828]/0 to-[#101828]/45"></div>
        @endif

        <div class="max-w-5xl mx-auto h-full relative px-6">
            <div class="absolute top-3.5 right-6 h-7 px-3 rounded-full bg-white/95 flex items-center gap-1.5">
                @if ($lojaAberta ?? true)
                    <span class="w-[7px] h-[7px] rounded-full bg-[#12B76A] shrink-0"></span>
                    <span class="text-[11.5px] md:text-xs font-bold text-[#101828]">Aberto agora</span>
                @else
                    <span class="w-[7px] h-[7px] rounded-full bg-[#F04438] shrink-0"></span>
                    <span class="text-[11.5px] md:text-xs font-bold text-[#101828]">Fechado</span>
                @endif
            </div>

            <div class="absolute left-0 -bottom-7 md:-bottom-8 w-16 h-16 md:w-[72px] md:h-[72px] rounded-2xl bg-white border-[3px] border-white box-border flex items-center justify-center">
                <span class="text-[22px] md:text-[26px] font-extrabold text-brand">{{ mb_strtoupper(mb_substr(config('app.name', 'Cardápio'), 0, 1)) }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-6 pt-[38px] md:pt-11 pb-28 md:flex md:items-start md:gap-10">

        <div class="flex flex-col gap-3.5 md:w-[220px] md:shrink-0 md:gap-[18px]">
            <div class="flex flex-col gap-1">
                <div class="flex items-center gap-1.5">
                    <h1 class="text-[21px] md:text-2xl font-extrabold text-[#101828] leading-[1.15]">{{ config('app.name', 'Cardápio') }}</h1>
                    <button
                        type="button"
                        @click="mostrarInfo = !mostrarInfo"
                        aria-label="Informações da loja"
                        class="w-5 h-5 md:w-[22px] md:h-[22px] rounded-full bg-[#F2F4F7] border-0 shrink-0 flex items-center justify-center"
                    >
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#667085" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="11"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                    </button>
                </div>
                <p class="text-[12.5px] text-[#667085]">Fecha às {{ $fechaAs ?? '23h' }} · {{ $bairroLoja ?? 'Cardápio digital' }}</p>
            </div>

            <div x-show="mostrarInfo" x-cloak class="bg-white border border-[#EEF1F5] rounded-2xl p-4 flex flex-col gap-2.5">
                <div class="flex flex-col gap-0.5">
                    <span class="text-[11px] font-bold text-[#8A93A3] tracking-[0.04em]">ENDEREÇO</span>
                    <span class="text-[13px] text-[#101828]">{{ $enderecoLoja ?? 'Rua das Palmeiras, 120 — Itapuã' }}</span>
                </div>
                <div class="flex flex-col gap-0.5">
                    <span class="text-[11px] font-bold text-[#8A93A3] tracking-[0.04em]">TELEFONE</span>
                    <span class="text-[13px] text-[#101828]">{{ $telefoneLoja ?? '(11) 91234-5678' }}</span>
                </div>
                <div class="flex flex-col gap-0.5">
                    <span class="text-[11px] font-bold text-[#8A93A3] tracking-[0.04em]">FORMAS DE PAGAMENTO</span>
                    <span class="text-[13px] text-[#101828]">{{ $formasPagamento ?? 'Dinheiro, Pix, cartão de crédito e débito' }}</span>
                </div>
            </div>

            <nav aria-label="Categorias" class="flex gap-2 overflow-x-auto pb-0.5 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden md:flex-col md:gap-1.5 md:overflow-visible">
                @foreach ($categorias as $categoria)
                    <button
                        type="button"
                        @click="categoriaAtiva = {{ $categoria->id }}"
                        :class="categoriaAtiva === {{ $categoria->id }} ? 'bg-brand text-white border-brand' : 'bg-white text-[#475467] border-[#E4E7EC]'"
                        class="shrink-0 h-[34px] md:h-[38px] px-4 rounded-full md:rounded-[10px] md:text-left border-[1.5px] text-[13px] font-semibold whitespace-nowrap"
                    >
                        {{ $categoria->nome }}
                    </button>
                @endforeach
            </nav>
        </div>

        <div class="mt-1 md:mt-0 md:flex-1">
            @foreach ($categorias as $categoria)
                @php $produtos = $categoria->produtos->where('disponivel', true); @endphp
                <div x-show="categoriaAtiva === {{ $categoria->id }}" x-cloak>
                    @if ($produtos->isEmpty())
                        <p class="text-[13px] text-[#8A93A3] py-6">Nenhum produto disponível nesta categoria.</p>
                    @else
                        <div class="flex flex-col divide-y divide-[#EEF1F5] md:hidden">
                            @foreach ($produtos as $produto)
                                @include('cardapio.partials.produto-linha', ['produto' => $produto])
                            @endforeach
                        </div>

                        <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-[18px] md:content-start">
                            @foreach ($produtos as $produto)
                                @include('cardapio.partials.produto-cartao', ['produto' => $produto])
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

    </div>

    <div
        x-show="cart.length > 0"
        x-cloak
        class="fixed left-5 right-5 bottom-5 h-[58px] rounded-2xl bg-brand flex items-center justify-between px-5 box-border md:left-1/2 md:right-auto md:-translate-x-1/2 md:w-[420px]"
    >
        <span
            class="text-white text-[13.5px] font-bold"
            x-text="`${cart.length} ${cart.length === 1 ? 'item' : 'itens'} · R$ ${totalCarrinho.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`"
        ></span>
        <button type="button" class="h-[38px] px-[18px] rounded-[10px] bg-white border-0 text-brand text-[13.5px] font-bold">Ver carrinho</button>
    </div>

</body>
</html>
