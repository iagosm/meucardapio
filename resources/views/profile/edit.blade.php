<x-app-layout>
    <x-slot name="header">
        <h1 class="text-[17px] font-extrabold text-ink">Meu perfil</h1>
    </x-slot>

    <div class="mx-auto w-full max-w-3xl space-y-4 px-5 py-6 sm:px-6 lg:px-8">
        <div class="rounded-2xl border border-line bg-white p-5 sm:p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="rounded-2xl border border-line bg-white p-5 sm:p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="rounded-2xl border border-line bg-white p-5 sm:p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
