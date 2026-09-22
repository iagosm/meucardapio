<section>
    <header class="flex flex-col gap-1">
        <h2 class="text-[15px] font-bold text-ink">Excluir conta</h2>
        <p class="text-[13px] leading-relaxed text-ink-muted">
            Ao excluir a conta, todos os dados da loja são apagados permanentemente. Baixe antes o que quiser guardar.
        </p>
    </header>

    <x-danger-button
        class="mt-5"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Excluir conta</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" maxWidth="md" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="flex flex-col gap-4 p-5 sm:p-6">
            @csrf
            @method('delete')

            <div class="flex flex-col gap-1">
                <h2 class="text-[15px] font-bold text-ink">Tem certeza que quer excluir a conta?</h2>
                <p class="text-[13px] leading-relaxed text-ink-muted">
                    Esta ação é permanente. Digite sua senha para confirmar.
                </p>
            </div>

            <div class="flex flex-col gap-1.5">
                <x-input-label for="password" value="Senha" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full"
                    placeholder="Senha"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="flex flex-col-reverse gap-2.5 sm:flex-row sm:justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button>
                    Excluir conta
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
