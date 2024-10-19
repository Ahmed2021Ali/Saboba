<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending', 'reject', 'accept']);
            $table->foreignId('follower')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('following')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
