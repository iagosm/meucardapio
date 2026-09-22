<section>
    <header class="flex flex-col gap-1">
        <h2 class="text-[15px] font-bold text-ink">Alterar senha</h2>
        <p class="text-[13px] leading-relaxed text-ink-muted">Use uma senha longa e exclusiva para manter a conta segura.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-5 flex flex-col gap-4">
        @csrf
        @method('put')

        <div class="flex flex-col gap-1.5">
            <x-input-label for="update_password_current_password" value="Senha atual" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="w-full max-w-md" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="update_password_password" value="Nova senha" />
            <x-text-input id="update_password_password" name="password" type="password" class="w-full max-w-md" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="update_password_password_confirmation" value="Confirmar nova senha" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full max-w-md" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <x-primary-button>Salvar</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-medium text-ok"
                >Salvo.</p>
            @endif
        </div>
    </form>
</section>
