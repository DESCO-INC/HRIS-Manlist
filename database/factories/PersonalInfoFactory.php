<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PersonalInfo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalInfo>
 */
class PersonalInfoFactory extends Factory
{
    protected $model = PersonalInfo::class;

    public function definition(): array
    {
        return [
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Widowed']),
            'educational_attainment' => $this->faker->randomElement(['High School', 'College', 'Graduate']),
            'school' => $this->faker->company(),
            'course' => $this->faker->word(),
            'professional_licensure' => $this->faker->optional()->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'email_address' => $this->faker->unique()->safeEmail(),
            'province' => $this->faker->state(),
            'municipality' => $this->faker->city(),
            'barangay' => $this->faker->streetName(),
            'blood_type' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'address' => $this->faker->address(),
            'tin_number' => $this->faker->numerify('###-###-###'),
            'sss_number' => $this->faker->numerify('##-#######-#'),
            'philhealth_number' => $this->faker->numerify('##-#########-#'),
            'pagibig_number' => $this->faker->numerify('####-####-####'),
        ];
    }
}
