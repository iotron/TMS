<?php

namespace Database\Factories\Project;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project\Sprint>
 */
class SprintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a random start date within the past 3 months to the next month
        $startDate = $this->faker->dateTimeBetween('-3 months', '+1 month');

        // Generate an end date that's 2 weeks after the start date
        $endDate = (clone $startDate)->modify('+2 weeks');

        return [
            'name' => $this->faker->unique()->words(3, true), // e.g., "Sprint Alpha Release"
            'goal' => $this->faker->optional()->paragraph(),  // Optional paragraph describing the sprint goal
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
