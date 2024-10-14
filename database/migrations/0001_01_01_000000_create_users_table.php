<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->text('overview');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('phone')->index(); 
            $table->enum('type', ['personal', 'company', 'admin']);
            $table->bigInteger('country_id')->unsigned()->nullable()->index(); 
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade'); 
            $table->string('contact_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
