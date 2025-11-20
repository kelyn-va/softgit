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
        Schema::create('devolucions', function (Blueprint $table) {
            $table->id();
            
            // Relación con la venta original
            $table->unsignedBigInteger('idventa');
            $table->foreign('idventa')->references('id')->on('ventas')->onDelete('cascade');
            
            // Cantidad devuelta
            $table->integer('cantidad');
            
            // Motivo de la devolución
            $table->string('motivo')->nullable();
            
            // Fecha de devolución
            $table->datetime('fecha_devolucion');
            
            // Estado de la devolución
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada'])->default('pendiente');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devolucions');
    }
};
