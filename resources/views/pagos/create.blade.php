<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">Registrar Pago</h2>
            <a href="{{ route('pagos.index') }}"
               style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
               class="px-4 py-2 rounded hover:opacity-80 transition">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-lg shadow p-6" style="background-color: #16213e; border: 1px solid #0f3460;">

                @if($errors->any())
                    <div class="mb-4 p-4 rounded" style="background-color: #4a1a1a; border: 1px solid #7f1d1d; color: #fca5a5;">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('pagos.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 gap-5">

                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Cliente *</label>
                            <select name="cliente_id"
                                style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                <option value="">Seleccionar cliente...</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        {{ old('cliente_id', request('cliente_id')) == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre_completo }} — {{ $cliente->telefono }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Membresía *</label>
                            <select name="membresia_id"
                                style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                <option value="">Seleccionar membresía...</option>
                                @foreach($membresias as $membresia)
                                    <option value="{{ $membresia->id }}"
                                        {{ old('membresia_id') == $membresia->id ? 'selected' : '' }}>
                                        {{ $membresia->nombre }} — ${{ number_format($membresia->precio, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Monto *</label>
                                <input type="number" step="0.01" name="monto"
                                    value="{{ old('monto') }}"
                                    style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                    class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Método de Pago *</label>
                                <select name="metodo_pago"
                                    style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                    class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                    <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Fecha de Pago *</label>
                            <input type="date" name="fecha_pago"
                                value="{{ old('fecha_pago', today()->toDateString()) }}"
                                style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e; color-scheme: dark;"
                                class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500"
                                required>
                        </div>

                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('pagos.index') }}"
                           style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                           class="px-4 py-2 rounded hover:opacity-80 transition text-sm">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition text-sm">
                            Registrar Pago
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>