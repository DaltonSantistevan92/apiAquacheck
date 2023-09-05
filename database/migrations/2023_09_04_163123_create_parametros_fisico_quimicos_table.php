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
        Schema::create('parametros_fisico_quimicos', function (Blueprint $table) {
            $table->id();
           
            $table->unsignedBigInteger('cab_chequeo_id');
            $table->foreign('cab_chequeo_id')->references('id')->on('cab_chequeos')->onDelete('cascade');
            
            $table->double('temperatura');
            $table->double('salinidad');
            $table->double('alcalinidad');
            $table->double('ph');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_chequeos', function (Blueprint $table) {
            // Eliminar las claves foráneas
            // $table->dropForeign(['chequeo_tanque_id']);
            $table->dropForeign(['cab_chequeo_id']);

        });
        Schema::dropIfExists('parametros_fisico_quimicos');
    }
};
