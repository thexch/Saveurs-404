<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Historique des réservations') }}
        </h2>
    </x-slot>
    @section('title', 'Historique des réservations')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-xl font-semibold mb-4 text-white">Réservations à venir</h3>
                    @if($upcomingReservations->isEmpty())
                        <p class="text-gray-400">Aucune réservation à venir.</p>
                        <br>
                    @else
                        <div class="overflow-x-auto mb-8">
                            <table class="min-w-full bg-gray-800 border border-gray-700">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Nom</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Email</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Téléphone</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Date</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Heure</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Nombre de convives</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingReservations as $reservation)
                                        <tr class="hover:bg-gray-700">
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->name }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->email }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->phone }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->time }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->guests }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">
                                                <form action="{{ route('reservations.destroy', ['id' => $reservation->reservation_id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <h3 class="text-xl font-semibold mb-4 text-white">Réservations passées</h3>
                    @if($pastReservations->isEmpty())
                        <p class="text-gray-400">Aucune réservation passée.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-800 border border-gray-700">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Nom</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Email</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Téléphone</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Date</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Heure</th>
                                        <th class="py-3 px-4 border-b border-gray-600 text-left text-sm font-semibold text-white">Nombre de convives</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pastReservations as $reservation)
                                        <tr class="hover:bg-gray-700">
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->name }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->email }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->phone }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->time }}</td>
                                            <td class="py-3 px-4 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->guests }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>