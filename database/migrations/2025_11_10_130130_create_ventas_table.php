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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->datetime('fecha');
            $table->decimal('total', 10, 2);
            
            // Información del cliente (sin tabla separada)
            $table->string('cliente_nombre', 100);
            $table->string('cliente_telefono', 15)->nullable();
            $table->string('cliente_email', 100)->nullable();
            
            // Relación con empleado
            $table->unsignedBigInteger('idempleado');
            $table->foreign('idempleado')->references('id')->on('empleados');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
