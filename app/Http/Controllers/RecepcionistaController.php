<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RecepcionistaController extends Controller
{
    public function index()
    {
        $recepcionistas = User::where('rol', 'recepcionista')->get();
        return view('recepcionistas.index', compact('recepcionistas'));
    }

    public function create()
    {
        return view('recepcionistas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => 'recepcionista',
        ]);

        return redirect()->route('recepcionistas.index')
            ->with('success', 'Recepcionista registrado correctamente.');
    }

    public function destroy(User $recepcionista)
    {
        $recepcionista->delete();
        return redirect()->route('recepcionistas.index')
            ->with('success', 'Recepcionista eliminado correctamente.');
    }
}