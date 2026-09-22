<x-guest-layout heading="Confirme seu e-mail" subheading="Enviamos um link de confirmação para o e-mail cadastrado. Clique nele para liberar o acesso ao painel.">
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-[10px] bg-ok/10 px-3.5 py-2.5 text-xs font-medium leading-relaxed text-ok">
            Um novo link de confirmação foi enviado para o seu e-mail.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <x-primary-button class="w-full">Reenviar e-mail de confirmação</x-primary-button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-4 border-t border-line pt-4 text-center">
        @csrf
        <button type="submit" class="text-xs text-ink-muted transition-colors hover:text-brand">Sair</button>
    </form>
</x-guest-layout>
