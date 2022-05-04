<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\Employee;
use Tests\Feature\WrongUuidListProvider;
use Tests\TestCase;

class GetCompanyTest extends TestCase
{
    use WrongUuidListProvider;

    /**
     * @test
     */
    public function it_should_get_company_with_employee(): void
    {
        $company = Company::factory()->create();
        $employee = Employee::factory()->create([
            'company_id' => $company->id
        ]);

        $response = $this->get(route('company.get', $company->id));

        $response->assertSuccessful();
        $response->assertJsonFragment($company->toArray());
        $response->assertJsonFragment($employee->toArray());
    }

    /**
     * @test
     * @dataProvider wrongUuidListProvider
     */
    public function it_should_response_not_found_code_for_wrong_company_id($id): void
    {
        $response = $this->get(route('company.get', $id));

        $response->assertStatus(404);
    }
}