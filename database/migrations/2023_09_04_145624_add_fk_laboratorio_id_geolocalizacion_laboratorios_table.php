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
        Schema::table('geolocalizacion_laboratorios', function (Blueprint $table) {
            $table->after('id', function ($table){
                $table->foreignId('laboratorio_id')->constrained('laboratorios')->onUpdate('cascade')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('geolocalizacion_laboratorios', function (Blueprint $table) {
            $table->dropForeign('geolocalizacion_laboratorios_laboratorio_id_foreign');
            $table->dropColumn('laboratorio_id');
        });
    }
};
