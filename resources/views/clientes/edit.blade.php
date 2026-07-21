<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">Editar Cliente</h2>
            <a href="{{ route('clientes.show', $cliente) }}"
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

                <form method="POST" action="{{ route('clientes.update', $cliente) }}">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 gap-5">

                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Nombre Completo *</label>
                            <input type="text" name="nombre_completo"
                                value="{{ old('nombre_completo', $cliente->nombre_completo) }}"
                                style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Edad *</label>
                                <input type="number" name="edad"
                                    value="{{ old('edad', $cliente->edad) }}"
                                    style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                    class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Género</label>
                                <select name="genero"
                                    style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                    class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Sin especificar</option>
                                    <option value="Masculino" {{ old('genero', $cliente->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('genero', $cliente->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('genero', $cliente->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Teléfono *</label>
                            <input type="text" name="telefono"
                                value="{{ old('telefono', $cliente->telefono) }}"
                                style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" style="color: #a0aec0;">Correo Electrónico</label>
                            <input type="email" name="correo"
                                value="{{ old('correo', $cliente->correo) }}"
                                style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                                class="w-full rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('clientes.show', $cliente) }}"
                           style="background-color: #0f3460; color: #e2e8f0; border: 1px solid #16213e;"
                           class="px-4 py-2 rounded hover:opacity-80 transition text-sm">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition text-sm">
                            Guardar Cambios
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>