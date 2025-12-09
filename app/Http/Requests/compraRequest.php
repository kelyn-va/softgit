<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Cambia la lógica si necesitas permisos específicos.
     */
    public function authorize(): bool
    {
        return true; // o usar: return auth()->check() && auth()->user()->can('crear_compras');
    }

    /**
     * Prepara datos antes de la validación.
     * Normaliza comas en decimales, trim, y convierte tipos simples.
     */
    protected function prepareForValidation(): void
    {
        $input = $this->all();

        // Normalizar metodoPago (quita espacios)
        if (isset($input['metodoPago'])) {
            $input['metodoPago'] = trim($input['metodoPago']);
        }

        // Reemplazar coma por punto en números decimales y eliminar espacios
        foreach (['precioCompra', 'precioVenta', 'Total'] as $key) {
            if (isset($input[$key])) {
                // permitir que venga "1.234,56" o "1234,56" -> convertir coma decimal a punto
                $val = str_replace(['.', ' '], ['', ''], $input[$key]); // opcional: quitar separador miles si viene
                $val = str_replace(',', '.', $val);
                $input[$key] = $val;
            }
        }

        // Cantidad a entero (si vino como string)
        if (isset($input['Cantidad'])) {
            $input['Cantidad'] = (int) $input['Cantidad'];
        }

        $this->replace($input);
    }

    /**
     * Reglas de validación.
     * Se manejan diferencias entre create (POST) y update (PUT/PATCH).
     */
    public function rules(): array
    {
        // Valores válidos para metodoPago (sin espacios)
        $metodos_validos = ['Efectivo', 'Tarjeta', 'Transferencia'];

        // Reglas comunes
        $common = [
            'precioCompra' => ['required', 'numeric', 'min:0'],
            'precioVenta'  => ['required', 'numeric', 'min:0'],
            'Total'        => ['required', 'numeric', 'min:0'],
            'metodoPago'   => ['required', Rule::in($metodos_validos)],
            'Cantidad'     => ['required', 'integer', 'min:1'],

            // Referencias a claves foráneas: que existan en sus tablas
            'idproveedor'  => ['required', 'integer', 'exists:proveedor,id'],
            'idproducto'   => ['required', 'integer', 'exists:productos,id'],
        ];

        // Reglas específicas por método HTTP (opcional)
        if ($this->isMethod('post')) {
            // Creación
            return $common;
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Actualización: si permites campos opcionales puedes usar sometimes
            return [
                'precioCompra' => ['sometimes', 'required', 'numeric', 'min:0'],
                'precioVenta'  => ['sometimes', 'required', 'numeric', 'min:0'],
                'Total'        => ['sometimes', 'required', 'numeric', 'min:0'],
                'metodoPago'   => ['sometimes', 'required', Rule::in($metodos_validos)],
                'Cantidad'     => ['sometimes', 'required', 'integer', 'min:1'],
                'idproveedor'  => ['sometimes', 'required', 'integer', 'exists:proveedor,id'],
                'idproducto'   => ['sometimes', 'required', 'integer', 'exists:productos,id'],
            ];
        }

        // Por defecto retorna las comunes
        return $common;
    }

    /**
     * Mensajes de error personalizados (en español).
     */
    public function messages(): array
    {
        return [
            'precioCompra.required' => 'El precio de compra es obligatorio.',
            'precioCompra.numeric'  => 'El precio de compra debe ser un número válido.',
            'precioCompra.min'      => 'El precio de compra debe ser mayor o igual a :min.',

            'precioVenta.required'  => 'El precio de venta es obligatorio.',
            'precioVenta.numeric'   => 'El precio de venta debe ser un número válido.',

            'Total.required'        => 'El total es obligatorio.',
            'Total.numeric'         => 'El total debe ser un número válido.',

            'metodoPago.required'   => 'El método de pago es obligatorio.',
            'metodoPago.in'         => 'El método de pago seleccionado no es válido. Opciones válidas: Efectivo, Tarjeta, Transferencia.',

            'Cantidad.required'     => 'La cantidad es obligatoria.',
            'Cantidad.integer'      => 'La cantidad debe ser un número entero.',
            'Cantidad.min'          => 'La cantidad debe ser al menos :min.',

            'idproveedor.required'  => 'El proveedor es obligatorio.',
            'idproveedor.exists'    => 'El proveedor seleccionado no existe en la base de datos.',

            'idproducto.required'   => 'El producto es obligatorio.',
            'idproducto.exists'     => 'El producto seleccionado no existe en la base de datos.',
        ];
    }

    /**
     * Nombres legibles para los atributos (se usan en errores automáticos).
     */
    public function attributes(): array
    {
        return [
            'precioCompra' => 'precio de compra',
            'precioVenta'  => 'precio de venta',
            'Total'        => 'total',
            'metodoPago'   => 'método de pago',
            'Cantidad'     => 'cantidad',
            'idproveedor'  => 'proveedor',
            'idproducto'   => 'producto',
        ];
    }

    /**
     * Si quieres transformar datos después de la validación (opcional).
     * Por ejemplo, recalcular total si no viene y se puede derivar.
     */
    protected function passedValidation(): void
    {
        // Ejemplo: si Total no viene y quieres calcularlo:
        // if (!$this->filled('Total') && $this->filled(['precioCompra','Cantidad'])) {
        //     $total = $this->input('precioCompra') * $this->input('Cantidad');
        //     $this->merge(['Total' => $total]);
        // }
    }
}
