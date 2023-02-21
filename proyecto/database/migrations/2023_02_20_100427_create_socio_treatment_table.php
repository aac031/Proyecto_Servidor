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
        Schema::create('socio_treatment', function (Blueprint $table) {
            $table->id()->autoIncrement();;
            $table->unsignedBigInteger('socio_id');
            $table->unsignedBigInteger('treatment_id');
            $table->date('fecha_tratamiento');
            $table->timestamps();

            $table->foreign('socio_id')->references('id')->on('socios')->onDelete('cascade');
            $table->foreign('treatment_id')->references('id')->on('treatments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socio_treatment');
    }
};
