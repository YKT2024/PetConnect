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
            $table->string('body'); 
            $table->unsignedBigInteger('user_id'); //ユーザーID(外部キー)
            $table->unsignedBigInteger('post_id'); //投稿ID(外部キー)
            $table->unsignedBigInteger('shelter_id'); //避難所ID(外部キー)
            $table->unsignedBigInteger('stray_id'); //迷子ID(外部キー)
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
