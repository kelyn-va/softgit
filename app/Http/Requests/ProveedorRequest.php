<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
        'nombre'   => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/',
        'contacto' => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/',
        'telefono' => 'required|regex:/^[0-9]{10}$/',
        'direccion'=> 'required|string|max:150',
    ];
    }

    /**
     * Mensajes personalizados de validación.
     */
    public function messages(): array
    {
        return [
             // Nombre
            'nombre.required' => 'El nombre del proveedor es obligatorio.',
            'nombre.required'   => 'El nombre debe ser una cadena de texto.',
            'nombre.max'      => 'El nombre no puede tener más de 100 caracteres.',
            'nombre.regex'    => 'El nombre solo puede contener letras y espacios.',

            // Contacto
            'contacto.required' => 'El contacto debe ser texto.',
            'contacto.max'    => 'El contacto no puede tener más de 100 caracteres.',
            'contacto.regex'  => 'El contacto solo puede contener letras y espacios.',

            // Teléfono
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex'    => 'El teléfono debe tener exactamente 10 dígitos y solo números.',

            // Dirección
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.string'   => 'La dirección debe ser texto.',
            'direccion.max'      => 'La dirección no puede tener más de 150 caracteres.',
        ];
    }
}
