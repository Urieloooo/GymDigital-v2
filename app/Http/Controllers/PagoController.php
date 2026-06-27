<?php
namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Membresia;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        $pagos = Pago::with('cliente', 'membresia', 'user')
            ->orderBy('fecha_pago', 'desc')
            ->paginate(15);

        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        $clientes   = Cliente::where('estado', 'Activo')
                        ->orderBy('nombre_completo')
                        ->get();
        $membresias = Membresia::all();

        return view('pagos.create', compact('clientes', 'membresias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'membresia_id' => 'required|exists:membresias,id',
            'monto'        => 'required|numeric|min:0',
            'metodo_pago'  => 'required|in:Efectivo,Transferencia',
            'fecha_pago'   => 'required|date',
        ]);

        $membresia = Membresia::findOrFail($request->membresia_id);
        $cliente   = Cliente::findOrFail($request->cliente_id);

        Pago::create([
            'cliente_id'   => $request->cliente_id,
            'user_id'      => auth()->id(),
            'membresia_id' => $request->membresia_id,
            'monto'        => $request->monto,
            'metodo_pago'  => $request->metodo_pago,
            'fecha_pago'   => $request->fecha_pago,
        ]);

        // Actualizar membresía y fecha de vencimiento del cliente
        $nuevaFecha = \Carbon\Carbon::parse($request->fecha_pago)
            ->addDays($membresia->duracion_dias);

        $cliente->update([
            'membresia_id'      => $request->membresia_id,
            'fecha_vencimiento' => $nuevaFecha,
            'estado'            => 'Activo',
        ]);

        return redirect()->route('pagos.index')
            ->with('success', 'Pago registrado correctamente.');
    }

    public function show(Pago $pago)
    {
        $pago->load('cliente', 'membresia', 'user');
        return view('pagos.show', compact('pago'));
    }
}