<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición.
     */
    public function authorize(): bool
    {
        return true; // Cambia a true para permitir el uso del request
    }

    /**
     * Reglas de validación para los campos del formulario.
     */
    public function rules(): array
    {
        return [
            'Nombre'    => 'required|string|max:255',
            'Telefono'  => 'required|string|max:20',
            'Email'     => 'required|email|unique:clientes,Email',
            'Direccion' => 'required|string|max:255',
        ];
    }

    /**
     * Mensajes personalizados de error (opcional).
     */
    public function messages(): array
    {
        return [
            'Nombre.required'   => 'El nombre del cliente es obligatorio.',
            'Nombre.string'     => 'El nombre debe ser un texto válido.',
            'Email.required'    => 'El correo electrónico es obligatorio.',
            'Email.email'       => 'Debe ingresar un correo electrónico válido.',
            'Email.unique'      => 'Este correo ya está registrado.',
            'Telefono.required'   => 'El telefono del cliente es obligatorio.',
            'Telefono.max'      => 'El teléfono no puede tener más de 20 caracteres.',
            'Direccion.required'   => 'la Direccion del cliente es obligatoria.',
        ];
    }
}
