<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('country_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->string('locale'); // اللغة
            $table->string('name'); // اسم الدولة
            $table->timestamps();

            $table->unique(['country_id', 'locale']); // التأكد من عدم وجود تكرار للغة لنفس الدولة
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('country_translations');
    }
};
