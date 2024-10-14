<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('university');
            $table->string('specialization');
            $table->string('university');
            $table->string('end_date');
            $table->enum('employment_type', ['phd', 'master', 'without_certificate', 'diploma', 'college_student', 'high_school', 'grade_school']);
            $table->string('end_date');
            $table->string('start_date');
            $table->foreignId('job_profile_id')->references('id')->on('job_profiles')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
