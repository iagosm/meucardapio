<x-guest-layout heading="Confirmar senha" subheading="Esta é uma área protegida. Confirme sua senha para continuar.">
    <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-col gap-3.5">
        @csrf

        <div class="flex flex-col gap-1.5">
            <x-input-label for="password" value="Senha" />
            <x-text-input id="password" class="w-full" type="password" name="password" placeholder="••••••••" required autofocus autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <x-primary-button class="mt-1.5 w-full">Confirmar</x-primary-button>
    </form>
</x-guest-layout>
