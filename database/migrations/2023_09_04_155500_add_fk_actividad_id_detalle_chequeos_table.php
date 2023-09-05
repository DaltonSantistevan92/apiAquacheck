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
            $table->after('origen_nauplio_id', function ($table){
                $table->foreignId('actividad_id')->constrained('actividads')->onUpdate('cascade')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_chequeos', function (Blueprint $table) {
            $table->dropForeign('detalle_chequeos_actividad_id_foreign');
            $table->dropColumn('actividad_id');
        });
    }
};
