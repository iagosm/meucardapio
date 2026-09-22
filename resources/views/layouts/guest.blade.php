@php
    $nomeLoja = config('app.name', 'Cardápio');
    $inicialLoja = mb_strtoupper(mb_substr($nomeLoja, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="pt-BR" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#2554C7">

        <title>{{ $heading ? $heading.' — '.$nomeLoja : $nomeLoja }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full bg-panel font-sans text-ink antialiased">
        <div class="mx-auto flex min-h-screen w-full max-w-[380px] flex-col justify-center gap-6 px-5 py-10">
            <div class="flex flex-col items-center gap-2.5 text-center">
                <a href="{{ url('/') }}" class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand text-[19px] font-extrabold text-white">
                    {{ $inicialLoja }}
                </a>
                <h1 class="text-[17px] font-extrabold text-ink">{{ $heading ?? 'Painel do lojista' }}</h1>
                <p class="text-[12.5px] leading-relaxed text-ink-muted">{{ $subheading ?? 'Entre para gerenciar sua loja' }}</p>
            </div>

            <div class="rounded-2xl border border-line bg-white p-6 shadow-sm">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
