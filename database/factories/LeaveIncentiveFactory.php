<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LeaveIncentive;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveIncentive>
 */
class LeaveIncentiveFactory extends Factory
{
    protected $model = LeaveIncentive::class;

    public function definition(): array
    {
        return [
            'SIL' => $this->faker->numberBetween(0, 10),
            'SL' => $this->faker->numberBetween(0, 10),
            'VL' => $this->faker->numberBetween(0, 10),
        ];
    }
}
