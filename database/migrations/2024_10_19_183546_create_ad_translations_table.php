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
        Schema::create('ad_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->unsigned(); // Define the foreign key without constraints
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade'); 
            $table->string('locale')->index();
            $table->string('name'); 
            $table->string('description'); 
            $table->timestamps();

            $table->unique(['ad_id', 'locale']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_translations');
    }
};
