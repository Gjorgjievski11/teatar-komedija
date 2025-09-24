<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Play;
use Illuminate\Support\Str;


class PlaySeeder extends Seeder
{

    public function run(): void
    {
        // Ensure categories exist
        if (\App\Models\Category::count() === 0) {
            $categories = [
                ['name' => 'Драма'],
                ['name' => 'Комедија'],
                ['name' => 'Трагедија'],
                ['name' => 'Мјузикл'],
                ['name' => 'Детска претстава'],
            ];
            foreach ($categories as $cat) {
                \App\Models\Category::create($cat);
            }
        }

        $plays = Play::factory(10)->create([
            'poster' => '',
        ]);

        foreach ($plays as $play) {
            $categoryIds = \App\Models\Category::inRandomOrder()->limit(rand(1, 2))->pluck('id');
            $play->categories()->attach($categoryIds);

            // No PlayImage creation

            for ($i = 0; $i < rand(2, 4); $i++) {
                $play->assignDate(
                    now()->addDays(rand(1, 60))->setTime(rand(17, 21), [0, 30][rand(0, 1)]),
                    Str::uuid()
                );
            }
        }
    }
}
