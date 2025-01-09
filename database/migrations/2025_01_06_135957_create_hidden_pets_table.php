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
        Schema::create('hidden_pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); //ユーザーID(外部キー)
            $table->foreignId('pet_subcategory_id')->constrained(); //ペットの中分類(外部キー)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hidden_pets');
    }
};
