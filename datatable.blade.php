<div>
    {{-- Barra de herramientas (Búsqueda, etc) --}}
    <div class="mb-4 flex justify-between items-center">
        <input
            wire:model.live.debounce.300ms="search"
            type="text"
            placeholder="Buscar..."
            class="border p-2 rounded w-full md:w-1/3"
        >
    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    @foreach($columns as $column)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $column['label'] ?? '' }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($rows as $row)
                    <tr>
                        @foreach($columns as $column)
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- Aquí podrías implementar lógica para renderizar celdas personalizadas --}}
                                {{ data_get($row, $column['key']) }}
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) }}" class="px-6 py-4 text-center text-gray-500">
                            No se encontraron resultados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $rows->links() }}
    </div>
</div>