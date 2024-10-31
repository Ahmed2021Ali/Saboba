<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('block_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->foreignId('blocked_by_user_id')->constrained('users')->onDelete('cascade');
            $table->date('blocked_at')->nullable();

            $table->foreignId('unlocked_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->date('unblocked_at')->nullable();

            $table->text('reason')->nullable();

         //   $table->timestamps();


        });
    }


    public function down(): void
    {
        Schema::dropIfExists('block_users');
    }
};
