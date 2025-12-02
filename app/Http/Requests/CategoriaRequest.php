<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado a hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true; // Permitir que la validación se ejecute
    }

    /**
     * Reglas de validación para el campo 'nombre'.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
           
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string'   => 'El nombre debe ser texto.',
            'nombre.max'      => 'El nombre no puede exceder los 100 caracteres.',
            'nombre.unique'   => 'Este nombre ya está registrado.',
            'nombre.regex'    => 'El nombre solo puede contener letras y espacios, no se permiten números.',

            
        ];
    }
}
