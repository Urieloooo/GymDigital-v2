<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">Detalle del Cliente</h2>
            <a href="{{ route('clientes.index') }}"
               style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
               class="px-4 py-2 rounded hover:opacity-80 transition">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 rounded" style="background-color: #163a2c; border: 1px solid #22543d; color: #9ae6b4;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Datos del cliente --}}
            <div class="rounded-lg shadow p-6" style="background-color: #16213e; border: 1px solid #0f3460;">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-white">{{ $cliente->nombre_completo }}</h3>
                    @if($cliente->estado == 'Activo')
                        <span class="px-3 py-1 rounded-full text-sm font-medium" style="background-color: #163a2c; color: #9ae6b4;">Activo</span>
                    @elseif($cliente->estado == 'Vencido')
                        <span class="px-3 py-1 rounded-full text-sm font-medium" style="background-color: #4a1a1a; color: #fca5a5;">Vencido</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-sm font-medium" style="background-color: #0f3460; color: #e2e8f0;">{{ $cliente->estado }}</span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p style="color: #718096;">Edad</p>
                        <p class="font-medium" style="color: #e2e8f0;">{{ $cliente->edad }} años</p>
                    </div>
                    <div>
                        <p style="color: #718096;">Género</p>
                        <p class="font-medium" style="color: #e2e8f0;">{{ $cliente->genero ?? 'Sin especificar' }}</p>
                    </div>
                    <div>
                        <p style="color: #718096;">Teléfono</p>
                        <p class="font-medium" style="color: #e2e8f0;">{{ $cliente->telefono }}</p>
                    </div>
                    <div>
                        <p style="color: #718096;">Correo</p>
                        <p class="font-medium" style="color: #e2e8f0;">{{ $cliente->correo ?? 'Sin correo' }}</p>
                    </div>
                    <div>
                        <p style="color: #718096;">Membresía</p>
                        <p class="font-medium" style="color: #e2e8f0;">{{ $cliente->membresia->nombre }}</p>
                    </div>
                    <div>
                        <p style="color: #718096;">Fecha de Inscripción</p>
                        <p class="font-medium" style="color: #e2e8f0;">{{ $cliente->fecha_inscripcion->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p style="color: #718096;">Fecha de Vencimiento</p>
                        <p class="font-medium" style="color: #e2e8f0;">{{ $cliente->fecha_vencimiento->format('d/m/Y') }}</p>
                    </div>
                </div>

                @if(auth()->user()->esDueno())
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('clientes.edit', $cliente) }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm font-medium shadow">
                        Editar Cliente
                    </a>
                    <button onclick="document.getElementById('modal-eliminar').classList.remove('hidden')"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition text-sm">
                        Eliminar Cliente
                    </button>
                </div>
                @endif
            </div>

            {{-- Historial de pagos --}}
            <div class="rounded-lg shadow p-6" style="background-color: #16213e; border: 1px solid #0f3460;">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold" style="color: #e2e8f0;">Historial de Pagos</h3>
                    <a href="{{ route('pagos.create') }}?cliente_id={{ $cliente->id }}"
                       class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition text-sm">
                        + Registrar Pago
                    </a>
                </div>

                @if($cliente->pagos->count() > 0)
                <table class="w-full text-sm" style="border-collapse: collapse;">
                    <thead style="background-color: #0f3460;">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Fecha</th>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Membresía</th>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Método</th>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cliente->pagos as $pago)
                        <tr style="border-top: 1px solid #0f3460;" onmouseover="this.style.backgroundColor='#0f3460'" onmouseout="this.style.backgroundColor='transparent'">
                            <td class="py-3 px-4" style="color: #e2e8f0;">{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                            <td class="py-3 px-4" style="color: #e2e8f0;">{{ $pago->membresia->nombre }}</td>
                            <td class="py-3 px-4" style="color: #e2e8f0;">{{ $pago->metodo_pago }}</td>
                            <td class="py-3 px-4 font-medium" style="color: #ffffff;">${{ number_format($pago->monto, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p class="text-sm" style="color: #718096;">Sin pagos registrados.</p>
                @endif
            </div>

        </div>
    </div>

    {{-- Modal eliminar --}}
    <div id="modal-eliminar" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="rounded-lg shadow-lg p-6 max-w-md w-full mx-4" style="background-color: #16213e; border: 1px solid #0f3460;">
            <h3 class="text-lg font-bold text-white mb-2">Eliminar Cliente</h3>
            <p class="text-sm mb-4" style="color: #a0aec0;">Esta acción marcará al cliente como eliminado. Ingresa el motivo.</p>

            <form method="POST" action="{{ route('clientes.destroy', $cliente) }}">
                @csrf
                @method('DELETE')
                <textarea name="motivo" rows="3" required
                    placeholder="Motivo de eliminación..."
                    style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                    class="w-full rounded px-3 py-2 text-sm mb-4 focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>

                <div class="flex justify-end gap-3">
                    <button type="button"
                        onclick="document.getElementById('modal-eliminar').classList.add('hidden')"
                        style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                        class="px-4 py-2 rounded hover:opacity-80 transition text-sm">
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