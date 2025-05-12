<x-layouts.app :title="__('Admin - Reservas')">
    Reservas
    <div class="flex flex-col">
        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg flex justify-between items-center">
                <span>{{ session('status') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="text-xl font-bold text-gray-600 cursor-pointer">&times;</button>
            </div>
        @endif
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-start text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-neutral-200 bg-zinc-900 font-medium text-white dark:border-white/10">
                            <tr>
                                <th scope="col" class=" px-6 py-4 text-start rounded-tl-xl">ID</th>
                                <th scope="col" class=" px-6 py-4 text-start">Data da reserva</th>
                                <th scope="col" class=" px-6 py-4 text-start">Horario reservado</th>
                                <th scope="col" class=" px-6 py-4 text-start">Usuario</th>
                                <th scope="col" class=" px-6 py-4 text-start">Sala</th>
                                <th scope="col" class=" px-6 py-4 text-start">Status</th>
                                <th scope="col" class=" px-6 py-4 text-start rounded-tr-xl">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap  px-6 py-4 font-medium">{{ $reservation->id }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">{{ $reservation->reservation_date }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">{{ $reservation->reservation_time }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">{{ $reservation->user->name }}</td>
                                    <td class="whitespace-nowrap  px-6 py-4">{{ $reservation->room->room_name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="@if($reservation->status === 'cancelado') text-red-500 
                                                     @elseif($reservation->status === 'concluido') text-green-600 
                                                     @else text-blue-500 @endif">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 flex gap-2">
                                        @if ($reservation->status === 'pendente')
                                            <!-- Botão de Cancelar -->
                                            <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja cancelar esta reserva?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-1 rounded-sm bg-red-600 hover:bg-red-500 text-white cursor-pointer">
                                                    Cancelar
                                                </button>
                                            </form>
                                    
                                            <!-- Botão de Check-in -->
                                            <form action="{{ route('admin.reservations.checkin', $reservation) }}" method="POST" onsubmit="return confirm('Confirmar check-in desta reserva?');">
                                                @csrf
                                                <button type="submit" class="px-4 py-1 rounded-sm bg-green-600 hover:bg-green-500 text-white cursor-pointer">
                                                    Check-in
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500 italic">-</span>
                                        @endif
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
