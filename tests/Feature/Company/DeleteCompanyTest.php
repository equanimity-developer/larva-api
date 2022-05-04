<?php

declare(strict_types=1);

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\Employee;
use Tests\Feature\WrongUuidListProvider;
use Tests\TestCase;

class DeleteCompanyTest extends TestCase
{
    use WrongUuidListProvider;

    /**
     * @test
     */
    public function it_should_delete_company_with_employee(): void
    {
        $company = Company::factory()->create();
        $employee = Employee::factory()->create([
            'company_id' => $company->id
        ]);

        $response = $this->delete(route('company.delete', $company->id));

        $response->assertSuccessful();
        $this->assertSoftDeleted('companies', $company->toArray());
        $this->assertSoftDeleted('employees', $employee->toArray());
    }

    /**
     * @test
     * @dataProvider wrongUuidListProvider
     */
    public function it_should_response_not_found_code_for_wrong_company_id($id): void
    {
        $response = $this->delete(route('company.delete', $id));

        $response->assertStatus(404);
    }
}