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
        Schema::create('chequeo_tanques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cab_chequeo_id');
            $table->foreign('cab_chequeo_id')->references('id')->on('cab_chequeos')->onDelete('cascade');
            $table->string('num_tanque',25);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chequeo_tanques', function (Blueprint $table) {
            $table->dropForeign(['cab_chequeo_id']);
        });
        Schema::dropIfExists('chequeo_tanques');
    }
};
