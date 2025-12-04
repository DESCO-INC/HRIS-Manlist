<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Compensation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compensation>
 */
class CompensationFactory extends Factory
{
    protected $model = Compensation::class;

    public function definition(): array
    {
        return [
            'daily_rate' => $this->faker->numberBetween(400, 2000),
            'monthly_rate' => $this->faker->numberBetween(10000, 80000),
            'meal_subsidy' => $this->faker->numberBetween(100, 1000),
            'meal_allowance' => $this->faker->numberBetween(100, 1000),
            'rice_subsidy' => $this->faker->numberBetween(500, 2000),
            'spa_allowance' => $this->faker->numberBetween(100, 500),
            'transpo_assistance' => $this->faker->numberBetween(100, 500),
            'clothing_allowance' => $this->faker->numberBetween(100, 500),
            'transpo_allowance' => $this->faker->numberBetween(100, 500),
            'communication_allowance' => $this->faker->numberBetween(100, 500),
            'project_allowance' => $this->faker->numberBetween(100, 500),
            'technical_allowance' => $this->faker->numberBetween(100, 500),
            'positional_allowance' => $this->faker->numberBetween(100, 500),
            'professional_allowance' => $this->faker->numberBetween(100, 500),
            'housing_allowance' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
