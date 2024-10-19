<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ads_updates', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('ad_id')->constrained('ads')->onDelete('cascade'); 
            $table->decimal('price')->nullable(); 
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null'); 
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->string('locale')->nullable(); 
            $table->string('name')->nullable(); 
            $table->string('description')->nullable(); 
            $table->boolean('status')->default(0);
            $table->timestamps(); 
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('ads_updates');
    }
};
