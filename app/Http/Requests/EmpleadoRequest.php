<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para los campos del formulario Empleado.
     */
    public function rules(): array
    {
        return [
            'nombre'      => 'required|string|max:100',
            'cargo'       => 'required|string|max:100',
            'usuario'     => 'required|string|max:50|unique:empleados,usuario',
            'contraseña'  => 'required|string|min:6',
            'idTurno'     => 'required|integer|exists:turnos,id',
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'nombre.required'      => 'El nombre es obligatorio.',
            'cargo.required'       => 'El cargo es obligatorio.',
            'usuario.required'     => 'El usuario es obligatorio.',
            'usuario.unique'       => 'Este usuario ya existe.',
            'contraseña.required'  => 'La contraseña es obligatoria.',
            'contraseña.min'       => 'La contraseña debe tener al menos 6 caracteres.',
            'idTurno.required'     => 'Debe seleccionar un turno.',
            'idTurno.exists'       => 'El turno seleccionado no es válido.',
        ];
    }
}
