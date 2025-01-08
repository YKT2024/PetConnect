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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //ユーザーID(外部キー)
            $table->string('name'); //ペットの名前
            $table->unsignedBigInteger('pet_category_id'); //ペットの大分類(外部キー)
            $table->unsignedBigInteger('subcategory_id'); //ペットの中分類(外部キー)
            $table->string('pet_breed')->nullable(); //ペットの小分類
            $table->integer('birth_year')->nullable(); //ペットの誕生日(年)
            $table->tinyInteger('birth_month')->nullable(); //ペットの誕生日(月)
            $table->string('sex')->nullable(); //ペットの性別
            $table->string('color')->nullable(); //ペットの色
            $table->date('pick_up_date')->nullable(); //お迎えした日
            $table->string('image_at')->nullable(); //アイコン
            $table->string('body')->nullable(); //備考
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
