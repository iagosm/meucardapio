@php
    $nomeLoja = config('app.name', 'Cardápio');
    $inicialLoja = mb_strtoupper(mb_substr($nomeLoja, 0, 1));
    $aberta = $lojaAberta ?? true;

    $textoBusca = fn ($produto) => $produto->nome.' '.($produto->descricao ?? '');
    $termosDaLoja = $categorias
        ->flatMap(fn ($categoria) => $categoria->produtos->where('disponivel', true)->map($textoBusca))
        ->values()
        ->all();
@endphp

<x-cardapio-layout
    :title="$nomeLoja.' — Cardápio'"
    x-data="{
        categoriaAtiva: null,
        mostrarInfo: false,
        busca: '',
        cart: [],

        /* Busca sem acento e sem caixa, para 'acai' encontrar 'Açaí'. */
        normalizar(texto) {
            return (texto ?? '').toString().toLowerCase().normalize('NFD').replace(/[̀-ͯ]/g, '').trim();
        },
        get termo() {
            return this.normalizar(this.busca);
        },
        combina(alvo) {
            return this.termo === '' || this.normalizar(alvo).includes(this.termo);
        },
        combinaAlguma(alvos) {
            return this.termo === '' || alvos.some((alvo) => this.normalizar(alvo).includes(this.termo));
        },

        quantidade(id) {
            return this.cart.filter((item) => item.id === id).length;
        },
        adicionar(id, preco) {
            this.cart.push({ id, preco });
        },
        get totalCarrinho() {
            return this.cart.reduce((total, item) => total + item.preco, 0);
        },
        get totalFormatado() {
            return this.totalCarrinho.toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },

        /* Enquanto a rolagem disparada por um clique na aba não termina, o
           scroll-spy fica suspenso para não sobrescrever a escolha do cliente. */
        travado: false,
        escolher(id) {
            this.categoriaAtiva = id;
            this.travado = true;
            clearTimeout(this.destravar);
            this.destravar = setTimeout(() => (this.travado = false), 900);
        },

        /* Destaca a aba da seção que está sob a barra e a traz para a área visível dela.
           O cálculo é direto (última seção cujo topo já passou da barra) porque o
           IntersectionObserver marcava a categoria seguinte antes da hora. */
        init() {
            const secoesVisiveis = () => Array.from(document.querySelectorAll('[data-categoria]'))
                .filter((secao) => secao.offsetParent !== null);

            this.categoriaAtiva = Number(secoesVisiveis()[0]?.dataset.categoria ?? 0) || null;

            const marcar = (secao) => {
                const id = Number(secao?.dataset.categoria);

                if (! id || id === this.categoriaAtiva) {
                    return;
                }

                this.categoriaAtiva = id;
                this.$refs.abas
                    ?.querySelector(`[data-aba='${id}']`)
                    ?.scrollIntoView({ inline: 'center', block: 'nearest', behavior: 'smooth' });
            };

            const acompanhar = () => {
                if (this.travado) {
                    return;
                }

                const secoes = secoesVisiveis();

                if (! secoes.length) {
                    return;
                }

                const linha = (this.$refs.abas?.offsetHeight ?? 0) + 8;

                /* No fim da página a última seção nunca alcança a barra. */
                if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 2) {
                    marcar(secoes[secoes.length - 1]);

                    return;
                }

                marcar(secoes.filter((secao) => secao.getBoundingClientRect().top <= linha).pop() ?? secoes[0]);
            };

            let agendado = false;
            window.addEventListener('scroll', () => {
                if (agendado) {
                    return;
                }

                agendado = true;
                requestAnimationFrame(() => {
                    agendado = false;
                    acompanhar();
                });
            }, { passive: true });

            acompanhar();
        },
    }"
>
    <header>
        {{-- Capa da loja. Sem banner ela vira apenas uma faixa da marca, para não
             gastar altura de tela com uma área vazia — sobretudo no celular. --}}
        <div class="relative overflow-hidden bg-brand {{ ($bannerLoja ?? null) ? 'h-32 sm:h-40 md:h-48' : 'h-20 sm:h-24' }}">
            @if ($bannerLoja ?? null)
                <img src="{{ asset('storage/'.$bannerLoja) }}" alt="" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-ink/40 to-transparent"></div>
            @endif
        </div>

        {{-- Cartão de identidade sobrepondo a capa: reúne logo, nome, status e local
             em um único bloco, para o cliente reconhecer a loja de imediato.
             `relative` é obrigatório: a capa acima é posicionada e, sem isso,
             pintaria por cima deste cartão. --}}
        <div class="relative z-10 mx-auto max-w-6xl px-4 sm:px-6">
            <div class="-mt-10 rounded-2xl border border-line bg-white p-4 shadow-sm sm:-mt-12 sm:p-5">
                <div class="flex items-start gap-3.5 sm:gap-4">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-brand sm:h-20 sm:w-20">
                        @if ($logoLoja ?? null)
                            <img src="{{ asset('storage/'.$logoLoja) }}" alt="{{ $nomeLoja }}" class="h-full w-full object-cover">
                        @else
                            <span class="text-[26px] font-extrabold text-white sm:text-3xl">{{ $inicialLoja }}</span>
                        @endif
                    </div>

                    <div class="flex min-w-0 flex-1 flex-col gap-1.5">
                        <h1 class="truncate text-lg font-extrabold leading-tight text-ink sm:text-[22px]">{{ $nomeLoja }}</h1>

                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1.5">
                            <span class="inline-flex h-6 items-center gap-1.5 rounded-full {{ $aberta ? 'bg-ok/10' : 'bg-danger/10' }} px-2.5">
                                <span class="h-[6px] w-[6px] shrink-0 rounded-full {{ $aberta ? 'bg-ok' : 'bg-danger' }}"></span>
                                <span class="text-[11.5px] font-bold {{ $aberta ? 'text-ok' : 'text-danger' }}">{{ $aberta ? 'Aberto agora' : 'Fechado' }}</span>
                            </span>
                            @if ($aberta)
                                <span class="text-[12.5px] text-ink-muted">Fecha às {{ $fechaAs ?? '23h' }}</span>
                            @endif
                        </div>

                        <p class="truncate text-[12.5px] text-ink-muted">{{ $bairroLoja ?? 'Cardápio digital' }}</p>
                    </div>

                    <button
                        type="button"
                        @click="mostrarInfo = ! mostrarInfo"
                        :aria-expanded="mostrarInfo"
                        aria-controls="info-loja"
                        class="-mr-1 -mt-1 flex h-10 w-10 shrink-0 items-center justify-center gap-1 rounded-[10px] text-[12.5px] font-bold text-brand transition-colors hover:bg-brand-soft sm:w-auto sm:px-2"
                    >
                        <span class="hidden sm:inline">Ver mais</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="11"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span class="sr-only">Informações da loja</span>
                    </button>
                </div>

                <div id="info-loja" x-show="mostrarInfo" x-cloak class="mt-4 grid gap-3 border-t border-line pt-4 sm:grid-cols-3">
                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10.5px] font-bold tracking-[0.04em] text-ink-faint">ENDEREÇO</span>
                        <span class="text-[12.5px] leading-relaxed text-ink">{{ $enderecoLoja ?? 'Endereço não informado' }}</span>
                    </div>
                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10.5px] font-bold tracking-[0.04em] text-ink-faint">TELEFONE</span>
                        <span class="text-[12.5px] leading-relaxed text-ink">{{ $telefoneLoja ?? 'Telefone não informado' }}</span>
                    </div>
                    <div class="flex flex-col gap-0.5">
                        <span class="text-[10.5px] font-bold tracking-[0.04em] text-ink-faint">FORMAS DE PAGAMENTO</span>
                        <span class="text-[12.5px] leading-relaxed text-ink">{{ $formasPagamento ?? 'Consulte a loja' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Loja fechada é informação crítica: as referências usam uma faixa de largura
         total logo no topo, para o cliente não montar um pedido sem perceber. --}}
    @unless ($aberta)
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <p class="mt-3 flex items-start gap-2 rounded-xl bg-danger/10 px-3.5 py-3 text-[12.5px] font-semibold leading-relaxed text-danger">
                <svg class="mt-px shrink-0" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 7 12 12 15.5 14"></polyline>
                </svg>
                <span>A loja está fechada agora. Você pode ver o cardápio, mas o pedido só poderá ser enviado quando ela reabrir.</span>
            </p>
        </div>
    @endunless

    <div class="mx-auto max-w-6xl px-4 sm:px-6">
        <div class="relative mt-4 sm:mt-5 sm:max-w-md">
            <svg class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-faint" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true">
                <circle cx="11" cy="11" r="7"></circle>
                <line x1="21" y1="21" x2="16.5" y2="16.5"></line>
            </svg>
            <label for="busca" class="sr-only">Buscar no cardápio</label>
            <input
                id="busca"
                type="search"
                x-model="busca"
                placeholder="Buscar no cardápio"
                autocomplete="off"
                class="h-11 w-full rounded-full border-[1.5px] border-line-strong bg-white pl-10 pr-4 text-[13.5px] text-ink shadow-none placeholder:text-ink-faint focus:border-brand focus:ring-2 focus:ring-brand/20"
            >
        </div>
    </div>

    {{-- Abas de categoria fixas no topo: rolam junto e apontam a seção em leitura,
         em vez de esconder as outras categorias. --}}
    <nav
        aria-label="Categorias"
        x-ref="abas"
        class="sticky top-0 z-30 mt-3 border-b border-line bg-canvas/95 backdrop-blur"
    >
        <div class="mx-auto max-w-6xl px-4 sm:px-6">
            <ul class="no-scrollbar flex gap-5 overflow-x-auto sm:gap-6">
                @foreach ($categorias as $categoria)
                    <li class="shrink-0">
                        <a
                            href="#categoria-{{ $categoria->id }}"
                            data-aba="{{ $categoria->id }}"
                            @click="escolher({{ $categoria->id }})"
                            :aria-current="categoriaAtiva === {{ $categoria->id }} ? 'true' : 'false'"
                            :class="categoriaAtiva === {{ $categoria->id }}
                                ? 'border-brand text-brand'
                                : 'border-transparent text-ink-muted hover:text-ink'"
                            class="flex h-12 items-center whitespace-nowrap border-b-2 text-[13.5px] font-bold transition-colors"
                        >
                            {{ $categoria->nome }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <main class="mx-auto max-w-6xl px-4 pb-32 sm:px-6 sm:pb-36">
        @foreach ($categorias as $categoria)
            @php
                $produtos = $categoria->produtos->where('disponivel', true);
                $termos = $produtos->map($textoBusca)->values()->all();
            @endphp

            <section
                id="categoria-{{ $categoria->id }}"
                data-categoria="{{ $categoria->id }}"
                aria-labelledby="titulo-categoria-{{ $categoria->id }}"
                x-show="combinaAlguma(@js($termos))"
                class="scroll-mt-14 pt-7 sm:pt-8"
            >
                <div class="flex items-baseline gap-2.5 pb-3">
                    <h2 id="titulo-categoria-{{ $categoria->id }}" class="text-[17px] font-extrabold text-ink sm:text-lg">{{ $categoria->nome }}</h2>
                    <span class="shrink-0 text-[11.5px] font-semibold text-ink-faint">
                        {{ $produtos->count() }} {{ $produtos->count() === 1 ? 'item' : 'itens' }}
                    </span>
                </div>

                @if ($produtos->isEmpty())
                    <p class="rounded-2xl border border-line bg-white px-4 py-6 text-center text-[13px] text-ink-faint">
                        Nenhum produto disponível nesta categoria.
                    </p>
                @else
                    <ul class="grid gap-2.5 sm:gap-3 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($produtos as $produto)
                            <li class="flex" x-show="combina(@js($textoBusca($produto)))">
                                @include('cardapio.partials.produto-cartao', ['produto' => $produto])
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        @endforeach

        <p x-show="termo !== '' && ! combinaAlguma(@js($termosDaLoja))" x-cloak class="pt-10 text-center text-[13px] text-ink-faint">
            Nenhum produto encontrado para <span class="font-semibold text-ink" x-text="`“${busca}”`"></span>.
        </p>
    </main>

    {{-- Barra de pedido fixa: confirma o que foi adicionado e dá o caminho para revisar. --}}
    <div
        x-show="cart.length > 0"
        x-cloak
        x-transition.opacity
        class="bottom-safe fixed inset-x-3 z-40 flex h-16 items-center justify-between gap-3 rounded-2xl bg-brand pl-4 pr-3 shadow-lg shadow-brand/25 sm:inset-x-auto sm:left-1/2 sm:w-[440px] sm:-translate-x-1/2"
    >
        <div class="flex min-w-0 items-center gap-2.5">
            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-white/20 text-[12.5px] font-extrabold text-white" x-text="cart.length"></span>
            <span class="flex min-w-0 flex-col">
                <span class="truncate text-[11px] font-semibold text-white/80" x-text="cart.length === 1 ? 'item no carrinho' : 'itens no carrinho'"></span>
                <span class="truncate text-[14.5px] font-extrabold text-white" x-text="`R$ ${totalFormatado}`"></span>
            </span>
        </div>

        <button type="button" class="h-10 shrink-0 rounded-[10px] bg-white px-4 text-[13.5px] font-bold text-brand transition-colors hover:bg-white/90">
            Ver carrinho
        </button>
    </div>
</x-cardapio-layout>
