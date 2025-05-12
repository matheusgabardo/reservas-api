<x-layouts.app :title="__('Admin - Salas')">
    <div class="flex flex-col">
        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg flex justify-between items-center">
                <span>{{ session('status') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="text-xl font-bold text-gray-600">&times;</button>
            </div>
        @endif

        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-start text-sm font-light text-surface dark:text-white">
                        <thead class="border-b border-neutral-200 bg-zinc-900 font-medium text-white dark:border-white/10">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-start rounded-tl-xl">ID</th>
                                <th scope="col" class="px-6 py-4 text-start">Nome do sala</th>
                                <th scope="col" class="px-6 py-4 text-start">Endereço</th>
                                <th scope="col" class="px-6 py-4 text-start">Capacidade</th>
                                <th scope="col" class="px-6 py-4 text-start">Avaliação</th>
                                <th scope="col" class="px-6 py-4 text-start rounded-tr-xl">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rooms as $room)
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $room->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $room->room_name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $room->address }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $room->capacity }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $room->rating)
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" class="w-5 h-5 text-yellow-500">
                                                        <path d="M10 15l-3.5 2.1 1-4.5L3 8.5l4.6-.4L10 3l1.4 4.1 4.6.4-3.5 4.1 1 4.5z" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" class="w-5 h-5 text-gray-400">
                                                        <path d="M10 15l-3.5 2.1 1-4.5L3 8.5l4.6-.4L10 3l1.4 4.1 4.6.4-3.5 4.1 1 4.5z" />
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                    </td>
                                    
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline" onclick="return confirm('Tem certeza que deseja excluir essa sala?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-1 rounded-sm bg-red-600 text-white cursor-pointer hover:bg-red-500">
                                                Apagar
                                            </button>
                                        </form>
                                        <!-- <button type="button" class="px-4 py-1 rounded-sm bg-stone-950 cursor-pointer hover:bg-stone-500">Ver sala</button> -->
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td colspan="6" class="text-center whitespace-nowrap px-6 py-4 font-medium">Nenhuma sala encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Botão Adicionar Sala -->
        <div class="flex justify-end">
            <button onclick="document.getElementById('modal').classList.remove('hidden')" 
            class="px-4 py-2 bg-zinc-900 text-white rounded hover:bg-zinc-600 cursor-pointer">
                Adicionar Sala
            </button>
        </div>
    </div>

    <!-- Modal Adicionar Sala -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-zinc-800 rounded-lg shadow-xl w-full max-w-lg p-6 relative">
            <button onclick="document.getElementById('modal').classList.add('hidden')" 
                class="absolute top-5 right-5 text-zinc-400 hover:text-white text-2xl cursor-pointer">
                &times;
            </button>

            <h2 class="text-xl font-semibold text-white mb-4">Cadastrar Nova Sala</h2>

            <form action="{{ route('admin.rooms.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <div>
                    <label for="room_name" class="block text-sm font-medium text-zinc-300 mb-1">Nome da Sala</label>
                    <input type="text" name="room_name" id="room_name" required class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>

                <div>
                    <label for="location_name" class="block text-sm font-medium text-zinc-300 mb-1">Nome do sala</label>
                    <input type="text" name="location_name" id="location_name" required class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-zinc-300 mb-1">Endereço</label>
                    <input type="text" name="address" id="address" required class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-medium text-zinc-300 mb-1">Capacidade</label>
                    <input type="number" name="capacity" id="capacity" required class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>

                <div>
                    <label for="rating" class="block text-sm font-medium text-zinc-300 mb-1">Avaliação (0-5)</label>
                    <input type="number" name="rating" id="rating" min="0" max="5" class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-zinc-300 mb-1">Descrição</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-zinc-300 mb-1">Imagem</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-md transition duration-200 cursor-pointer">
                        Cadastrar Sala
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
