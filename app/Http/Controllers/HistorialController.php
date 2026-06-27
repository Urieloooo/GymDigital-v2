<?php
namespace App\Http\Controllers;

use App\Models\HistorialEliminacion;

class HistorialController extends Controller
{
    public function index()
    {
        $historial = HistorialEliminacion::with('cliente', 'eliminadoPor')
            ->orderBy('fecha_eliminacion', 'desc')
            ->paginate(15);

        return view('historial.index', compact('historial'));
    }
}