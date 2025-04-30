<x-layouts.app :title="__('Reservas')">
    Reservas
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table
                    class="min-w-full text-start text-sm font-light text-surface dark:text-white">
                    <thead
                    class="border-b border-neutral-200 bg-zinc-900 font-medium text-white dark:border-white/10">
                    <tr>
                        <th scope="col" class=" px-6 py-4 text-start rounded-tl-xl">ID</th>
                        <th scope="col" class=" px-6 py-4 text-start">Data da reserva</th>
                        <th scope="col" class=" px-6 py-4 text-start">Horario reservado</th>
                        <th scope="col" class=" px-6 py-4 text-start">Usuario</th>
                        <th scope="col" class=" px-6 py-4 text-start">Sala</th>>
                        <th scope="col" class=" px-6 py-4 text-start">Status</th>
                        <th scope="col" class=" px-6 py-4 text-start rounded-tr-xl">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-neutral-200 dark:border-white/10">
                            <td class="whitespace-nowrap  px-6 py-4 font-medium">1</td>
                            <td class="whitespace-nowrap  px-6 py-4">12/12/2025</td>
                            <td class="whitespace-nowrap  px-6 py-4">12:30</td>
                            <td class="whitespace-nowrap  px-6 py-4">User 1</td>
                            <td class="whitespace-nowrap  px-6 py-4">Sala 1</td>
                            <td class="whitespace-nowrap  px-6 py-4">Concluido</td>
                            <td class="whitespace-nowrap  px-6 py-4">
                                <button type="button" class="px-4 py-1 rounded-sm bg-stone-950 cursor-pointer hover:bg-stone-500">Cancelar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
