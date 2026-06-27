<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pago;

class DashboardController extends Controller
{
    public function index()
    {
        // Actualizar clientes vencidos automáticamente
        Cliente::where('estado', 'Activo')
            ->where('fecha_vencimiento', '<', today())
            ->update(['estado' => 'Vencido']);

        $totalActivos  = Cliente::where('estado', 'Activo')->count();
        $totalVencidos = Cliente::where('estado', 'Vencido')->count();
        $totalClientes = Cliente::whereIn('estado', ['Activo', 'Vencido'])->count();
        $pagosMes      = Pago::whereMonth('fecha_pago', now()->month)
                             ->whereYear('fecha_pago', now()->year)
                             ->sum('monto');

        return view('dashboard', compact(
            'totalActivos',
            'totalVencidos',
            'totalClientes',
            'pagosMes'
        ));
    }
}