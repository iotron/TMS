<?php

namespace Database\Factories\Project;

use App\Casts\PriorityCast;
use App\Casts\StatusCast;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'url' => $this->faker->unique()->url,
            'description' => $this->faker->optional()->paragraph,
            'priority' => $this->faker->randomElement(PriorityCast::cases()),
            'status' => fake()->randomElement(StatusCast::cases()),
            'start' => $starOn = now()->subDays(rand(2,10)),
            'end' => $starOn->addDays(rand(5,15)),
            'created_at' => now()->subDays(rand(2,10)),

        ];
    }
}
