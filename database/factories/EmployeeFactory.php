<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        /** @var Company $company */
        $company = Company::factory()->create();

        return [
            'email'        => $this->faker->unique()->safeEmail(),
            'first_name'   => $this->faker->firstName(),
            'last_name'    => $this->faker->lastName(),
            'phone_number' => $this->faker->phoneNumber(),
            'company_id'   => $company->id
        ];
    }
}
