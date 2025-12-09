<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación
     */
    public function rules(): array
    {
        return [
            'nombre'       => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/',
            'descripcion'  => 'nullable|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',

            // Relaciones
            'idCategoria'  => 'required|exists:categorias,id',
            'idProveedor'  => 'required|exists:proveedor,id',
        ];
    }

    /**
     * Mensajes personalizados
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string'   => 'El nombre debe ser un texto válido.',
            'nombre.max'      => 'El nombre no puede superar los 100 caracteres.',
            'nombre.regex'    => 'El nombre no puede contener números ni símbolos.',

            'descripcion.string' => 'La descripción debe ser un texto.',
            'descripcion.max'    => 'La descripción no puede superar los 255 caracteres.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric'  => 'El precio debe ser un valor numérico.',
            'precio.min'      => 'El precio no puede ser negativo.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer'  => 'El stock debe ser un número entero.',
            'stock.min'      => 'El stock no puede ser negativo.',

            'idCategoria.required' => 'Debe seleccionar una categoría.',
            'idCategoria.exists'   => 'La categoría seleccionada no existe.',

            'idProveedor.required' => 'Debe seleccionar un proveedor.',
            'idProveedor.exists'   => 'El proveedor seleccionado no existe.',
        ];
    }
}
