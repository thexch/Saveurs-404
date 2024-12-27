<?php
use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="w-full max-w-md p-8 space-y-6 bg-gray-900 rounded-lg shadow-md">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="text-center">
            <h2 class="text-2xl font-bold">Connexion</h2>
            <p class="mt-2 text-sm text-gray-400">Pas encore client ? 
                <a class="underline text-indigo-400 hover:text-indigo-300" href="{{ route('register') }}">
                    {{ ('Créer un compte') }}
                </a>
            </p>
        </div>

        <form wire:submit="login" class="space-y-6">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="('Email')" class="text-white" />
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="('Mot de passe')" class="text-white" />
                <div class="relative">
                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full bg-gray-700 text-white border-gray-600 focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 px-3 py-2">
                    👁️
                    </button>
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-500" />
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-600 text-indigo-500 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-400">{{ ('Se souvenir de moi') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-gray-300" href="{{ route('password.request') }}">
                        {{ ('Mot de passe oublié ?') }}
                    </a>
                @endif
            </div>

            <div>
                <button type="submit" class="w-full px-4 py-2 bg-indigo-500 hover:bg-indigo-400 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ ('Se connecter') }}
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