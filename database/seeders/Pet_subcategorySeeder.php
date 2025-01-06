<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet_subcategory; 

class Pet_subcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pet_subcategory::insert([
            ['id' => 1, 'pet_category_id' => 1, 'subcategory' => 'イヌ'],
            ['id' => 2, 'pet_category_id' => 1, 'subcategory' => 'ネコ'],
            ['id' => 3, 'pet_category_id' => 1, 'subcategory' => 'ハムスター'],
            ['id' => 4, 'pet_category_id' => 1, 'subcategory' => 'ウサギ'],
            ['id' => 5, 'pet_category_id' => 1, 'subcategory' => 'フェレット'],
            ['id' => 6, 'pet_category_id' => 1, 'subcategory' => 'モルモット'],
            ['id' => 7, 'pet_category_id' => 1, 'subcategory' => 'チンチラ'],
            ['id' => 8, 'pet_category_id' => 1, 'subcategory' => 'リス'],
            ['id' => 9, 'pet_category_id' => 1, 'subcategory' => 'モモンガ'],
            ['id' => 10, 'pet_category_id' => 1, 'subcategory' => 'ハリネズミ'],
            ['id' => 11, 'pet_category_id' => 1, 'subcategory' => 'ヤマネ'],
            ['id' => 12, 'pet_category_id' => 1, 'subcategory' => 'デグー'],
            ['id' => 13, 'pet_category_id' => 1, 'subcategory' => 'フェネック'],
            ['id' => 14, 'pet_category_id' => 1, 'subcategory' => '小型サル'],
            ['id' => 15, 'pet_category_id' => 1, 'subcategory' => 'コツメカワウソ'],
            ['id' => 16, 'pet_category_id' => 1, 'subcategory' => 'ネズミ'],
            ['id' => 17, 'pet_category_id' => 1, 'subcategory' => 'ラット'],
            ['id' => 18, 'pet_category_id' => 1, 'subcategory' => 'カワウソ'],
            ['id' => 19, 'pet_category_id' => 1, 'subcategory' => 'その他ほ乳類'],
            ['id' => 20, 'pet_category_id' => 2, 'subcategory' => 'インコ'],
            ['id' => 21, 'pet_category_id' => 2, 'subcategory' => 'ブンチョウ'],
            ['id' => 22, 'pet_category_id' => 2, 'subcategory' => 'カナリア'],
            ['id' => 23, 'pet_category_id' => 2, 'subcategory' => 'オウム'],
            ['id' => 24, 'pet_category_id' => 2, 'subcategory' => 'キンカチョウ'],
            ['id' => 25, 'pet_category_id' => 2, 'subcategory' => 'ミニチュアダック'],
            ['id' => 26, 'pet_category_id' => 2, 'subcategory' => 'フクロウ'],
            ['id' => 27, 'pet_category_id' => 2, 'subcategory' => 'ヒインコ'],
            ['id' => 28, 'pet_category_id' => 2, 'subcategory' => 'ラブバード'],
            ['id' => 29, 'pet_category_id' => 2, 'subcategory' => 'コンゴウインコ'],
            ['id' => 30, 'pet_category_id' => 2, 'subcategory' => 'ヨウム'],
            ['id' => 31, 'pet_category_id' => 2, 'subcategory' => 'その他鳥類'],
            ['id' => 32, 'pet_category_id' => 3, 'subcategory' => 'カメ'],
            ['id' => 33, 'pet_category_id' => 3, 'subcategory' => 'トカゲ類'],
            ['id' => 34, 'pet_category_id' => 3, 'subcategory' => 'カメレオン'],
            ['id' => 35, 'pet_category_id' => 3, 'subcategory' => 'ヘビ類'],
            ['id' => 36, 'pet_category_id' => 3, 'subcategory' => 'その他は虫類'],
            ['id' => 37, 'pet_category_id' => 4, 'subcategory' => 'カエル'],
            ['id' => 38, 'pet_category_id' => 4, 'subcategory' => 'サンショウウオ'],
            ['id' => 39, 'pet_category_id' => 4, 'subcategory' => 'ウーパールーパー'],
            ['id' => 40, 'pet_category_id' => 4, 'subcategory' => 'その他両生類'],
            ['id' => 41, 'pet_category_id' => 5, 'subcategory' => '観賞魚'],
            ['id' => 42, 'pet_category_id' => 5, 'subcategory' => '金魚'],
            ['id' => 43, 'pet_category_id' => 5, 'subcategory' => '鯉'],
            ['id' => 44, 'pet_category_id' => 5, 'subcategory' => 'メダカ'],
            ['id' => 45, 'pet_category_id' => 5, 'subcategory' => 'プレコ'],
            ['id' => 46, 'pet_category_id' => 5, 'subcategory' => 'ドジョウ'],
            ['id' => 47, 'pet_category_id' => 5, 'subcategory' => 'その他魚類'],
            ['id' => 48, 'pet_category_id' => 6, 'subcategory' => '甲虫類'],
            ['id' => 49, 'pet_category_id' => 6, 'subcategory' => 'スズムシ'],
            ['id' => 50, 'pet_category_id' => 6, 'subcategory' => 'コオロギ'],
            ['id' => 51, 'pet_category_id' => 6, 'subcategory' => 'ホタル'],
            ['id' => 52, 'pet_category_id' => 6, 'subcategory' => 'その他昆虫類'],
            ['id' => 53, 'pet_category_id' => 7, 'subcategory' => 'ミドリフグ'],
            ['id' => 54, 'pet_category_id' => 7, 'subcategory' => 'ヤドカリ'],
            ['id' => 55, 'pet_category_id' => 7, 'subcategory' => 'イモリ'],
            ['id' => 56, 'pet_category_id' => 7, 'subcategory' => 'カニ'],
            ['id' => 57, 'pet_category_id' => 7, 'subcategory' => 'タニシ'],
            ['id' => 58, 'pet_category_id' => 7, 'subcategory' => 'ザリガニ'],
            ['id' => 59, 'pet_category_id' => 7, 'subcategory' => 'カメノコガイ'],
            ['id' => 60, 'pet_category_id' => 7, 'subcategory' => 'カメ類'],
            ['id' => 61, 'pet_category_id' => 7, 'subcategory' => 'ウミウシ'],
            ['id' => 62, 'pet_category_id' => 7, 'subcategory' => 'エビ'],
            ['id' => 63, 'pet_category_id' => 7, 'subcategory' => 'その他'],
        ]);
    }
}
