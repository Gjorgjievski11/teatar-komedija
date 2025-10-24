<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {


    public function run(): void 
    {
        $this->call([
            JobPositionSeeder::class,
            CategorySeeder::class,
            PlaySeeder::class,
            UserSeeder::class,
        ]);
    }
}