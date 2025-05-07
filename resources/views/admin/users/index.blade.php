<x-layouts.app :title="$title">
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
                                <th scope="col" class="px-6 py-4 text-start">Nome</th>
                                <th scope="col" class="px-6 py-4 text-start">Email</th>
                                <th scope="col" class="px-6 py-4 text-start">Role</th>
                                <th scope="col" class="px-6 py-4 text-start rounded-tr-xl">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-neutral-200 dark:border-white/10">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $user->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $user->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $user->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ ucfirst($user->role) }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-1 rounded-sm bg-stone-950 text-white hover:bg-stone-500">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Nenhum usuário encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <button onclick="document.getElementById('modal').classList.remove('hidden')" 
            class="px-4 py-2 bg-zinc-900 text-white rounded hover:bg-zinc-600 cursor-pointer">
                Adicionar usuário
            </button>
        </div>
    </div>
    
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-zinc-800 rounded-lg shadow-xl w-full max-w-lg p-6 relative">
            <!-- Botão Fechar (X) -->
            <button onclick="document.getElementById('modal').classList.add('hidden')" 
                class="absolute top-5 right-5 text-zinc-400 hover:text-white text-2xl cursor-pointer">
                &times;
            </button>
        
            <h2 class="text-xl font-semibold text-white mb-4">Cadastrar Novo Admin</h2>
        
            <!-- Formulário -->
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
        
                <div>
                <label for="name" class="block text-sm font-medium text-zinc-300 mb-1">Nome</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
        
                <div>
                <label for="email" class="block text-sm font-medium text-zinc-300 mb-1">E-mail</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
        
                <div>
                <label for="password" class="block text-sm font-medium text-zinc-300 mb-1">Senha</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
        
                <div>
                <label for="password_confirmation" class="block text-sm font-medium text-zinc-300 mb-1">Confirmar Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2 bg-zinc-700 text-white border border-zinc-600 rounded-md focus:ring-2 focus:ring-blue-500 outline-none" />
                </div>
        
                <div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-md transition duration-200 cursor-pointer">
                    Cadastrar Admin
                </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.app>
