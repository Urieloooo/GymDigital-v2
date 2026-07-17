<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #e2e8f0;">Historial de Eliminaciones</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="rounded-lg shadow overflow-hidden" style="background-color: #16213e; border: 1px solid #0f3460;">
                  <table class="w-full" style="border-collapse: collapse; width: 100%;">
                    <thead style="background-color: #0f3460;">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Motivo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Eliminado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($historial as $registro)
                            <tr style="border-top: 1px solid #0f3460;" onmouseover="this.style.backgroundColor='#0f3460'" onmouseout="this.style.backgroundColor='transparent'">
                                <td class="px-6 py-4 text-sm font-medium" style="color: #ffffff;">
                                    {{ $registro->cliente->nombre_completo }}
                                </td>
                                <td class="px-6 py-4 text-sm" style="color: #e2e8f0;">{{ $registro->motivo }}</td>
                                <td class="px-6 py-4 text-sm" style="color: #e2e8f0;">{{ $registro->fecha_eliminacion->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-sm" style="color: #e2e8f0;">{{ $registro->eliminadoPor->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center" style="color: #718096;">No hay registros de eliminaciones.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4">
                    {{ $historial->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>