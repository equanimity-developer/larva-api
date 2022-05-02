<?php

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
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->name(),
            'nip'         => $this->generateNip(),
            'address'     => $this->faker->address(),
            'city'        => $this->faker->city(),
            'postal_code' => $this->generatePostalCode(),
        ];
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generateNip(): string
    {
        return random_int(1, 9) . random_int(0, 999999999);
    }

    /**
     * @return string
     * @throws Exception
     */
    private function generatePostalCode(): string
    {
        return str_pad(random_int(0, 99), 2, '0') . "-" . str_pad(random_int(0, 999), 3, '0');
    }
}
