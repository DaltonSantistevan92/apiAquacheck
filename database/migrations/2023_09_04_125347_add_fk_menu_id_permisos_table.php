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
        Schema::table('permisos', function (Blueprint $table) {
            $table->after('id', function ($table){
                $table->foreignId('menu_id')->constrained('menus')->onUpdate('cascade')->onDelete('cascade');

            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permisos', function (Blueprint $table) {
            $table->dropForeign('permisos_menu_id_foreign');
            $table->dropColumn('menu_id');
        });
    }
};
