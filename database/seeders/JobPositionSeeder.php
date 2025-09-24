<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\JobPosition;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPositionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $positions = [
            // Only one director
            ['name' => 'Директор', 'job_category' => 'director'],
            // Artistic
            ['name' => 'Актер', 'job_category' => 'artistic'],
            ['name' => 'Режисер', 'job_category' => 'artistic'],
            ['name' => 'Сценограф', 'job_category' => 'artistic'],
            ['name' => 'Костимограф', 'job_category' => 'artistic'],
            ['name' => 'Драматург', 'job_category' => 'artistic'],
            // Administrative
            ['name' => 'Секретар', 'job_category' => 'administrative'],
            ['name' => 'Сметководител', 'job_category' => 'administrative'],
            ['name' => 'Референт', 'job_category' => 'administrative'],
            ['name' => 'Архивар', 'job_category' => 'administrative'],
            // Technical
            ['name' => 'Технички директор', 'job_category' => 'technical'],
            ['name' => 'Тонец', 'job_category' => 'technical'],
            ['name' => 'Осветлувач', 'job_category' => 'technical'],
            ['name' => 'Сценски работник', 'job_category' => 'technical'],
            ['name' => 'Машинист', 'job_category' => 'technical'],
        ];

        // $employeeImages = [
        //     'about-images/collective/director.png',
        //     'about-images/collective/download (1).jpeg',
        //     'about-images/KOLEKTIV.png',
        //     'about-images/DOKUMENTI.jpg',
        // ];
        // $imgCount = count($employeeImages);
        // $imgIndex = 0;
        foreach ($positions as $position) {
            $job = \App\Models\JobPosition::create($position);
            // Only one director employee
            // $numEmployees = ($position['job_category'] === 'director') ? 1 : rand(1, 3);
            // for ($i = 0; $i < $numEmployees; $i++) {
            //     \App\Models\Employee::create([
            //         'name' => fake('mk_MK')->firstName(),
            //         'surname' => fake('mk_MK')->lastName(),
            //         'description' => fake('mk_MK')->text(120),
            //         'job_position_id' => $job->id,
            //     ]);
            // }
        }
    }
}
