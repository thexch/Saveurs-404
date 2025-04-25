<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Mon Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Modifier ces informations  -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>
            <!-- Modifier son mot de passe -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>
            <!-- Supprimer le compte -->
            <div class="p-4 sm:p-8 bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
            <!-- Exporter les données -->
            <section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Exporter mes données') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __('Vous pouvez télécharger une copie de vos données personnelles et de vos réservations au format CSV.') }}
        </p>
    </header>

    <a href="{{ route('export.user') }}">
        <x-primary-button class="bg-gray-700">
            {{ __('Télécharger mes données') }}
        </x-primary-button>
    </a>
</section>
        </div>
    </div>
</x-app-layout>
