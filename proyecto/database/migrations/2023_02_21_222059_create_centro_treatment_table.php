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
        Schema::create('centro_treatment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centro_id');
            $table->unsignedBigInteger('treatment_id');
            $table->timestamps();

            $table->foreign('centro_id')->references('id')->on('centros');
            $table->foreign('treatment_id')->references('id')->on('treatments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('centro_treatment', function (Blueprint $table) {
            $table->dropForeign(['centro_id']);
            $table->dropForeign(['treatment_id']);
        });
    }
};
