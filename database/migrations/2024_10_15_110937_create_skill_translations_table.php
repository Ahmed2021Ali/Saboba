<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('skill_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['skill_id','locale']);
            $table->foreignId('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_translations');
    }
};
