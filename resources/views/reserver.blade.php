<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Nouvelle réservation') }}
        </h2>
    </x-slot>
    @section('title', 'Nouvelle réservation')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <livewire:reservation-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>