<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetodoPagoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para los campos del formulario.
     */
    public function rules(): array
    {
        return [
            'descripcion' => 'required|string|max:100|unique:metodo_pagos,descripcion,' . $this->route('id'),
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'descripcion.required' => 'La descripción del método de pago es obligatoria.',
            'descripcion.string' => 'La descripción debe ser un texto válido.',
            'descripcion.max' => 'La descripción no debe superar los 100 caracteres.',
            'descripcion.unique' => 'Este método de pago ya existe.',
        ];
    }
}
