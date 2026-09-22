<x-guest-layout heading="Painel do lojista" subheading="Entre para gerenciar sua loja">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-3.5">
        @csrf

        <div class="flex flex-col gap-1.5">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" placeholder="voce@loja.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="password" value="Senha" />
            <x-text-input id="password" class="w-full" type="password" name="password" placeholder="••••••••" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <label for="remember_me" class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-line-strong text-brand focus:ring-brand/30">
            <span class="text-xs text-ink-body">Manter conectado</span>
        </label>

        <x-primary-button class="mt-1.5 w-full">Entrar</x-primary-button>

        @if (Route::has('password.request'))
            <a class="text-center text-xs text-ink-muted transition-colors hover:text-brand" href="{{ route('password.request') }}">
                Esqueceu a senha?
            </a>
        @endif
    </form>

    @if (Route::has('register'))
        <p class="mt-4 border-t border-line pt-4 text-center text-xs text-ink-muted">
            Ainda não tem conta?
            <a href="{{ route('register') }}" class="font-semibold text-brand hover:underline">Criar conta</a>
        </p>
    @endif
</x-guest-layout>
