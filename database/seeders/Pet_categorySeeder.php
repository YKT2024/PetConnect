<?php

namespace Database\Seeders;

use App\Models\Pet_category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Pet_categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pet_category::insert([
            ['id' => 1, 'category' => 'ほ乳類'],
            ['id' => 2, 'category' => '鳥類'],
            ['id' => 3, 'category' => 'は虫類'],
            ['id' => 4, 'category' => '両生類'],
            ['id' => 5, 'category' => '魚類'],
            ['id' => 6, 'category' => '昆虫類'],
            ['id' => 7, 'category' => 'その他']
            ]);
    }
}
