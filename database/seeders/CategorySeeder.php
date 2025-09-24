<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Драма'],
            ['name' => 'Комедија'],
            ['name' => 'Трагедија'],
            ['name' => 'Мјузикл'],
            ['name' => 'Детска претстава'],
            ['name' => 'Монодрама'],
            ['name' => 'Современа драма'],
        ];
        foreach ($categories as $cat) {
            Category::firstOrCreate($cat);
        }
    }
} 