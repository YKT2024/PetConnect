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
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('post_id')->nullable()->change(); // 投稿IDをnullableに変更
            $table->foreignId('shelter_id')->nullable()->change(); // 避難所IDをnullableに変更
            $table->foreignId('stray_id')->nullable()->change(); // 迷子IDをnullableに変更
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('post_id')->nullable(false)->change(); // 元に戻す
            $table->foreignId('shelter_id')->nullable(false)->change(); // 元に戻す
            $table->foreignId('stray_id')->nullable(false)->change(); // 元に戻す
        });
    }
};
