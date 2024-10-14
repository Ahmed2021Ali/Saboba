<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('company_name');
            $table->string('description');
            $table->enum('employment_type', ['temporary', 'full_time', 'part_time', 'contract']);
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('status');
            $table->foreignId('job_profile_id')->references('id')->on('job_profiles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
