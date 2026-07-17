<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pagos</h2>
            <a href="{{ route('pagos.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                + Registrar Pago
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

            <div class="rounded-lg shadow overflow-hidden" style="background-color: #16213e; border: 1px solid #0f3460;">
                <table class="w-full" style="border-collapse: collapse; width: 100%;">
                    <thead style="background-color: #0f3460;">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Membresía</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Monto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Método</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Registrado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pagos as $pago)
                            <tr style="border-top: 1px solid #0f3460;" onmouseover="this.style.backgroundColor='#0f3460'" onmouseout="this.style.backgroundColor='transparent'">
                                <td class="px-6 py-4 text-sm font-medium">
                                    <a href="{{ route('clientes.show', $pago->cliente) }}" style="color: #63b3ed;" class="hover:underline">
                                        {{ $pago->cliente->nombre_completo }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm" style="color: #e2e8f0;">{{ $pago->membresia->nombre }}</td>
                                <td class="px-6 py-4 text-sm font-medium" style="color: #ffffff;">${{ number_format($pago->monto, 2) }}</td>
                                <td class="px-6 py-4 text-sm" style="color: #e2e8f0;">{{ $pago->metodo_pago }}</td>
                                <td class="px-6 py-4 text-sm" style="color: #e2e8f0;">{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm" style="color: #e2e8f0;">{{ $pago->user->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center" style="color: #718096;">No hay pagos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    {{ $pagos->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>