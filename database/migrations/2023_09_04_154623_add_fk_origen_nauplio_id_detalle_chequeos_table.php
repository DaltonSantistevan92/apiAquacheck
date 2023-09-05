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
            $table->after('tanque_anterior', function ($table){
                $table->foreignId('origen_nauplio_id')->constrained('origen_nauplios')->onUpdate('cascade')->onDelete('cascade');

            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_chequeos', function (Blueprint $table) {
            $table->dropForeign('detalle_chequeos_origen_nauplio_id_foreign');
            $table->dropColumn('origen_nauplio_id');
        });
    }
};
