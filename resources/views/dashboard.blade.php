<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-0.5">
            <h1 class="text-[17px] font-extrabold text-ink">Visão geral</h1>
            <p class="text-xs text-ink-muted">{{ now()->format('d/m/Y') }}</p>
        </div>
    </x-slot>

    <div class="mx-auto w-full max-w-7xl px-5 py-6 sm:px-6 lg:px-8">
        <div class="rounded-2xl border border-line bg-white p-5 sm:p-6">
            <h2 class="text-[15px] font-bold text-ink">Você está conectado</h2>
            <p class="mt-1.5 text-[13px] leading-relaxed text-ink-body">
                Gerencie o catálogo da sua loja por aqui. O cardápio público já está disponível para os seus clientes.
            </p>

            <a href="{{ url('/cardapio') }}" class="mt-4 inline-flex h-11 items-center justify-center rounded-[10px] bg-brand px-5 text-[13.5px] font-bold text-white transition-colors hover:bg-brand-dark">
                Ver cardápio público
            </a>
        </div>
    </div>
</x-app-layout>
