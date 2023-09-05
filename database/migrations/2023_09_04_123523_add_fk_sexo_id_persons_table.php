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
        Schema::table('persons', function (Blueprint $table) {
            $table->after('id', function ($table){
                $table->foreignId('sexo_id')->constrained('sexos')->onUpdate('cascade')->onDelete('cascade');

            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persons', function (Blueprint $table) {
            $table->dropForeign('persons_sexo_id_foreign');
            $table->dropColumn('sexo_id');
        });
    }
};
