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
        Schema::create('city_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('locale')->index(); // اللغة الخاصة بالترجمة (مثل ar, en)
            $table->string('name'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('city_translations');
    }
};
