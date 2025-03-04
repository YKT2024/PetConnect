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
        Schema::create('shelters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); //ユーザーId(外部キー)
            $table->text('body')->nullable(); //備考
            $table->string('address')->nullable(); //避難所の住所
            $table->foreignId('area_id')->constrained(); //エリアId(外部キー)
            $table->string('image_at')->nullable(); //もしかしたら使うかも：写真
            $table->string('shelter_name')->nullable(); //避難所の名前
            $table->string('shelter_contact')->nullable(); //避難所の連絡先
            $table->boolean('evacuation_type')->nullable(); //避難方法
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shellters');
    }
};
