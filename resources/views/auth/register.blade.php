<x-guest-layout heading="Criar conta" subheading="Cadastre sua loja para começar a vender">
    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-3.5">
        @csrf

        <div class="flex flex-col gap-1.5">
            <x-input-label for="name" value="Nome da loja" />
            <x-text-input id="name" class="w-full" type="text" name="name" :value="old('name')" placeholder="Hamburgueria Hut" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" placeholder="voce@loja.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="password" value="Senha" />
            <x-text-input id="password" class="w-full" type="password" name="password" placeholder="••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="password_confirmation" value="Confirmar senha" />
            <x-text-input id="password_confirmation" class="w-full" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <x-primary-button class="mt-1.5 w-full">Criar conta</x-primary-button>
    </form>

    <p class="mt-4 border-t border-line pt-4 text-center text-xs text-ink-muted">
        Já tem conta?
        <a href="{{ route('login') }}" class="font-semibold text-brand hover:underline">Entrar</a>
    </p>
</x-guest-layout>
