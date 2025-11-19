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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio', 10,2);
            $table->integer('stock');
            $table->string('codigoBarras');
            $table->unsignedBigInteger('idCategoria');
            $table->foreign('idCategoria')->references('id')->on('categorias');
            $table->unsignedBigInteger('idProveedor');
            $table->foreign('idProveedor')->references('id')->on('proveedor');
            $table->unsignedBigInteger('idInventario');
            $table->foreign('idInventario')->references('id')->on('inventario');

            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};