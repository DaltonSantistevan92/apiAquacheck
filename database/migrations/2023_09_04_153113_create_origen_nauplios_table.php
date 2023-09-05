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
        Schema::create('origen_nauplios', function (Blueprint $table) {
            $table->id();
            $table->string('nauplio',100);
            $table->string('abrv',4);
            $table->char('status',1)->default('A');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('origen_nauplios');
    }
};
