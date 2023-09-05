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
            $table->after('bact_luminiscente', function ($table){
                $table->foreignId('medios_cultivo_id')->constrained('medios_cultivos')->onUpdate('cascade')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_chequeos', function (Blueprint $table) {
            $table->dropForeign('detalle_chequeos_medios_cultivo_id_foreign');
            $table->dropColumn('medios_cultivo_id');
        });
    }
};
