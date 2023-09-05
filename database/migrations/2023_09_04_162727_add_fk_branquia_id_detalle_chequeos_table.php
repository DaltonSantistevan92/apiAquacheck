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
            $table->after('estadio_larval_valor_id', function ($table){
                $table->foreignId('branquia_id')->constrained('branquias')->onUpdate('cascade')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalle_chequeos', function (Blueprint $table) {
            $table->dropForeign('detalle_chequeos_branquia_id_foreign');
            $table->dropColumn('branquia_id');
        });
    }
};
