<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    // ================================
    //  MOSTRAR FORMULARIO LOGIN
    // ================================
    public function verlogin()
    {
        if (Auth::check()) {
            return redirect()->route('welcome');
        }

        return view('login');
    }

    // ================================
    //  PROCESAR LOGIN
    // ================================
    public function login(Request $request)
    {
        // Validar
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('welcome')
                ->with('success', 'Bienvenido');
        }

        // Si falla
        throw ValidationException::withMessages([
            'email' => ['Las credenciales no coinciden con nuestros registros.'],
        ]);
    }

    // ================================
    //  CERRAR SESIÓN
    // ================================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión');
    }



    // ================================
    //  MOSTRAR FORMULARIO DE REGISTRO
    // ================================
    public function verRegistro()
    {
        return view('registro');
    }


    // ================================
    //  PROCESAR REGISTRO
    // ================================
    public function registro(Request $request)
    {
        // Validar datos
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Crear usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirigir al login
        return redirect()->route('login')
            ->with('success', 'Registro exitoso, ahora puedes iniciar sesión.');
    }
}
