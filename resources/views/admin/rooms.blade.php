<x-layouts.app :title="__('Salas')">
    Salas
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
                    <th scope="col" class=" px-6 py-4 text-start">Nome do local</th>
                    <th scope="col" class=" px-6 py-4 text-start">Endereço</th>
                    <th scope="col" class=" px-6 py-4 text-start">Capacidade</th>
                    <th scope="col" class=" px-6 py-4 text-start rounded-tr-xl">Ação</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-neutral-200 dark:border-white/10">
                        <td class="whitespace-nowrap  px-6 py-4 font-medium">1</td>
                        <td class="whitespace-nowrap  px-6 py-4">Sala 12</td>
                        <td class="whitespace-nowrap  px-6 py-4">Rua Eduardo alves, 2023</td>
                        <td class="whitespace-nowrap  px-6 py-4">12</td>
                        <td class="whitespace-nowrap  px-6 py-4">
                            <button type="button" class="px-4 py-1 rounded-sm bg-stone-950 cursor-pointer hover:bg-stone-500">Editar</button>
                            <button type="button" class="px-4 py-1 rounded-sm bg-stone-950 cursor-pointer hover:bg-stone-500">Apagar</button>
                            <button type="button" class="px-4 py-1 rounded-sm bg-stone-950 cursor-pointer hover:bg-stone-500">Ver sala</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</x-layouts.app>
