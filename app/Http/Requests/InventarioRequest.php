<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarioRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para los campos del inventario.
     */
    public function rules(): array
    {
        return [
            'Cantidad' => 'required|integer|min:0',
            'FechaActualizacion' => 'required|date',
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'Cantidad.required' => 'La cantidad es obligatoria.',
            'Cantidad.integer' => 'La cantidad debe ser un número entero.',
            'Cantidad.min' => 'La cantidad no puede ser negativa.',
            'FechaActualizacion.required' => 'La fecha de actualización es obligatoria.',
            'FechaActualizacion.date' => 'La fecha de actualización debe tener un formato válido.',
        ];
    }
}
