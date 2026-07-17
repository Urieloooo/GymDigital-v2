<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">Clientes</h2>
            <a href="{{ route('clientes.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Nuevo Cliente
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-900 border border-green-700 text-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-lg shadow p-4 mb-6" style="background-color: #16213e; border: 1px solid #0f3460;">
                <form method="GET" action="{{ route('clientes.index') }}" class="flex flex-wrap gap-3">
                    <input type="text" name="buscar" value="{{ request('buscar') }}"
                        placeholder="Buscar por nombre o teléfono..."
                        class="rounded px-3 py-2 text-sm flex-1 min-w-48 text-gray-200"
                        style="background-color: #0f3460; border: 1px solid #1e4a80;">
                    <select name="estado" class="rounded px-3 py-2 text-sm text-gray-200"
                        style="background-color: #0f3460; border: 1px solid #1e4a80;">
                        <option value="">Todos los estados</option>
                        <option value="Activo" {{ request('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Vencido" {{ request('estado') == 'Vencido' ? 'selected' : '' }}>Vencido</option>
                    </select>
                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-800 transition text-sm">
                        Buscar
                    </button>
                    <a href="{{ route('clientes.index') }}" class="text-gray-300 px-4 py-2 rounded hover:bg-slate-700 transition text-sm" style="background-color: #0f3460;">
                        Limpiar
                    </a>
                </form>
            </div>

            <div class="rounded-lg shadow overflow-hidden" style="background-color: #16213e; border: 1px solid #0f3460;">
                    <table class="w-full" style="border-collapse: collapse; width: 100%;">
                    <thead style="background-color: #0f3460;">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase">Teléfono</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase">Membresía</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase">Fecha de Registro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase">Fecha de Vencimiento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientes as $cliente)
                        <tr style="border-bottom: 1px solid #0f3460;">
                            <td class="px-6 py-4 text-sm font-medium text-gray-200">{{ $cliente->nombre_completo }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $cliente->telefono }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $cliente->membresia->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $cliente->fecha_inscripcion->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $cliente->fecha_vencimiento->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($cliente->estado == 'Activo')
                                    <span class="px-2 py-1 bg-green-900 text-green-300 rounded-full text-xs font-medium">Activo</span>
                                @else
                                    <span class="px-2 py-1 bg-red-900 text-red-300 rounded-full text-xs font-medium">Vencido</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('clientes.show', $cliente) }}"
                                       class="px-2 py-1 rounded text-xs font-medium transition hover:opacity-80"
                                       style="background-color: #0f3460; color: #93c5fd;">Ver</a>
                                    @if(auth()->user()->esDueno())
                                    <a href="{{ route('clientes.edit', $cliente) }}"
                                       class="px-2 py-1 rounded text-xs font-medium transition hover:opacity-80"
                                       style="background-color: #0f3460; color: #93c5fd;">Editar</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
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