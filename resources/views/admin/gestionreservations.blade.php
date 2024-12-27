<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Gestion des réservations') }}
        </h2>
    </x-slot>
    @section('title', 'Gestion des réservations')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="py-12" x-data="reservationManager" x-init="() => { open = false; selectedReservation = null;}">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-xl font-semibold mb-4 text-white">Toutes les réservations</h3>
                    <input type="text" id="searchInput" placeholder="Rechercher..." class="mb-4 p-2 bg-gray-700 text-white border-gray-600 rounded-lg w-full">
                    @if($reservations->isEmpty())
                        <p class="text-gray-400">Aucune réservation trouvée.</p>
                    @else
                    <div class="p-6 text-white">
                        <!-- Réservations à venir -->
                        <h3 class="text-xl font-semibold mb-4 text-white">Réservations à venir</h3>
                        @if($reservations->where('date', '>=', now()->toDateString())->isEmpty())
                            <p class="text-gray-400 mb-8">Aucune réservation future trouvée.</p>
                        @else
                            <div class="overflow-x-auto mb-8">
                                <table class="min-w-full bg-gray-800 border border-gray-700" id="reservationTable">
                                    <thead class="bg-gray-700">
                                        <tr>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(0, 'reservationTable')">Client <span id="sortIcon0"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(1, 'reservationTable')">Email Client <span id="sortIcon1"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(2, 'reservationTable')">Nom Réservation <span id="sortIcon2"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(3, 'reservationTable')">Email Réservation <span id="sortIcon3"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(4, 'reservationTable')">Téléphone <span id="sortIcon4"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(5, 'reservationTable')">Date <span id="sortIcon5"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(6, 'reservationTable')">Heure <span id="sortIcon6"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(7, 'reservationTable')">Convives <span id="sortIcon7"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reservations->where('date', '>=', now()->toDateString()) as $reservation)
                                        <tr class="hover:bg-gray-700">
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->user->name ?? 'N/A' }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->user->email ?? 'N/A' }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->name }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->email }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->phone }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->time }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->guests }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">
                                                <div class="flex space-x-2">
                                                    <button @click="open = true; selectedReservation = JSON.parse('{{ json_encode($reservation) }}')"
                                                        class="text-indigo-400 hover:text-indigo-300">
                                                        Modifier
                                                    </button>
                                                    <form action="{{ route('admin.deletereservation', $reservation->reservation_id) }}" 
                                                        method="POST" 
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');" 
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <!-- Réservations passées -->
                        <h3 class="text-xl font-semibold mb-4 text-white">Réservations passées</h3>
                        @if($reservations->where('date', '<', now()->toDateString())->isEmpty())
                            <p class="text-gray-400">Aucune réservation passée trouvée.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-gray-800 border border-gray-700" id="pastReservationTable">
                                    <thead class="bg-gray-700">
                                        <tr>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(0, 'pastReservationTable')">Client <span id="sortIcon0_past"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(1, 'pastReservationTable')">Email Client <span id="sortIcon1_past"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(2, 'pastReservationTable')">Nom Réservation <span id="sortIcon2_past"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(3, 'pastReservationTable')">Email Réservation <span id="sortIcon3_past"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(4, 'pastReservationTable')">Téléphone <span id="sortIcon4_past"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(5, 'pastReservationTable')">Date <span id="sortIcon5_past"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(6, 'pastReservationTable')">Heure <span id="sortIcon6_past"></span></th>
                                            <th class="py-3 px-2 border-b border-gray-600 text-left text-sm font-semibold text-white cursor-pointer" onclick="sortTable(7, 'pastReservationTable')">Convives <span id="sortIcon7_past"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reservations->where('date', '<', now()->toDateString()) as $reservation)
                                        <tr class="hover:bg-gray-700">
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->user->name ?? 'N/A' }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->user->email ?? 'N/A' }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->name }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->email }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->phone }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->time }}</td>
                                            <td class="py-3 px-2 border-b border-gray-600 text-sm text-gray-300">{{ $reservation->guests }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <template x-teleport="body">
        <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="relative min-h-screen flex items-center justify-center p-4">
                <div class="relative w-full max-w-2xl bg-gray-900 rounded-lg shadow-xl">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-4 text-white">Modifier la réservation</h3>
                        
                        <form @submit.prevent="submitForm()" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-white">Nom</label>
                                <input type="text" x-model="selectedReservation.name" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-lg p-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-white">Email</label>
                                <input type="email" x-model="selectedReservation.email"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-lg p-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-white">Téléphone</label>
                                <input type="text" x-model="selectedReservation.phone"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-lg p-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-white">Date</label>
                                <input type="date" x-model="selectedReservation.date"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-lg p-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-white">Heure</label>
                                <input type="time" x-model="selectedReservation.time"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-lg p-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-white">Nombre de convives</label>
                                <input type="number" x-model="selectedReservation.guests"
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-lg p-2">
                            </div>

                            <div class="flex justify-end space-x-3 mt-6">
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">
                                    Annuler
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
                                    Sauvegarder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('reservationManager', () => ({
            open: false,
            selectedReservation: null,

            async submitForm() {
                try {
                    const response = await fetch(`/admin/reservations/${this.selectedReservation.reservation_id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(this.selectedReservation)
                    });

                    const data = await response.json();
                    
                    if (data.success) {
                        this.open = false;
                        alert('Réservation modifiée avec succès');
                        window.location.reload();
                    } else {
                        alert('Erreur lors de la mise à jour');
                    }
                } catch (error) {
                    console.error('Erreur:', error);
                    alert('Erreur lors de la mise à jour');
                }
            }
        }));
    });

    // Fonction de tri
    function sortTable(n, tableId = 'reservationTable') {
        const table = document.getElementById(tableId);
        let rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        switching = true;
        dir = "asc"; 
        resetSortIcons(tableId);
        document.getElementById(`sortIcon${n}${tableId === 'pastReservationTable' ? '_past' : ''}`).innerHTML = "▲";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++; 
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    document.getElementById(`sortIcon${n}${tableId === 'pastReservationTable' ? '_past' : ''}`).innerHTML = "▼";
                    switching = true;
                }
            }
        }
    }

    // Réinitialiser les icônes de tri
    function resetSortIcons(tableId) {
        const icons = document.querySelectorAll(`#${tableId} th span`);
        icons.forEach(icon => {
            icon.innerHTML = "";
        });
    }

    // Fonction de recherche
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#reservationTable tbody tr, #pastReservationTable tbody tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            let match = false;
            cells.forEach(cell => {
                if (cell.textContent.toLowerCase().includes(filter)) {
                    match = true;
                }
            });
            if (match) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>
</x-app-layout>