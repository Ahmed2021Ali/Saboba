<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('locale'); // اللغة مثل en, ar
            $table->string('name')->nullable();
            $table->text('overview')->nullable();
            $table->unique(['user_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_translations');
    }
};
