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
        // Validación estricta para asegurar que el correo sea exclusivamente de Gmail, Hotmail u Outlook
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => [
                'required',
                'email:rfc',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $domain = strtolower(substr(strrchr($value, "@"), 1));
                        $dominiosPermitidos = ['gmail.com', 'hotmail.com', 'outlook.com', 'live.com'];
                        if (!in_array($domain, $dominiosPermitidos)) {
                            $fail('Solo se permiten correos de Gmail, Hotmail u Outlook (ej. @gmail.com, @hotmail.com).');
                        }
                    }
                },
            ],
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email'    => 'El formato del correo es inválido.',
            'email.unique'   => 'Este correo electrónico ya está registrado para otro usuario o recepcionista.',
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