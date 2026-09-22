<x-guest-layout heading="Definir nova senha" subheading="Escolha uma senha para voltar a acessar o painel">
    <form method="POST" action="{{ route('password.store') }}" class="flex flex-col gap-3.5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="flex flex-col gap-1.5">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="password" value="Nova senha" />
            <x-text-input id="password" class="w-full" type="password" name="password" placeholder="••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="password_confirmation" value="Confirmar nova senha" />
            <x-text-input id="password_confirmation" class="w-full" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <x-primary-button class="mt-1.5 w-full">Salvar nova senha</x-primary-button>
    </form>
</x-guest-layout>
