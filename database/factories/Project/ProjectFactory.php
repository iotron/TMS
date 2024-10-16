<?php

namespace Database\Factories\Project;

use App\Casts\StatusCast;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word.' '.fake()->unique()->word,
            'url' => Str::ulid(),
            'description' => $this->faker->paragraph,
            'start' => $this->faker->optional()->dateTime,
            'end' => $this->faker->optional()->dateTime,
            'status' => $this->faker->randomElement(StatusCast::cases()),
            'user_id' => 1
        ];
    }
}
