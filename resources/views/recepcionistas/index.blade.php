<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight" style="color: #e2e8f0;">Recepcionistas</h2>
            <a href="{{ route('recepcionistas.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Nuevo Recepcionista
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-lg shadow overflow-hidden" style="background-color: #16213e; border: 1px solid #0f3460;">
                <table class="w-full" style="border-collapse: collapse; width: 100%;">
                    <thead style="background-color: #0f3460;">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Correo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase" style="color: #a0aec0;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recepcionistas as $recepcionista)
                            <tr style="border-top: 1px solid #0f3460;" onmouseover="this.style.backgroundColor='#0f3460'" onmouseout="this.style.backgroundColor='transparent'">
                                <td class="px-6 py-4 text-sm font-medium" style="color: #ffffff;">{{ $recepcionista->name }}</td>
                                <td class="px-6 py-4 text-sm" style="color: #e2e8f0;">{{ $recepcionista->email }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <form method="POST" action="{{ route('recepcionistas.destroy', $recepcionista) }}"
                                          onsubmit="return confirm('¿Eliminar este recepcionista?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-xs">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center" style="color: #718096;">No hay recepcionistas registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>