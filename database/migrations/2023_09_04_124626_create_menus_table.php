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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('id_seccion')->unsigned()->default(0); //unsigned valores positivos
            $table->string('menu',100)->unique();
            $table->string('url',100)->nullable();  //valor desconocido, indefinido o no inicializado
            $table->string('icono', 50)->nullable(); //valor desconocido, indefinido o no inicializado
            $table->integer('posicion')->unsigned()->default(0); //unsiggned valores positivos
            $table->char('status',1)->default('A');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
