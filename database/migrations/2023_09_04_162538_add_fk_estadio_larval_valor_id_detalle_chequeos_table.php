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
        Schema::table('detalle_chequeos', function (Blueprint $table) {
            $table->after('dias_de_cultivo', function ($table){
                $table->foreignId('estadio_larval_valor_id')->constrained('estadio_larval_valors')->onUpdate('cascade')->onDelete('cascade');

            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_chequeos', function (Blueprint $table) {
            $table->dropForeign('detalle_chequeos_estadio_larval_valor_id_foreign');
            $table->dropColumn('estadio_larval_valor_id');
        });
    }
};
