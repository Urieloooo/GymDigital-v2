<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle del Pago</h2>
            <a href="{{ route('pagos.index') }}"
               class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Cliente</p>
                        <p class="font-medium">
                            <a href="{{ route('clientes.show', $pago->cliente) }}" class="text-blue-600 hover:underline">
                                {{ $pago->cliente->nombre_completo }}
                            </a>
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Membresía</p>
                        <p class="font-medium">{{ $pago->membresia->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Monto</p>
                        <p class="font-medium text-green-600 text-lg">${{ number_format($pago->monto, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Método de Pago</p>
                        <p class="font-medium">{{ $pago->metodo_pago }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Fecha de Pago</p>
                        <p class="font-medium">{{ $pago->fecha_pago->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Registrado por</p>
                        <p class="font-medium">{{ $pago->user->name }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>