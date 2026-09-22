@php
    $nomeLoja = config('app.name', 'Cardápio');
    $inicialLoja = mb_strtoupper(mb_substr($nomeLoja, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="theme-color" content="#2554C7">

        <title>{{ $nomeLoja }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full bg-canvas font-sans text-ink antialiased">
        <div class="flex min-h-screen flex-col">
            <header class="border-b border-line bg-white">
                <div class="mx-auto flex h-16 w-full max-w-5xl items-center justify-between gap-4 px-5 sm:px-6">
                    <div class="flex min-w-0 items-center gap-2.5">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-[9px] bg-brand text-sm font-extrabold text-white">{{ $inicialLoja }}</span>
                        <span class="truncate text-[14.5px] font-extrabold text-ink">{{ $nomeLoja }}</span>
                    </div>

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex h-10 shrink-0 items-center rounded-[10px] px-3.5 text-[13px] font-semibold text-ink-body transition-colors hover:bg-panel hover:text-ink">
                            Painel
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex h-10 shrink-0 items-center rounded-[10px] px-3.5 text-[13px] font-semibold text-ink-body transition-colors hover:bg-panel hover:text-ink">
                            Entrar
                        </a>
                    @endauth
                </div>
            </header>

            <main class="flex flex-1 items-center">
                <div class="mx-auto w-full max-w-5xl px-5 py-14 sm:px-6 sm:py-20">
                    <div class="flex max-w-xl flex-col gap-5">
                        <h1 class="text-[30px] font-extrabold leading-[1.15] text-ink sm:text-[40px]">
                            O cardápio digital da {{ $nomeLoja }}
                        </h1>

                        <p class="text-[15px] leading-relaxed text-ink-body">
                            Seus clientes veem o catálogo completo, com fotos e preços atualizados, direto do celular — sem instalar nada.
                        </p>

                        <div class="flex flex-col gap-2.5 sm:flex-row">
                            <a href="{{ url('/cardapio') }}" class="inline-flex h-12 items-center justify-center rounded-[10px] bg-brand px-6 text-sm font-bold text-white transition-colors hover:bg-brand-dark">
                                Ver o cardápio
                            </a>

                            @guest
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex h-12 items-center justify-center rounded-[10px] border-[1.5px] border-line-strong bg-white px-6 text-sm font-bold text-ink-body transition-colors hover:bg-panel">
                                        Criar minha loja
                                    </a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            </main>

            <footer class="border-t border-line bg-white">
                <div class="mx-auto w-full max-w-5xl px-5 py-5 sm:px-6">
                    <p class="text-xs text-ink-faint">© {{ date('Y') }} {{ $nomeLoja }}</p>
                </div>
            </footer>
        </div>
    </body>
</html>
