@php
    $nomeLoja = config('app.name', 'Cardápio');
    $inicialLoja = mb_strtoupper(mb_substr($nomeLoja, 0, 1));
@endphp

<nav x-data="{ open: false }" class="border-b border-line bg-white">
    <div class="mx-auto w-full max-w-7xl px-5 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            <div class="flex min-w-0 items-center gap-6">
                <a href="{{ route('dashboard') }}" class="flex min-w-0 items-center gap-2.5">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-[9px] bg-brand text-sm font-extrabold text-white">{{ $inicialLoja }}</span>
                    <span class="truncate text-[14.5px] font-extrabold text-ink">{{ $nomeLoja }}</span>
                </a>

                <div class="hidden items-center gap-1 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Visão geral
                    </x-nav-link>
                    <x-nav-link :href="url('/cardapio')" :active="request()->is('cardapio')">
                        Cardápio
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden shrink-0 items-center sm:flex">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button" class="inline-flex h-10 items-center gap-1.5 rounded-[10px] px-3 text-[13px] font-semibold text-ink-body transition-colors hover:bg-panel hover:text-ink focus:outline-none">
                            <span class="max-w-[10rem] truncate">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 shrink-0 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Meu perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <button
                type="button"
                @click="open = ! open"
                :aria-expanded="open"
                aria-controls="menu-mobile"
                aria-label="Abrir menu"
                class="-mr-2 flex h-11 w-11 shrink-0 items-center justify-center rounded-[10px] text-ink-muted transition-colors hover:bg-panel hover:text-ink sm:hidden"
            >
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                    <path x-show="! open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div id="menu-mobile" x-show="open" x-cloak class="border-t border-line sm:hidden">
        <div class="space-y-1 px-5 py-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Visão geral
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/cardapio')" :active="request()->is('cardapio')">
                Cardápio
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-line px-5 py-3">
            <div class="px-3.5 pb-2">
                <p class="truncate text-sm font-bold text-ink">{{ Auth::user()->name }}</p>
                <p class="truncate text-xs text-ink-muted">{{ Auth::user()->email }}</p>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Meu perfil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Sair
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
