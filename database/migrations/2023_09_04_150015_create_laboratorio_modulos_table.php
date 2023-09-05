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
        Schema::create('laboratorio_modulos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('laboratorio_id');
            $table->foreign('laboratorio_id')->references('id')->on('laboratorios')->onDelete('cascade');

            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laboratorio_modulos', function (Blueprint $table) {
            // Eliminar las claves foráneas
            $table->dropForeign(['laboratorio_id']);
            $table->dropForeign(['modulo_id']);
        });

        Schema::dropIfExists('laboratorio_modulos');
    }
};
