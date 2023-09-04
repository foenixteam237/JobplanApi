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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fisrtName')->nullable();
            $table->date('birthDate');
            $table->string('birthPlace');
            $table->string('recruitmentDate');
            $table->string('marialStatus')->default('Célibataire');
            $table->char('sex');
            $table->string('registrationNumber')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('idRole');
            $table->unsignedBigInteger('idNationality');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
