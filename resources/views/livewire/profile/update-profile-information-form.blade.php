<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
{
    $user = Auth::user();

    // Validez d'abord uniquement le nom
    $validated = $this->validate([
        'name' => ['required', 'string', 'max:255'],
    ]);

    // Validez l'email seulement s'il a été modifié
    if ($this->email !== $user->email) {
        $this->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);
        $validated['email'] = $this->email;
        $user->email_verified_at = null;
    }

    $user->fill($validated);
    $user->save();

    $this->dispatch('profile-updated', name: $user->name);
}

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Information du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Mettre à jour les informations de profil et l'adresse e-mail de votre compte.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Nom')" class="text-white"/>
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full text-gray-900" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mail')" class="text-white"/>
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full text-gray-900" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Votre adresse e-mail n\'est pas vérifiée.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Cliquez ici pour renvoyez un e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gray-700">{{ __('Sauvegarder') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Sauvegardé.') }}
            </x-action-message>
        </div>
    </form>
</section>
