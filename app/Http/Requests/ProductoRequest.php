<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'codigoBarras' => 'required|string|max:50|unique:productos,codigoBarras,' . $this->route('producto'),
            'idCategoria' => 'required|exists:categorias,id',
            'idproveedor' => 'required|exists:proveedores,id_proveedor',
            'idInventario' => 'required|exists:inventarios,id_inventario',
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'codigoBarras.required' => 'El código de barras es obligatorio.',
            'codigoBarras.unique' => 'Este código de barras ya está registrado.',
            'idCategoria.required' => 'Debes seleccionar una categoría.',
            'idCategoria.exists' => 'La categoría seleccionada no existe.',
            'idproveedor.required' => 'Debes seleccionar un proveedor.',
            'idproveedor.exists' => 'El proveedor seleccionado no existe.',
            'idInventario.required' => 'Debes asociar un inventario.',
            'idInventario.exists' => 'El inventario seleccionado no existe.',
        ];
    }
}