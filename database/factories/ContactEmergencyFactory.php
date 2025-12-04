<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ContactEmergency;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactEmergency>
 */
class ContactEmergencyFactory extends Factory
{
    protected $model = ContactEmergency::class;

    public function definition(): array
    {
        return [
            'contact_person' => $this->faker->name(),
            'relationship' => $this->faker->randomElement(['Spouse', 'Parent', 'Sibling', 'Friend']),
            'contact_number' => $this->faker->phoneNumber(),
        ];
    }
}
