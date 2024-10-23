<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ad_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_name');
            $table->string('field_value');
            $table->foreignId('ad_id')->constrained()->onDelete('cascade');
            $table->string('locale')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ad_fields');
    }
};
