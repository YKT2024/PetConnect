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
        Schema::create('pet_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_category_id'); //ペットの大分類(外部キー)
            $table->string('subcategory'); //ペットの中分類
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_subcategories');
    }
};
