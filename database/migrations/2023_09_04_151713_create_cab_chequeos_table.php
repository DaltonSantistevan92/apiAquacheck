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
        Schema::create('cab_chequeos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('laboratorio_id');
            $table->foreign('laboratorio_id')->references('id')->on('laboratorios')->onDelete('cascade');
            
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelete('cascade');

            $table->string('cantidad_reservada',50);
            // $table->string('fecha_siembra',50);
            $table->date('fecha_siembra_first');
            $table->date('fecha_siembra_second');
            $table->date('fecha_siembra_third')->nullable();

            $table->string('maduraciones',100);
            $table->integer('chequeo')->unsigned()->default(0);
            $table->text('observacion_recomendacion')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->char('finalizado',1)->default('N');
            $table->integer('corrida')->unsigned()->nullable();
            $table->char('status',1)->default('A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cab_chequeos', function (Blueprint $table) {
            // Eliminar las claves foráneas
            $table->dropForeign(['user_id']);
            $table->dropForeign(['laboratorio_id']);
            $table->dropForeign(['modulo_id']);
        });
        Schema::dropIfExists('cab_chequeos');
    }
};
