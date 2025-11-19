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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table ->decimal('monto', 10, 2);
            $table->timestamps();
            $table->unsignedBigInteger('idventa');
            $table->foreign('idventa')->references('id')->on('ventas');
            $table->unsignedBigInteger('idmetodopagos');
            $table ->foreign('idmetodopagos')->references('id')->on('metodo_pagos');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
