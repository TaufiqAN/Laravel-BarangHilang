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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); 
            $table->text('komen');
            $table->string('nama');
            $table->string('kelas');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();        
            $table->integer('rating')->nullable();
            $table->integer('likes')->default(0);
            $table->timestamps();
        });

        Schema::create('comment_user_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('comment_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_user_likes');
        Schema::dropIfExists('comments');
    }
};
