<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Models\Company;
use Tests\TestCase;

class GetAllCompaniesTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_get_all_companies(): void
    {
        $companies = Company::factory()->count(5)->create();

        $response = $this->get(route('company.get-all'));

        $response->assertSuccessful();
        $companies->each(fn (Company $company) => $response->assertJsonFragment($company->toArray()));
    }
}