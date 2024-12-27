<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        // Ajouter un log pour déboguer
        logger()->info('Tentative de déconnexion');
        
        try {
            $logout();
            $this->redirect('/', navigate: true);
        } catch (\Exception $e) {
            logger()->error('Erreur de déconnexion: ' . $e->getMessage());
        }
    }
}; ?>

<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 text-white">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('reserver')" :active="request()->routeIs('reserver')" wire:navigate class="text-white hover:text-white">
                        {{ __('Réserver') }}
                    </x-nav-link>
                </div>
                
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('reservations')" :active="request()->routeIs('reservations')" wire:navigate class="text-white hover:text-white">
                        {{ __('Mes réservations') }}
                    </x-nav-link>
                </div>
                @if (Auth::user() && Auth::user()->role == 'admin')
                    <!-- Admin Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.gestionreservations')" :active="request()->routeIs('admin.gestionreservations')" wire:navigate class="text-white hover:text-white">
                            {{ __('Gestion des réservations') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('admin.gestionusers')" :active="request()->routeIs('admin.gestionusers')" wire:navigate class="text-white hover:text-white">
                            {{ __('Gestion des utilisateurs') }}
                        </x-nav-link>
                    </div>
                @endif
            </div>

            <!-- Settings Dropdown -->
@auth
<div class="hidden sm:flex sm:items-center sm:ms-6">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-gray-600 text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>

                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile')" class="text-gray-700">
                {{ __('Mon profil') }}
            </x-dropdown-link>

            <!-- Livewire Logout Button -->
            <livewire:logout-button />
        </x-slot>
    </x-dropdown>
</div>
@else
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-2 border border-gray-600 text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                        {{ __('Se connecter') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>