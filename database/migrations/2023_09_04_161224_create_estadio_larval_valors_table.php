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
        Schema::create('estadio_larval_valors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estadio_larval_id');
            $table->foreign('estadio_larval_id')->references('id')->on('estadio_larvals')->onDelete('cascade');

            $table->unsignedBigInteger('valor_crecimiento_id');
            $table->foreign('valor_crecimiento_id')->references('id')->on('valor_crecimientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estadio_larval_valors', function (Blueprint $table) {
            // Eliminar las claves foráneas
            $table->dropForeign(['estadio_larval_id']);
            $table->dropForeign(['valor_crecimiento_id']);
        });
        Schema::dropIfExists('estadio_larval_valors');
    }
};
