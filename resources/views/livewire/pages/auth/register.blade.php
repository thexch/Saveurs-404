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

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

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
