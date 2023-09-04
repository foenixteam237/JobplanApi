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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->boolean('isSeen');
            $table->unsignedBigInteger('idSender');
            $table->unsignedBigInteger('idReceiver');
            $table->timestamps();

            $table->foreign('idSender')->references('id')->on('users');
            $table->foreign('idReceiver')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
