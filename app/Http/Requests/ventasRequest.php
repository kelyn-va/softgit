<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVentaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para la solicitud.
     */
    public function rules(): array
    {
        return [
            'fecha' => ['required', 'date'],
            'total' => ['required', 'numeric', 'min:0'],
            'idCliente' => ['required', 'exists:clientes,id'],
            'idempleado' => ['required', 'exists:empleados,id'],
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'fecha.required' => 'La fecha de la venta es obligatoria.',
            'fecha.date' => 'El campo fecha debe ser una fecha válida.',
            'total.required' => 'El total de la venta es obligatorio.',
            'total.numeric' => 'El total debe ser un número.',
            'total.min' => 'El total no puede ser negativo.',
            'idCliente.required' => 'Debe seleccionar un cliente.',
            'idCliente.exists' => 'El cliente seleccionado no existe.',
            'idempleado.required' => 'Debe seleccionar un empleado.',
            'idempleado.exists' => 'El empleado seleccionado no existe.',
        ];
    }
}
