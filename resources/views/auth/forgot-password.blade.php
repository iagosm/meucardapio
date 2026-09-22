<x-guest-layout heading="Recuperar senha" subheading="Enviaremos um link para você definir uma nova senha">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-3.5">
        @csrf

        <div class="flex flex-col gap-1.5">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" placeholder="voce@loja.com" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <x-primary-button class="mt-1.5 w-full">Enviar link de recuperação</x-primary-button>
    </form>

    <p class="mt-4 border-t border-line pt-4 text-center text-xs text-ink-muted">
        <a href="{{ route('login') }}" class="font-semibold text-brand hover:underline">Voltar para o login</a>
    </p>
</x-guest-layout>
