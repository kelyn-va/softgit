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
        Schema::table('clientes', function (Blueprint $table) {
            // Cambia la columna Direccion a tipo TEXT y la hace nullable
            $table->text('Direccion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table) {
            // Revierte el cambio: vuelve a VARCHAR(100) y no permite nulos
            $table->string('Direccion', 100)->nullable(false)->change();
        });
    }
};
