<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuditoriaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        // Permitir todas las solicitudes (ajusta según tus políticas)
        return true;
    }

    /**
     * Reglas de validación para los campos del formulario.
     */
    public function rules(): array
    {
        return [
            'Accion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'cierreCaja' => 'required|string|max:255',
            'idEmpleado' => 'required|exists:empleados,idEmpleado',
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'Accion.required' => 'La acción es obligatoria.',
            'Accion.string' => 'La acción debe ser un texto.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe tener un formato válido.',
            'cierreCaja.string' => 'El campo cierre de caja debe ser texto.',
            'idEmpleado.required' => 'Debe seleccionar un empleado.',
            'idEmpleado.exists' => 'El empleado seleccionado no existe en el sistema.',
        ];
    }
}

