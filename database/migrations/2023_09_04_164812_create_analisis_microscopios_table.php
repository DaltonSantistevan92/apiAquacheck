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
        Schema::create('analisis_microscopios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cab_chequeo_id');
            $table->foreign('cab_chequeo_id')->references('id')->on('cab_chequeos')->onDelete('cascade');

            $table->unsignedBigInteger('dieta_id');
            $table->after('chequeo_tanque_id', function ($table){
                $table->foreign('dieta_id')->references('id')->on('dietas')->onDelete('cascade');
            });
            
            $table->unsignedBigInteger('alimentacion_id');
            $table->after('dieta_id', function ($table){
                $table->foreign('alimentacion_id')->references('id')->on('alimentacions')->onDelete('cascade');
            });

            $table->unsignedBigInteger('lipido_id');
            $table->after('alimentacion_id', function ($table){
                $table->foreign('lipido_id')->references('id')->on('lipidos')->onDelete('cascade');
            });

            $table->double('semillenas');

            $table->unsignedBigInteger('musculo_id');
            $table->after('estres', function ($table){
                $table->foreign('musculo_id')->references('id')->on('musculos')->onDelete('cascade');
            });

            $table->double('opacidad');
            $table->double('necrosis');
            $table->double('flacidez');
            $table->string('estres',25);
            $table->double('bacteria_filamentosas');
            $table->double('protozoos');
            $table->double('hongos');
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
            $table->dropForeign(['dieta_id']);
            $table->dropForeign(['alimentacion_id']);
            $table->dropForeign(['lipido_id']);
            $table->dropForeign(['musculo_id']);
        });
        
        Schema::dropIfExists('analisis_microscopios');
    }
};
