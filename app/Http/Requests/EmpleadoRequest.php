<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Nombre solo letras y espacios
            'nombre' => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/',

            // Teléfono solo números, mínimo 7 máx 15
            'telefono' => 'required|digits_between:7,15',

            // Correo único
            'correo' => 'required|email|max:100|unique:empleados,correo,' . $this->id,

            // Cargo: solo letras y espacios
            'cargo' => 'required|string|max:50|regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/',
        ];
    }

    public function messages(): array
    {
        return [
            // nombre
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string'   => 'El nombre debe ser texto.',
            'nombre.max'      => 'El nombre no puede exceder 100 caracteres.',
            'nombre.regex'    => 'El nombre solo puede contener letras y espacios.',

            // telefono
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',

            // correo
            'correo.required' => 'El correo es obligatorio.',
            'correo.email'    => 'Debe ingresar un correo válido.',
            'correo.max'      => 'El correo no debe exceder 100 caracteres.',
            'correo.unique'   => 'Este correo ya está registrado.',

            // cargo
            'cargo.required' => 'El cargo es obligatorio.',
            'cargo.string'   => 'El cargo debe ser texto.',
            'cargo.max'      => 'El cargo no puede exceder 50 caracteres.',
            'cargo.regex'    => 'El cargo solo puede contener letras y espacios.',
        ];
    }
}
