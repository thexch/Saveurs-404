<div class="max-w-md mx-auto p-8 space-y-6 bg-gray-800 rounded-lg shadow-md">
    <form class="space-y-6">
        <!-- Nom -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" id="name" wire:model.live="name" 
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" 
                placeholder=" " />
            <label for="name" 
                class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nom
            </label>
        </div>

        <!-- Email -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="email" id="email" wire:model.live="email" 
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" 
                placeholder=" " />
            <label for="email" 
                class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Email
            </label>
        </div>

        <!-- Téléphone -->
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" id="phone" wire:model.live="phone" 
                class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" 
                placeholder=" " />
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
                    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer" />
                <label for="date" 
                    class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                    Date
                </label>
            </div>

            <!-- Heure -->
            <div class="relative z-0 w-full mb-5 group">
            <select id="time" wire:model.live="time" 
    class="block py-2.5 px-0 w-full text-sm bg-transparent border-0 border-b-2 border-gray-600 appearance-none text-white focus:outline-none focus:ring-0 focus:border-indigo-500 peer [&>option]:bg-gray-700 [&>option]:text-white">
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
                placeholder=" " />
            <label for="guests" 
                class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nombre de convives
            </label>
        </div>

        <!-- Bouton Réserver -->
        <button wire:click="submit" 
            class="w-full text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Réserver
        </button>
    </form>
</div>