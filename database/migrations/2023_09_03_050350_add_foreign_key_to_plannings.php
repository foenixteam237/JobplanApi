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
        Schema::table('plannings', function (Blueprint $table) {
            //
            $table->foreign('idMonth')->references('id')->on('months');
            $table->foreign('by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plannings', function (Blueprint $table) {
            //
        });
    }
};
