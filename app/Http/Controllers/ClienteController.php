<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Membresia;
use App\Models\HistorialEliminacion;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        // Actualizar clientes vencidos automáticamente
        Cliente::where('estado', 'Activo')
            ->where('fecha_vencimiento', '<', today())
            ->update(['estado' => 'Vencido']);

        $query = Cliente::with('membresia')
            ->whereIn('estado', ['Activo', 'Vencido']);

        // Búsqueda por nombre o teléfono
        if ($request->filled('buscar')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre_completo', 'like', '%' . $request->buscar . '%')
                  ->orWhere('telefono', 'like', '%' . $request->buscar . '%');
            });
        }

        // Filtro por estado
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $clientes = $query->orderBy('nombre_completo')->paginate(15);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $membresias = Membresia::all();
        return view('clientes.create', compact('membresias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo'  => 'required|string|max:100',
            'edad'             => 'required|integer|min:1|max:120',
            'telefono'         => 'required|string|max:15|unique:clientes,telefono',
            'correo'           => 'nullable|email|max:100',
            'genero'           => 'nullable|string|max:20',
            'fecha_inscripcion'=> 'required|date',
            'membresia_id'     => 'required|exists:membresias,id',
        ]);

        $membresia = Membresia::findOrFail($request->membresia_id);
        $fechaVencimiento = \Carbon\Carbon::parse($request->fecha_inscripcion)
            ->addDays($membresia->duracion_dias);

        Cliente::create([
            'nombre_completo'   => $request->nombre_completo,
            'edad'              => $request->edad,
            'telefono'          => $request->telefono,
            'correo'            => $request->correo,
            'genero'            => $request->genero,
            'fecha_inscripcion' => $request->fecha_inscripcion,
            'fecha_vencimiento' => $fechaVencimiento,
            'estado'            => 'Activo',
            'membresia_id'      => $request->membresia_id,
        ]);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('membresia', 'pagos');
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        $membresias = Membresia::all();
        return view('clientes.edit', compact('cliente', 'membresias'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre_completo'  => 'required|string|max:100',
            'edad'             => 'required|integer|min:1|max:120',
            'telefono'         => 'required|string|max:15|unique:clientes,telefono,' . $cliente->id,
            'correo'           => 'nullable|email|max:100',
            'genero'           => 'nullable|string|max:20',
        ]);

        $cliente->update($request->only([
            'nombre_completo',
            'edad',
            'telefono',
            'correo',
            'genero',
        ]));

        return redirect()->route('clientes.show', $cliente)
            ->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Request $request, Cliente $cliente)
    {
        $request->validate([
            'motivo' => 'required|string|max:255',
        ]);

        HistorialEliminacion::create([
            'cliente_id'        => $cliente->id,
            'motivo'            => $request->motivo,
            'fecha_eliminacion' => today(),
            'eliminado_por'     => auth()->id(),
        ]);

        $cliente->update(['estado' => 'Eliminado']);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}