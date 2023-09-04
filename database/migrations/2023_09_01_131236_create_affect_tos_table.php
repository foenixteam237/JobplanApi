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
        Schema::create('affect_tos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idWorkplace');
            $table->unsignedBigInteger('idUser');

            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idWorkplace')->references('id')->on('workplaces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affect_tos');
    }
};
