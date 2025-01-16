<div class="max-w-md mx-auto p-8 space-y-6 bg-gray-800 rounded-lg shadow-md">
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
    <form wire:submit.prevent="submit" class="space-y-6">
    <!-- Nom -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" id="name" wire:model.live="name" 
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" 
                placeholder=" " required />
            <label for="name" 
                class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nom
            </label>
        </div>

        <!-- Email -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="email" id="email" wire:model.live="email" 
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" 
                placeholder=" " required/>
            <label for="email" 
                class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Email
            </label>
        </div>

        <!-- Téléphone -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" id="phone" wire:model.live="phone" 
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" 
                placeholder=" " required/>
            <label for="phone" 
                class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Téléphone
            </label>
        </div>

        <!-- Date et Heure -->
        <div class="grid md:grid-cols-2 md:gap-6">
            <!-- Date -->
            <div class="relative z-0 w-full mb-5 group">
                <input type="date" id="date" wire:model.live="date" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" required />
                <label for="date" 
                    class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Date
                </label>
            </div>

            <!-- Heure -->
            <div class="relative z-0 w-full mb-5 group">
            <select id="time" wire:model.live="time" 
    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer [&>option]:bg-gray-700 [&>option]:text-white" required>
    <option value="" class="bg-gray-700">Sélectionnez une heure</option>
    @foreach($availableTimes as $time)
        <option value="{{ $time }}" class="bg-gray-700">{{ $time }}</option>
    @endforeach
</select>
                <label for="time" 
                    class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Heure
                </label>
            </div>
        </div>

        <!-- Nombre de convives -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="number" id="guests" wire:model.live="guests" 
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" 
                placeholder=" " required/>
            <label for="guests" 
                class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nombre de convives
            </label>
        </div>
        <!-- Choix des tables -->
        <div class="relative z-0 w-full mb-5 group">
            <label for="table_ids" class="block text-sm font-medium text-white">Choix des tables</label>
            <div id="table_ids" class="block w-full bg-gray-700 text-white border-gray-600 rounded-lg p-2">
                @if(empty($guests))
                    <p class="text-sm text-red-500">Veuillez spécifier un nombre de convives</p>
                @else
                @foreach($availableTables as $tableData)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="table_{{ $tableData['table']->table_id }}" wire:model="table_ids" value="{{ $tableData['table']->table_id }}" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">                            
                        <label for="table_{{ $tableData['table']->table_id }}" class="ml-2 block text-sm leading-5 text-white">
                            Table {{ $tableData['table']->table_id }} - {{ $tableData['table']->nb_sieges }} places
                            @if($tableData['recommended'])
                                -> table conseillée
                            @endif
                        </label>
                    </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Bouton Réserver -->
        <button wire:click="submit" 
            class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Réserver
        </button>
    </form>
</div>