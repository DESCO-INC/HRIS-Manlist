<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Manlist;
use App\Models\PersonalInfo;
use App\Models\ContactEmergency;
use App\Models\LeaveIncentive;
use App\Models\Compensation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manlist>
 */
class ManlistFactory extends Factory
{
    protected $model = Manlist::class;

    public function definition(): array
    {
        return [
            'emp_number' => 'EMP-' . $this->faker->unique()->numerify('####'),
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'suffix' => $this->faker->optional()->suffix(),
            'position' => $this->faker->jobTitle(),
            'department' => $this->faker->randomElement(['HR', 'IT', 'Engineering', 'Finance']),
            'emp_classification' => $this->faker->randomElement(['RANK & FILE', 'SUPERVISORY', 'MANAGERIAL']),
            'emp_status' => $this->faker->randomElement(['REGULAR', 'PROBITIONARY', 'RESIGNED']),
            'datehired' => $this->faker->date(),
            'workbase' => $this->faker->city(),
            'temporary_workbase' => $this->faker->optional()->city(),
            'project_assigned' => $this->faker->word(),
            'project_hired' => $this->faker->date(),
            'contract_expiration' => $this->faker->optional()->date(),
            'probitionary_date' => $this->faker->optional()->date(),
            'regularization_date' => $this->faker->optional()->date(),
            'seperation_date' => $this->faker->optional()->date(),
            'seperation_reason' => $this->faker->word(),
            'remarks' => $this->faker->word(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Manlist $manlist) {
            // Automatically create related records
            $manlist->personalInfo()->create(PersonalInfo::factory()->make()->toArray());
            $manlist->contactEmergency()->create(ContactEmergency::factory()->make()->toArray());
            $manlist->leaveIncentive()->create(LeaveIncentive::factory()->make()->toArray());
            $manlist->compensation()->create(Compensation::factory()->make()->toArray());
        });
    }
}
