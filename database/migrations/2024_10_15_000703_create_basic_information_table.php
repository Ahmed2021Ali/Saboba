<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('basic_information', function (Blueprint $table) {
            $table->id();
            $table->string('nationality');
            $table->enum('gender', ['male', 'female']);
            $table->string('age');
            $table->string('job_title');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('basic_information');
    }
};
