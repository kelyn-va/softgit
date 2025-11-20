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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            
            // Relación con producto
            $table->unsignedBigInteger('idProducto');
            $table->foreign('idProducto')->references('id')->on('productos')->onDelete('cascade');
            
            // Cantidad en inventario
            $table->integer('cantidad')->default(0);
            
            // Cantidad mínima para alertas
            $table->integer('cantidad_minima')->default(0);
            
            // Fecha de actualización
            $table->timestamp('fecha_actualizacion')->useCurrent();
            
            // Nota sobre movimiento
            $table->text('nota')->nullable();
            
            $table->timestamps();
            
            // Índice para búsquedas rápidas
            $table->unique('idProducto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
