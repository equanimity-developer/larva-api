<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->count(3)->create()->each(
            fn (Company $company) => Employee::factory()->count(5)->create([
                'company_id' => $company->id
            ]));
    }
}
