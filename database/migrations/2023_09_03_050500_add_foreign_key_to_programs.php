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
        Schema::table('programs', function (Blueprint $table) {
            //
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('idPlanning')->references('id')->on('plannings');
            $table->foreign('idDay')->references('id')->on('days');
            $table->foreign('idHour')->references('id')->on('hours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            //
        });
    }
};
