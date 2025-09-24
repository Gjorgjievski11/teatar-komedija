<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Play>
 */
class PlayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'duration' => $this->faker->numberBetween(60, 180),
            'short_description' => $this->faker->text(100),
            'description' => $this->faker->text(600),
            'poster' => $this->faker->imageUrl(),
            'image_kit_id' => $this->faker->uuid(),
            'ticket_url' => $this->faker->url(),
            'price' => $this->faker->numberBetween(200, 800),
        ];
    }
}
