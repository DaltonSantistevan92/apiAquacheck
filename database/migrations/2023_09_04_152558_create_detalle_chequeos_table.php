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
        Schema::create('detalle_chequeos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cab_chequeo_id');
            $table->foreign('cab_chequeo_id')->references('id')->on('cab_chequeos')->onDelete('cascade');

            $table->string('tanque_anterior',20)->nullable();//transferencia tq#
            $table->string('cantidad_sembrada',50);//cantidad bruta sembrada
            $table->integer('tq_capacidad_tn')->unsigned()->default(0);//capacidad total tn
            $table->integer('nivel_actual_tn')->unsigned()->default(0);
            $table->string('poblacion_actual',50);
            $table->double('larvas_por_litros');
            $table->integer('dias_de_cultivo')->unsigned()->default(0);
            $table->integer('dias_de_post_larva')->unsigned()->default(0);

            $table->integer('pl_gr')->unsigned()->default(0);
            $table->integer('uniformidad')->unsigned()->default(0);
            $table->string('larvas_azuladas',25)->nullable();
            $table->string('bact_luminiscente',25)->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_chequeos', function (Blueprint $table) {
            $table->dropForeign(['cab_chequeo_id']);
        });
        Schema::dropIfExists('detalle_chequeos');
    }
};
