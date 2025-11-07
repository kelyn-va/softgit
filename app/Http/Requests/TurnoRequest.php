<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurnoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitir la validación para todos los usuarios
    }

    /**
     * Reglas de validación para los campos del formulario.
     */
    public function rules(): array
    {
        return [
            'InicioTurno' => 'required|date|',
            'FinTurno' => 'required|date|after:InicioTurno',
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'InicioTurno.required' => 'El campo "Inicio de turno" es obligatorio.',
            'InicioTurno.date_format' => 'El formato del inicio de turno debe ser YYYY-MM-DD HH:MM (por ejemplo, 2025-11-07 08:00).',

            'FinTurno.required' => 'El campo "Fin de turno" es obligatorio.',
            'FinTurno.date_format' => 'El formato del fin de turno debe ser YYYY-MM-DD HH:MM (por ejemplo, 2025-11-07 17:00).',
            'FinTurno.after' => 'El fin del turno debe ser posterior al inicio del turno.',
        ];
    }
}
