<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clientes</h2>
            <a href="{{ route('clientes.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Nuevo Cliente
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filtros --}}
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <form method="GET" action="{{ route('clientes.index') }}" class="flex flex-wrap gap-3">
                    <input type="text" name="buscar" value="{{ request('buscar') }}"
                        placeholder="Buscar por nombre o teléfono..."
                        class="border rounded px-3 py-2 text-sm flex-1 min-w-48">

                    <select name="estado" class="border rounded px-3 py-2 text-sm">
                        <option value="">Todos los estados</option>
                        <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Vencido" {{ request('estado') == 'Vencido' ? 'selected' : '' }}>Vencido</option>
                    </select>

                    <button type="submit"
                        class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition text-sm">
                        Buscar
                    </button>
                    <a href="{{ route('clientes.index') }}"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition text-sm">
                        Limpiar
                    </a>
                </form>
            </div>

            {{-- Tabla --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teléfono</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Membresía</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vencimiento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($clientes as $cliente)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $cliente->nombre_completo }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $cliente->telefono }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $cliente->membresia->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $cliente->fecha_vencimiento->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                @if($cliente->estado == 'Activo')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Activo</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Vencido</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('clientes.show', $cliente) }}"
                                   class="text-blue-600 hover:underline mr-3">Ver</a>
                                @if(auth()->user()->esDueno())
                                <a href="{{ route('clientes.edit', $cliente) }}"
                                   class="text-blue-600 hover:underline mr-3">Editar</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                No se encontraron clientes.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    {{ $clientes->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>