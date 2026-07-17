<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl gym-text-primary leading-tight">
            Inicio
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-900 border border-green-700 text-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tarjetas de estadísticas --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <div class="gym-card rounded-lg shadow p-6 border-l-4 border-blue-500">
                    <p class="text-sm gym-text-secondary">Total Clientes</p>
                    <p class="text-3xl font-bold gym-text-primary">{{ $totalClientes }}</p>
                </div>

                <div class="gym-card rounded-lg shadow p-6 border-l-4 border-green-500">
                    <p class="text-sm gym-text-secondary">Clientes Activos</p>
                    <p class="text-3xl font-bold text-green-400">{{ $totalActivos }}</p>
                </div>

                <div class="gym-card rounded-lg shadow p-6 border-l-4 border-red-500">
                    <p class="text-sm gym-text-secondary">Membresías Vencidas</p>
                    <p class="text-3xl font-bold text-red-400">{{ $totalVencidos }}</p>
                </div>

                <div class="gym-card rounded-lg shadow p-6 border-l-4 border-slate-500">
                    <p class="text-sm gym-text-secondary">Ingresos del Mes</p>
                    <p class="text-3xl font-bold gym-text-primary">${{ number_format($pagosMes, 2) }}</p>
                </div>

            </div>

            {{-- Accesos rápidos --}}
            <div class="gym-card rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-300 mb-4">Accesos Rápidos</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('clientes.create') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition font-medium">
                        + Nuevo Cliente
                    </a>
                    <a href="{{ route('pagos.create') }}"
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition font-medium">
                        + Registrar Pago
                    </a>
                    <a href="{{ route('clientes.index') }}?estado=Vencido"
                       class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition font-medium">
                        Ver Vencidos
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>