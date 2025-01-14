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
        Schema::create('strays', function (Blueprint $table) {
            $table->id();
            $table->text('body'); //備考欄
            $table->foreignId('area_id')->constrained(); //エリアId(外部キー)
            $table->string('address')->nullable(); //エリア詳細
            $table->foreignId('user_id')->constrained(); //ユーザーId(外部キー)
            $table->string('image_at')->nullable(); //写真
            $table->boolean('status'); //探していますor見つけました
            $table->string('name')->nullable(); //ペットの名前
            $table->date('date')->nullable(); //いなくなった日or見つけた日
            $table->foreignId('pet_subcategory_id')->constrained(); //ペットの中分類(外部キー)
            $table->string('sex')->nullable(); //ペットの性別
            $table->tinyInteger('weight')->nullable(); //体重
            $table->tinyInteger('height')->nullable(); //身長
            $table->tinyInteger('age')->nullable(); //年齢
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strays');
    }
};
