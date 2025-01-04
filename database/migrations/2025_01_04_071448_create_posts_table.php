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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // BIGINT (Primary Key)
            $table->text('body'); // 本文
            $table->foreignId('user_id')->constrained(); // 外部キー: usersテーブルのidを参照
            $table->text('image_at')->nullable(); // 画像情報
            $table->string('image_path')->nullable(); // 画像のパスを格納
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
