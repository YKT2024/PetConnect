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
            $table->text('body'); 
            $table->foreignId('user_id')->constrained(); //ユーザーID(外部キー)
            $table->foreignId('post_id')->constrained(); //投稿ID(外部キー)
            $table->foreignId('shelter_id')->constrained(); //避難所ID(外部キー)
            $table->foreignId('stray_id')->constrained(); //迷子ID(外部キー)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
