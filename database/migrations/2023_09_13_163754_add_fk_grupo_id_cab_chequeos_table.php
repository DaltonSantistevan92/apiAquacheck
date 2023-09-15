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
        Schema::table('cab_chequeos', function (Blueprint $table) {
            $table->after('modulo_id', function ($table){
                $table->foreignId('grupo_id')->constrained('grupos')->onUpdate('cascade')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cab_chequeos', function (Blueprint $table) {
            $table->dropForeign('cab_chequeos_grupo_id_foreign');
            $table->dropColumn('grupo_id'); 
        });
    }
};
