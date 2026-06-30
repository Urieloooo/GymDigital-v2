<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle del Cliente</h2>
            <a href="{{ route('clientes.index') }}"
               class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Datos del cliente --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-gray-800">{{ $cliente->nombre_completo }}</h3>
                    @if($cliente->estado == 'Activo')
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Activo</span>
                    @else
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">Vencido</span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Edad</p>
                        <p class="font-medium">{{ $cliente->edad }} años</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Género</p>
                        <p class="font-medium">{{ $cliente->genero ?? 'Sin especificar' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Teléfono</p>
                        <p class="font-medium">{{ $cliente->telefono }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Correo</p>
                        <p class="font-medium">{{ $cliente->correo ?? 'Sin correo' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Membresía</p>
                        <p class="font-medium">{{ $cliente->membresia->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Fecha de Inscripción</p>
                        <p class="font-medium">{{ $cliente->fecha_inscripcion->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Fecha de Vencimiento</p>
                        <p class="font-medium">{{ $cliente->fecha_vencimiento->format('d/m/Y') }}</p>
                    </div>
                </div>

                @if(auth()->user()->esDueno())
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('clientes.edit', $cliente) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition text-sm">
                        Editar Cliente
                    </a>

                    {{-- Botón eliminar --}}
                    <button onclick="document.getElementById('modal-eliminar').classList.remove('hidden')"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition text-sm">
                        Eliminar Cliente
                    </button>
                </div>
                @endif
            </div>

            {{-- Historial de pagos --}}
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Historial de Pagos</h3>
                    <a href="{{ route('pagos.create') }}?cliente_id={{ $cliente->id }}"
                       class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition text-sm">
                        + Registrar Pago
                    </a>
                </div>

                @if($cliente->pagos->count() > 0)
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-500 uppercase">
                            <th class="py-2">Fecha</th>
                            <th class="py-2">Membresía</th>
                            <th class="py-2">Método</th>
                            <th class="py-2">Monto</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($cliente->pagos as $pago)
                        <tr>
                            <td class="py-2">{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                            <td class="py-2">{{ $pago->membresia->nombre }}</td>
                            <td class="py-2">{{ $pago->metodo_pago }}</td>
                            <td class="py-2 font-medium">${{ number_format($pago->monto, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p class="text-gray-400 text-sm">Sin pagos registrados.</p>
                @endif
            </div>

        </div>
    </div>

    {{-- Modal eliminar --}}
    <div id="modal-eliminar" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-bold text-gray-800 mb-2">Eliminar Cliente</h3>
            <p class="text-sm text-gray-500 mb-4">Esta acción marcará al cliente como eliminado. Ingresa el motivo.</p>

            <form method="POST" action="{{ route('clientes.destroy', $cliente) }}">
                @csrf
                @method('DELETE')
                <textarea name="motivo" rows="3" required
                    placeholder="Motivo de eliminación..."
                    class="w-full border rounded px-3 py-2 text-sm mb-4 focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>

                <div class="flex justify-end gap-3">
                    <button type="button"
                        onclick="document.getElementById('modal-eliminar').classList.add('hidden')"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition text-sm">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition text-sm">
                        Confirmar Eliminación
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>