<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Mensajes de éxito --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tarjetas de estadísticas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <p class="text-sm text-gray-500">Total Clientes</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalClientes }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Clientes Activos</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalActivos }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
                    <p class="text-sm text-gray-500">Membresías Vencidas</p>
                    <p class="text-3xl font-bold text-red-600">{{ $totalVencidos }}</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6 border-l-4 border-gray-500">
                    <p class="text-sm text-gray-500">Ingresos del Mes</p>
                    <p class="text-3xl font-bold text-gray-800">${{ number_format($pagosMes, 2) }}</p>
                </div>

            </div>

            {{-- Accesos rápidos --}}
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Accesos Rápidos</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('clientes.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        + Nuevo Cliente
                    </a>
                    <a href="{{ route('pagos.create') }}"
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        + Registrar Pago
                    </a>
                    <a href="{{ route('clientes.index') }}?estado=Vencido"
                       class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                        Ver Vencidos
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>