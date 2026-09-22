<section>
    <header class="flex flex-col gap-1">
        <h2 class="text-[15px] font-bold text-ink">Dados da conta</h2>
        <p class="text-[13px] leading-relaxed text-ink-muted">Atualize o nome da loja e o e-mail de acesso.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-5 flex flex-col gap-4">
        @csrf
        @method('patch')

        <div class="flex flex-col gap-1.5">
            <x-input-label for="name" value="Nome da loja" />
            <x-text-input id="name" name="name" type="text" class="w-full max-w-md" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="flex flex-col gap-1.5">
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" name="email" type="email" class="w-full max-w-md" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-[13px] leading-relaxed text-ink-body">
                    Seu e-mail ainda não foi confirmado.

                    <button form="send-verification" class="font-semibold text-brand hover:underline focus:outline-none">
                        Reenviar o e-mail de confirmação.
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="text-xs font-medium text-ok">Um novo link de confirmação foi enviado para o seu e-mail.</p>
                @endif
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <x-primary-button>Salvar</x-primary-button>

            @if (session('status') === 'profile-updated')
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
