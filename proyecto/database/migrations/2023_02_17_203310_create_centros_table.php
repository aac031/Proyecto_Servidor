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
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('razon_social');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('nif');
            $table->enum('tipo', ['peluqueria', 'estetica']);
            $table->integer('capacidad_maxima')->nullable()->default(null);
            $table->boolean('unisex')->nullable()->default(null);
            $table->integer('numero_salas')->nullable()->default(null);
            $table->boolean('servicio_fisioterapia')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros');
    }
};
