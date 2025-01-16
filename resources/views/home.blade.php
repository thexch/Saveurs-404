<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Saveurs 404</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-white">
    <x-app-layout>
        <!-- Notifications -->
        @if (session('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4 transition-opacity duration-1000">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div id="error-message" class="bg-red-500 text-white p-4 rounded mb-4 transition-opacity duration-1000">
                {{ session('error') }}
            </div>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    var successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        successMessage.classList.add('opacity-0');
                        setTimeout(function() {
                            successMessage.style.display = 'none';
                        }, 1000);
                    }

                    var errorMessage = document.getElementById('error-message');
                    if (errorMessage) {
                        errorMessage.classList.add('opacity-0');
                        setTimeout(function() {
                            errorMessage.style.display = 'none';
                        }, 1000);
                    }
                }, 3000); 
            });
        </script>

        <!-- Présentation -->
        <div class="relative">
            <img src="{{ asset('image.png') }}" alt="Restaurant" class="w-full h-96 object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <h1 class="text-4xl font-bold text-white">Bienvenue à Saveurs 404</h1>
            </div>
        </div>

        <!-- Avis -->
        <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6">Avis de nos clients</h2>
        <div class="space-y-6">
            @forelse($bestReviews as $avis)
                <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-center mb-2">
                        <div class="flex items-center space-x-2">
                            <span class="text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $avis->note)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </span>
                            <span class="text-gray-300">{{ $avis->user->name }}</span>
                        </div>
                        <span class="text-gray-400 text-sm">{{ $avis->date->format('d/m/Y') }}</span>
                    </div>
                    <p class="text-gray-400">"{{ $avis->commentaire }}"</p>
                </div>
            @empty
                <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                    <p class="text-gray-400">Aucun avis pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="py-12 bg-gray-800">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Adresse & Horaires</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Adresse et Maps -->
            <div class="bg-gray-900 p-6 rounded-lg shadow-lg">
    <h3 class="text-xl font-semibold mb-4 text-center">Notre Restaurant</h3>
    <div class="flex flex-col items-center justify-center mb-6">
        <p class="text-gray-400">123 Rue de la Gastronomie</p>
        <p class="text-gray-400">75000 Paris, France</p>
    </div>
    <div class="flex justify-center">
        <a href="https://www.google.fr/maps/dir//Dijon+Formation" 
           target="_blank"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition duration-150 ease-in-out">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Itinéraire Google Maps
        </a>
    </div>
</div>

            <!-- Horaires -->
            <div class="bg-gray-900 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold mb-4">Horaires d'ouverture</h3>
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Lundi</span>
                        <span class="text-gray-400">12:00 - 22:00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Mardi</span>
                        <span class="text-gray-400">12:00 - 22:00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Mercredi</span>
                        <span class="text-gray-400">12:00 - 22:00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Jeudi</span>
                        <span class="text-gray-400">12:00 - 22:00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Vendredi</span>
                        <span class="text-gray-400">12:00 - 22:00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Samedi</span>
                        <span class="text-gray-400">12:00 - 23:00</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Dimanche</span>
                        <span class="text-gray-400">12:00 - 23:00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Bouton MODAL avis-->
<div class="text-center my-4" x-data="{ open: false }">
    <button type="button" @click="open = true" class="btn btn-primary">
        Laissez votre avis !
    </button>

    <!-- MODAL avis-->
    <template x-teleport="body">
        <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="relative w-full max-w-2xl bg-gray-900 rounded-lg shadow-xl">
                <button @click="open = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-200">
                        <span class="text-2xl">&times;</span>
                    </button>
                    <div class="p-6">
                        @auth
                        <h3 class="text-xl font-semibold mb-4 text-white">Donnez votre avis</h3>
                        
                        <form action="{{ route('avis.store') }}" method="POST" class="space-y-4" x-data="{ rating: 0 }">
    @csrf
    <div>
        <label class="block text-sm font-medium text-white mb-2">Note</label>
        <div class="flex space-x-1">
            <template x-for="i in 5">
                <button type="button" 
                    @click="rating = i"
                    @mouseover="$el.parentElement.querySelectorAll('svg').forEach((svg, index) => {
                        svg.classList.toggle('text-yellow-400', index < i);
                    })"
                    @mouseleave="$el.parentElement.querySelectorAll('svg').forEach((svg, index) => {
                        svg.classList.toggle('text-yellow-400', index < rating);
                    })"
                    class="focus:outline-none">
                    <svg class="w-8 h-8" :class="rating >= i ? 'text-yellow-400' : 'text-gray-500'" 
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </button>
            </template>
        </div>
        <input type="hidden" name="note" :value="rating" required>
    </div>

                            <div>
                                <label class="block text-sm font-medium text-white">Votre commentaire</label>
                                <textarea name="commentaire" rows="3" required
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-lg p-2"></textarea>
                            </div>

                            <div class="flex justify-end space-x-3 mt-6">
                                
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                        @else
                            <p class="text-gray-400">Vous devez être connecté pour laisser un avis. 
                                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-900">Se connecter</a>
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>



        <!-- Bas de page -->
        <footer class="bg-gray-900 py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-semibold">Contact</h3>
                        <p class="text-gray-400">Téléphone: +33 1 23 45 67 89</p>
                        <p class="text-gray-400">Email: contact@saveurs404.com</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold">Suivez-nous</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/dijonfo/?locale=fr_FR" target="_blank" class="text-gray-400 hover:text-white">Facebook</a>
                            <a href="https://www.instagram.com/dijon_formation/?hl=fr" target="_blank" class="text-gray-400 hover:text-white">Instagram</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </x-app-layout>
</body>

</html>
