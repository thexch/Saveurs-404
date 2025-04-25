<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $privacy_policy = false; 

public function register(): void
{
    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        'privacy_policy' => ['required', 'accepted'], 
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $validated['privacy_policy_accepted'] = true; 

    event(new Registered($user = User::create($validated)));
        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

    <div class="w-full max-w-md p-8 space-y-6 bg-gray-900 rounded-lg shadow-md">
        <div class="text-center">
            <h2 class="text-2xl font-bold">Inscription</h2>
            <p class="mt-2 text-sm text-gray-400">Déjà client ? 
                <a class="underline text-indigo-400 hover:text-indigo-300" href="{{ route('login') }}">
                    {{ __('Se connecter') }}
                </a>
            </p>
        </div>

        <form wire:submit="register" class="space-y-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nom')" class="text-white" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" type="text" name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Mot de passe')" class="text-white" />
                <div class="relative">
                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="new-password" />
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 px-3 py-2">
                    👁️
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-white" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
            </div>
                        <div class="mt-4">
                <div class="flex items-center">
                    <input wire:model="privacy_policy" type="checkbox" id="privacy_policy" name="privacy_policy" class="mr-2 rounded border-gray-600 bg-gray-700 text-indigo-500 focus:ring-indigo-500" required>
                    <label for="privacy_policy" class="text-sm text-gray-300">
                        J'accepte la <button type="button" class="text-indigo-400 hover:text-indigo-300 underline" onclick="document.getElementById('privacy-modal').classList.remove('hidden')">politique de confidentialité</button>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('privacy_policy')" class="mt-2 text-red-500" />
            </div>

            <!-- Modal -->
<div id="privacy-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-4/5 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-gray-800 border-gray-700">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-white">✅ Politique de confidentialité</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-300 space-y-4">
                    <p class="mb-4">
                        En créant un compte, vous acceptez que Saveurs404 collecte et utilise vos données personnelles (nom, e-mail, réservations) uniquement pour gérer votre compte et vos réservations.
                    </p>
                    
                    <p class="mb-4">
                        Vos données ne seront jamais revendues.
                    </p>
                    
                    <p class="mb-4">
                        Conformément au RGPD, vous avez à tout moment :
                    </p>
                    
                    <ul class="list-none space-y-2 ml-4">
                        <li>– Le droit de consulter vos données,</li>
                        <li>– Le droit de les modifier ou de les supprimer,</li>
                        <li>– Le droit à la portabilité (export)</li>
                    </ul>
                    
                    <p class="mt-4">
                        Toutes ces actions sont accessibles depuis votre espace personnel.
                    </p>
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <button type="button" 
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-400 text-white text-base font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        onclick="document.getElementById('privacy-modal').classList.add('hidden')">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

            <div>
                <button type="submit" class="w-full px-4 py-2 bg-indigo-500 hover:bg-indigo-400 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('S\'inscrire') }}
                </button>
            </div>
        </form>
    </div>


<script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var passwordFieldType = passwordField.getAttribute('type');
        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
        } else {
            passwordField.setAttribute('type', 'password');
        }
    }
</script>
