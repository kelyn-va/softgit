<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
             $table->decimal('precioCompra');
            $table->decimal('precioVenta');
            $table->decimal('Total', 12, 2);
            $table->enum('metodoPago', ['Efectivo', 'Tarjeta ', 'Transferencia', ]);            
            $table->integer('Cantidad');
            
            $table->unsignedBigInteger('idproveedor');
            $table->foreign('idproveedor')->references('id')->on('proveedor');
            
            $table->unsignedBigInteger('idproducto');
            $table->foreign('idproducto')->references('id')->on('productos');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
