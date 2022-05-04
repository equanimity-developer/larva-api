<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name'     => $this->faker->company(),
            'nip'      => $this->faker->unique()->taxpayerIdentificationNumber(),
            'address'  => $this->faker->address(),
            'city'     => $this->faker->city(),
            'postcode' => $this->faker->postcode(),
        ];
    }
}
